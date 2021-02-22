<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'models/Radius.php';
class District extends CI_Controller
{

	public $title;
	public $data;
	public $sub_menu;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Components');
		$this->load->model('SIPP');
		$this->load->model('identity');
		$this->load->model('sub_menu');
		$this->sub_menu = Sub_menu::getWhere(['id_menu' => 7])->result();
		$this->uri->segment(2) == null ? redirect('District/lokal') :  false;
	}

	public function index()
	{
		Templating::render($this->view, [
			'title' => $this->title,
			'sub_menu' => $this->sub_menu,
			'data' => $this->data,
		]);
	}

	public function lokal()
	{
		$this->view = 'radius/lokal';
		$this->title =  'Radius Lokal';
		$this->data =  Radius::getWhere(['satker_code' => Identity::take(['kode_satker'])['kode_satker']])->result();
		return $this->index();
	}
	public function nasional()
	{
		$this->view = 'radius/nasional';
		$this->title =  'Radius Nasional';
		$this->data =  $this->SIPP->pengadilan_agama();

		return $this->index();
	}
}

/* End of file Radius.php */
