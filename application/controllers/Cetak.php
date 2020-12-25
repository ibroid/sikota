<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'models/Tabayun_keluar.php';
class Cetak extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SIPP');
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
		$this->trace($this->list);
		$this->index();
	}

	public function cetak_pengantar_keluar($id)
	{
		$this->title = 'Cetak Pengantar Bantuan';
		$this->list = Tabayun_keluar::getWhere(['id' => $id])->row_array();
		$this->phs = $this->SIPP->customWhere('penetapan_hari_sidang', [
			[
				'field' => 'perkara_id',
				'value' => $this->list['perkara_id']
			]
		], 'perkara_penetapan');
		$this->trace($this->list);
		$this->view = 'cetak_pengantar_keluar';
		$this->index();
	}

	private function trace($var)
	{
		print_r('<pre>');
		print_r($var);
		print_r('</pre>');
	}
}

/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */