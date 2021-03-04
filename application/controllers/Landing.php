<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SIPP');
		$this->load->model('identity');
	}

	public function index()
	{

		$this->load->view('landing', [
			'identity' => Identity::take(['NamaPN', 'kode_satker']),
			'total_delegasi_masuk' => $this->db->query("SELECT COUNT(id) AS total_del_masuk FROM tabayun_masuk ")->row_array(),
			'total_delegasi_keluar' => $this->db->query("SELECT COUNT(id) AS total_del_keluar FROM tabayun_keluar")->row_array(),
		]);
	}
	public function debug()
	{
		echo "ok";
	}
}
