<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->library('notifikasi');
		$this->load->model('M_surat');
	}
	
	public function index()
	{
		
		//$data['surat'] = $this->M_surat->get('tbl_surat_keluar','tbl_surat_masuk');
		//$data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 4])->result();
		//$this->templating->load('template/master', 'page/v_laporan_surat', $data);

		$this->templating->load('template/master', 'page/v_laporan_surat', [
		'sub_menu' => $this->db->get_where('sub_menu', ['id_menu' => 4])->result(),
      	'title' => 'Surat Umum/Laporan Surat'
    ]);
	
	}

}

/* End of file Surat_keluar.php */
/* Location: ./application/controllers/Laporan_surat.php */