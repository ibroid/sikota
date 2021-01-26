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

	public function index()
	{
		$this->templating->load('template/master', 'tabayun_keluar/' . $this->view, [
			'title' => $this->title,
			'sub_menu' => $this->submenu,
			'data' => $this->list,
			'phs' => $this->phs
		]);
	}

	public function cetak_amplop($id)
	{
		$this->title = 'Cetak Amplop Tabayun Keluar';
		$this->list = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		$this->view = 'cetak_amplop_pengantar';
		$this->index();
	}

	public function cetak_pengantar_keluar($id)
	{
		$data = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		$phs = $this->SIPP->customWhere('penetapan_hari_sidang', [
			[
				'field' => 'perkara_id',
				'value' => $data['perkara_id']
			]
		], 'perkara_penetapan');
		$indentity = Identity::take(['PanSekNama', 'AlamatPN', 'NomorTelepon']);

		$export = [
			'pn_asal_text' => $data['pn_asal_text'],
			'pn_tujuan_text' => $data['pn_tujuan_text'],
			'jenis_perkara' =>  $data['jenis_perkara_text'],
			'nomor_perkara' =>  $data['nomor_perkara'],
			'nomor_surat' =>  $data['nomor_surat'],
			'nama_pe' =>  $data['pihak'],
			'jenis_pihak_pe' =>  $data['status_pihak'],
			'nama_te_1' =>  sippTable()::lawanPihak($data['nomor_perkara'], 'pihak1_text'),
			'jenis_pihak_te' =>  sippTable()::reversePihak($data['status_pihak']),
			'tgl_kirim' =>  dateToText()->tanggal_indo_monthtext($data['tgl_surat']),
			'tgl_sidang' =>  dateToText()->tanggal_indo_monthtext($data['tgl_sidang']),
			'tgl_phs' =>  dateToText()->tanggal_indo($phs[0]->penetapan_hari_sidang),
			'nama_pihak' =>  $data['pihak'],
			'jenis_pihak' =>  $data['status_pihak'],
			'tgl_lahir_pihak' => dateToText()::hitung_umur($data['tanggal_lahir_pihak']),
			'agama_pihak' =>  $data['agama_pihak'],
			'pekerjaan_pihak' =>  $data['pekerjaan_pihak'],
			'alamat_pihak' =>  $data['alamat_pihak'],
			'hari_sidang' =>  dateToText()->format_indo($data['tgl_sidang']),
			'biaya_keluar' =>  buatrp($data['biaya']),
			'terbilang_biaya' =>  ucwords(to_word($data['biaya'])),
			'alamat_pn_asal' => $indentity['AlamatPN'],
			'nomor_telepom_pn_asal' => $indentity['NomorTelepon'],
			'nama_panitera_pn_asal' => $indentity['PanSekNama']
		];

		$file = Export::findFile("./rtf/template/template_pengantar_keluar.rtf")
			->replace($export)->write("./rtf/hasil/hasil_pengantar_rellas_keluar.rtf");
		redirect($file, 'refresh');
	}
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */