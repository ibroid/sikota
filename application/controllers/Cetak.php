<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Tabayun_keluar.php';
require_once APPPATH . 'libraries/Export.php';
require_once APPPATH . 'libraries/Components.php';
class Cetak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SIPP');
		$this->load->model('tabayun_masuk');
		$this->load->model('tabayun_proses_masuk');
		$this->load->model('identity');
	}
	private static function perkara_pihak_replace($data)
	{
		return [
			'nomor_perkara' =>  $data['nomor_perkara'],
			'nama_pe' =>  sippTable()::lawanPihak($data['nomor_perkara'], 'pihak1_text'), 'jenis_pihak_pe' =>  sippTable()->whoIsIt($data['nomor_perkara'], 'P'), 'nama_te_1' =>  sippTable()::lawanPihak($data['nomor_perkara'], 'pihak2_text'),
			'jenis_pihak_te' =>   sippTable()->whoIsIt($data['nomor_perkara'], 'T'), 'tgl_sidang' => dateToText()->tanggal_indo_monthtext($data['tgl_sidang']),
			'nama_pihak' => $data['pihak'],
			'jenis_pihak' => $data['status_pihak'],
			'tgl_lahir_pihak' => dateToText()::hitung_umur($data['tanggal_lahir_pihak']), 'agama_pihak' => $data['agama_pihak'],
			'pekerjaan_pihak' => $data['pekerjaan_pihak'],
			'alamat_pihak' => $data['alamat_pihak'],
			'jenis_perkara' => $data['jenis_perkara_text'],
			'hari_sidang' => dateToText()->get_hari($data['tgl_sidang'])
		];
	}
	private static function identity_replace($tujuan, $identity)
	{
		return [
			'pn_tujuan_text' => ucwords(strtolower($tujuan)),
			'pn_asal_text_lc' => ucwords(strtolower($identity['NamaPN'])),
			'pn_asal_text' => $identity['NamaPN'],
			'alamat_pn_asal' => $identity['AlamatPN'],
			'telepon_pn_asal' => $identity['NomorTelepon'],
			'nama_panitera_pn_asal' => $identity['PanSekNama'],
			'web_pn_asal' => $identity['Website'],
			'email_pn_asal' => $identity['Email'],
			'kota_pn_asal' => ucwords(strtolower(str_replace('PENGADILAN AGAMA ', '', $identity['NamaPN']))),
		];
	}
	private static function surat_replace($data)
	{
		return [
			'nomor_surat' =>  $data['nomor_surat'],
			'tgl_kirim' =>  dateToText()->tanggal_indo_monthtext($data['tgl_surat']),
		];
	}
	private function jurusita_replace(array $data)
	{
		return [
			'nama_jurusita' => $data['nama_gelar'],
			'jenis_jurusita' => sippTable()::jenisJurusita($data['jabatan']),
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
				'amar_putusan' => $putusan['amar_putusan'],
				'tgl_putus' => dateToText()->tanggal_indo_monthtext($putusan['tanggal_putusan']),
				'biaya_keluar' => buatrp($data['biaya']),
				'terbilang_biaya' => ucwords(to_word($data['biaya']))
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
			self::identity_replace($data['pn_tujuan_text'], $indentity),
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

	public function panggilan_sidang_ikrar(array $data)
	{
		$perkara_id = $data['perkara_id'];
		$putusan = $this->SIPP->customQuery("SELECT tanggal_putusan,amar_putusan FROM perkara_putusan WHERE perkara_id = $perkara_id")->row_array();
		$export = array_merge(
			$this->identity_replace(
				$data['pn_tujuan_text'],
				Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon', 'NamaPN', 'Website', 'Email']),
			),
			$this->surat_replace($data),
			$this->perkara_pihak_replace($data),
			[
				'jenis_perkara' => $data['jenis_perkara_text'],
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']), 'biaya_keluar' =>  buatrp($data['biaya']),
				'terbilang_biaya' =>  ucwords(to_word($data['biaya'])),
				'tgl_putus' => dateToText()->tanggal_indo_monthtext($putusan['tanggal_putusan'])
			]
		);
		$file = Export::findFile("./rtf/template/pengantar_ikrar.rtf")->replace($export)->write("./rtf/hasil/hasil_pengantar_ikrar_keluar.rtf");
		redirect($file);
	}

	public function	relaas($id)
	{
		$data = Tabayun_masuk::getWhere(['id' => $id])->row_array();
		switch ($data['jenis_delegasi_text']) {
			case 'Panggilan Sidang':
				return $this->relaas_panggilan_sidang($data);
				break;
			case 'Panggilan Sidang Lanjutan':
				return $this->relaas_panggilan_sidang_lanjutan($data);
				break;
			case 'Panggilan Sidang Ikrar':
				return $this->relaas_panggilan_sidang_ikrar($data);
				break;
			case 'Pemberitahuan Putusan Pengadilan Tingkat Pertama':
				return $this->relaas_pemberitahuan_putusan($data);
				break;
			default:
				break;
		}
	}
	public function relaas_panggilan_sidang(array $data)
	{
		$export =  array_merge(
			$this->jurusita_replace($this->SIPP->get_where('jurusita', ['id' => Tabayun_proses_masuk::getWhere(['delegasi_id' => $data['id']])->row()->jurusita_id])->row_array()),
			[
				'pn_asal_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'alamat_pn_asal' => sippTable()->identityPnTujuan($data['pn_asal_text'])['alamat'],
				'jenis_perkara' => $data['jenis_perkara_text'],
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']),
				'nama_pihak' => $data['pihak'],
				'nama_pe' => sippTable()::paraPihak($data['para_pihak'])[1],
				'nama_te_1' => sippTable()::paraPihak($data['para_pihak'])[3],
				'jenis_pihak_pe' => sippTable()::paraPihak($data['para_pihak'])[0],
				'jenis_pihak_te' => sippTable()::paraPihak($data['para_pihak'])[2],
				'jenis_pihak' => $data['status_pihak'],
				'nomor_perkara' => $data['nomor_perkara'],
				'alamat_pihak' => $data['alamat_pihak']
			]
		);
		$file = Export::findFile("./rtf/template/template_relaas_pertama.rtf")->replace($export)->write("./rtf/hasil/hasil_relaas_pertama.rtf");
		redirect($file);
	}
	public function relaas_panggilan_sidang_lanjutan(array $data)
	{
		$export =  array_merge(
			$this->jurusita_replace($this->SIPP->get_where('jurusita', ['id' => Tabayun_proses_masuk::getWhere(['delegasi_id' => $data['id']])->row()->jurusita_id])->row_array()),
			[
				'pn_asal_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'alamat_pn_asal' => sippTable()->identityPnTujuan($data['pn_asal_text'])['alamat'],
				'jenis_perkara' => $data['jenis_perkara_text'],
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']),
				'nama_pihak' => $data['pihak'],
				'nama_pe' => sippTable()::paraPihak($data['para_pihak'])[1],
				'nama_te_1' => sippTable()::paraPihak($data['para_pihak'])[3],
				'jenis_pihak_pe' => sippTable()::paraPihak($data['para_pihak'])[0],
				'jenis_pihak_te' => sippTable()::paraPihak($data['para_pihak'])[2],
				'jenis_pihak' => $data['status_pihak'],
				'nomor_perkara' => $data['nomor_perkara'],
				'alamat_pihak' => $data['alamat_pihak']
			]
		);
		$file = Export::findFile("./rtf/template/template_relaas_lanjutan.rtf")->replace($export)->write("./rtf/hasil/hasil_relaas_lanjutan.rtf");
		redirect($file);
	}

	public function relaas_panggilan_sidang_ikrar($data)
	{
		$export =  array_merge(
			$this->jurusita_replace($this->SIPP->get_where('jurusita', ['id' => Tabayun_proses_masuk::getWhere(['delegasi_id' => $data['id']])->row()->jurusita_id])->row_array()),
			[
				'pn_asal_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'pn_as al_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'alamat_pn_asal' => sippTable()->identityPnTujuan($data['pn_asal_text'])['alamat'],
				'jenis_perkara' => $data['jenis_perkara_text'],
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']),
				'nama_pihak' => $data['pihak'],
				'nama_pe' => sippTable()::paraPihak($data['para_pihak'])[1],
				'nama_te_1' => sippTable()::paraPihak($data['para_pihak'])[3],
				'jenis_pihak_pe' => sippTable()::paraPihak($data['para_pihak'])[0],
				'jenis_pihak_te' => sippTable()::paraPihak($data['para_pihak'])[2],
				'jenis_pihak' => $data['status_pihak'],
				'nomor_perkara' => $data['nomor_perkara'],
				'alamat_pihak' => $data['alamat_pihak']
			]
		);
		$file = Export::findFile("./rtf/template/template_relaas_ikrar.rtf")->replace($export)->write("./rtf/hasil/hasil_relaas_ikrar.rtf");
		redirect($file);
	}
	public function relaas_pemberitahuan_putusan($data)
	{
		$export =  array_merge(
			$this->jurusita_replace($this->SIPP->get_where('jurusita', ['id' => Tabayun_proses_masuk::getWhere(['delegasi_id' => $data['id']])->row()->jurusita_id])->row_array()),
			[
				'pn_asal_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'pn_as al_text_lc' => ucwords(strtolower($data['pn_asal_text'])),
				'alamat_pn_asal' => sippTable()->identityPnTujuan($data['pn_asal_text'])['alamat'],
				'jenis_perkara' => $data['jenis_perkara_text'],
				'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']),
				'nama_pihak' => $data['pihak'],
				'nama_pe' => sippTable()::paraPihak($data['para_pihak'])[1],
				'nama_te_1' => sippTable()::paraPihak($data['para_pihak'])[3],
				'jenis_pihak_pe' => sippTable()::paraPihak($data['para_pihak'])[0],
				'jenis_pihak_te' => sippTable()::paraPihak($data['para_pihak'])[2],
				'jenis_pihak' => $data['status_pihak'],
				'nomor_perkara' => $data['nomor_perkara'],
				'alamat_pihak' => $data['alamat_pihak'],
				'amar_putusan' => $data['amar_putusan']
			]
		);
		$file = Export::findFile("./rtf/template/template_relaas_pbt.rtf")->replace($export)->write("./rtf/hasil/hasil_relaas_pbt.rtf");
		redirect($file);
	}
	public function amplop_relaas($id)
	{
		$identity = Identity::take(['Logo', 'AlamatPN', 'NamaPN']);
		$data = Tabayun_masuk::getWhere(['id' => $id])->row_array();
		$export = [
			'logo_pn_asal' => Components::load('logo', $identity),
			'pn_asal_text' => $identity['NamaPN'],
			'alamat_pn_asal' => $identity['AlamatPN'],
			'nama_pihak' => $data['pihak'],
			'alamat_pihak' => $data['alamat_pihak'],
			'nomor_perkara' => $data['nomor_perkara']
		];
		$file = Export::findFile("./rtf/template/template_amplop_jspluar.rtf")->replace($export)->write("./rtf/hasil/hasil_amplop_luar.rtf");
		redirect($file);
	}
}

 /* End of file Cetak.php */
 /* Location: ./application/controllers/Cetak.php */