<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mimiti extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('v_mimiti');
	}
	public function test()
	{
		echo "ok";
	}
}
