<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('notifikasi');
		$this->load->model('Suratkeluar_model', 'suratk');
		$this->load->model('M_surat');
	}

	public function index()
	{
		$data['surat'] = $this->M_surat->getAllSuratMasuk();
		$data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 4])->result();
		$this->templating->load('template/master', 'page/v_surat', $data);
	}
}


/* End of file Surat.php */