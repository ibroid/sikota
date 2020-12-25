<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mimiti extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_radius');
	}

	public function index()
	{
		$data['radius'] = $this->M_radius->getRadiusSatker();

		//$data['biaya_panggilan'] = $this->M_radius->getBiayaPanggilan();
		//$this->load->view('v_mimiti',$data);
		$this->load->view('v_mimiti',$data);
	}
	public function test()
	{
		echo "ok";
	}
}
