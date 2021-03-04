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
			'identity' => Identity::take(['NamaPN', 'kode_satker'])
		]);
	}
	public function debug()
	{
		echo "ok";
	}
}
