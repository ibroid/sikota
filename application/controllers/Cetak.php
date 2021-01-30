<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Tabayun_keluar.php';
require_once APPPATH . 'libraries/Export.php';
class Cetak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SIPP');
		$this->load->model('identity');
	}
	private static function perkara_pihak_replace($data)
	{
		return [
			'nomor_perkara' =>  $data['nomor_perkara'],
			'nama_pe' =>  sippTable()::lawanPihak($data['nomor_perkara'], 'pihak1_text'), 'jenis_pihak_pe' =>  sippTable()->whoIsIt($data['nomor_perkara'], 'P'), 'nama_te_1' =>  sippTable()::lawanPihak($data['nomor_perkara'], 'pihak2_text'), 'jenis_pihak_te' =>   sippTable()->whoIsIt($data['nomor_perkara'], 'T'), 'tgl_sidang' => dateToText()->tanggal_indo_monthtext($data['tgl_sidang']), 'nama_pihak' => $data['pihak'],
			'jenis_pihak' => $data['status_pihak'],
			'tgl_lahir_pihak' => dateToText()::hitung_umur($data['tanggal_lahir_pihak']), 'agama_pihak' => $data['agama_pihak'],
			'pekerjaan_pihak' => $data['pekerjaan_pihak'],
			'alamat_pihak' => $data['alamat_pihak'],
		];
	}
	private static function identity_replace($tujuan, $identity)
	{
		return [
			'pn_tujuan_text' => $tujuan,
			'pn_asal_text' => $identity['NamaPN'],
			'alamat_pn_asal' => $identity['AlamatPN'],
			'telepon_pn_asal' => $identity['NomorTelepon'],
			'nama_panitera_pn_asal' => $identity['PanSekNama'],
			'web_pn_asal' => $identity['Website'],
			'email_pn_asal' => $identity['Email'],
			'kota_pn_asal' => str_replace('PENGADILAN AGAMA ', '', $identity['NamaPN']),
		];
	}
	private static function surat_replace($data)
	{
		return [
			'nomor_surat' =>  $data['nomor_surat'],
			'tgl_kirim' =>  dateToText()->tanggal_indo_monthtext($data['tgl_surat']),
		];
	}
	public function cetak_pengantar_keluar($id)
	{
		$data = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		switch ($data['jenis_delegasi_text']) {
			case 'Pemberitahuan Putusan Pengadilan Tingkat Pertama':
				return $this->pbt_tingkat_pertama($data);
				break;
			case 'Panggilan Sidang':
				return $this->panggilan_sidang($data);
				break;
			case 'Panggilan Sidang Lanjutan':
				return $this->panggilan_sidang_lanjutan($data);
				break;
			case 'Panggilan Sidang Ikrar':
				return $this->panggilan_sidang_ikrar($data);
				break;
		}
	}
	public function pbt_tingkat_pertama($data)
	{
		$identity = Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN']);
		$perkara_id = $data['perkara_id'];
		$putusan = $this->SIPP->customQuery("SELECT tanggal_putusan,amar_putusan FROM perkara_putusan WHERE perkara_id = $perkara_id")->row_array();
		$export = array_merge(
			self::identity_replace($data['pn_tujuan_text'], $identity),
			[
				'amar_putusan' => $putusan['amar_putusan'], 'tgl_putus' => dateToText()->tanggal_indo($putusan['tanggal_putusan'])
			],
			self::perkara_pihak_replace($data),
			self::surat_replace($data)
		);
		$file = Export::findFile("./rtf/template/template_pengantar_pbt.rtf")->replace($export)->write("./rtf/hasil/hasil_pbt_keluar.rtf");
		redirect($file);
	}
	public function panggilan_sidang($data)
	{
		$phs = $this->SIPP->customWhere('penetapan_hari_sidang', [
			[
				'field' => 'perkara_id',
				'value' => $data['perkara_id']
			]
		], 'perkara_penetapan');
		$indentity = Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN']);
		$export = array_merge(
			[
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']), 'biaya_keluar' =>  buatrp($data['biaya']),
				'terbilang_biaya' =>  ucwords(to_word($data['biaya'])),
				'tgl_phs' =>  dateToText()->tanggal_indo($phs[0]->penetapan_hari_sidang),
			],
			self::identity_replace($data['pn_asal_text'], $indentity),
			self::perkara_pihak_replace($data),
			self::surat_replace($data)
		);
		$file = Export::findFile("./rtf/template/template_pengantar_keluar.rtf")->replace($export)->write("./rtf/hasil/hasil_pengantar_rellas_keluar.rtf");
		redirect($file);
	}
	public function amplop_pengantar($id)
	{
		$data = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		$file = Export::findFile("./rtf/template/template_amplop_pengantar.rtf")->replace(array_merge([
			'nomor_perkara' => $data['nomor_perkara'], 'alamat_pn_tujuan' => sippTable()->identityPnTujuan($data['pn_tujuan_text'])['alamat']
		], self::identity_replace($data['pn_tujuan_text'], Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN']))))->write("./rtf/hasil/hasil_amplop_keluar.rtf");
		redirect($file);
	}
	public function wesel($id)
	{
		$data = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		$export = array_merge(
			self::identity_replace($data['pn_tujuan_text'], Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN'])),
			[
				'kota_pn_asal' => str_replace('PENGADILAN AGAMA ', '', $data['pn_asal_text']),
				'biaya_keluar' =>  buatrp($data['biaya']),
				'terbilang_biaya' =>  ucwords(to_word($data['biaya'])),
				'alamat_pn_tujuan' => sippTable()->identityPnTujuan($data['pn_tujuan_text'])['alamat'],
				'nomor_perkara' => $data['nomor_perkara'],
				'tgl_sidang' => dateToText()->format_indo($data['tgl_sidang'])
			]
		);
		$file = Export::findFile("./rtf/template/wesel.rtf")->replace($export)->write("./rtf/hasil/hasil_wesel_relaas_keluar.rtf");
		redirect($file);
	}
	public function panggilan_sidang_lanjutan($data)
	{
		$export = array_merge(
			[
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']), 'biaya_keluar' =>  buatrp($data['biaya']),
				'terbilang_biaya' =>  ucwords(to_word($data['biaya'])),
			],
			self::identity_replace($data['pn_tujuan_text'], Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN', 'Website', 'Email'])),
			self::perkara_pihak_replace($data),
			self::surat_replace($data)
		);
		$file = Export::findFile("./rtf/template/template_pengantar_keluar_lanjutan.rtf")->replace($export)->write("./rtf/hasil/hasil_pengantar_lanjutan_keluar.rtf");
		redirect($file);
	}

	public function panggilan_sidang_ikrar($data)
	{
	}
}
 /* End of file Cetak.php */
 /* Location: ./application/controllers/Cetak.php */