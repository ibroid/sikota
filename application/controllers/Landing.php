<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SIPP');
	}

	public function index()
	{
		$this->load->view('landing');
	}
	public function debug()
	{
		echo "ok";
	}
}
