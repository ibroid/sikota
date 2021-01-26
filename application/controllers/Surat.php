<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/Notifikasi.php';
require APPPATH . 'libraries/Templating.php';
require APPPATH . 'libraries/Components.php';
class Surat extends CI_Controller
{

	public $data;
	public $title;
	public $subMenu;
	public $view;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_masuk');
		$this->load->model('sub_menu');
		if ($this->uri->segment(2) == '') {
			redirect('Surat/masuk', 'refresh');
		}
	}
	public function index()
	{
		Templating::render('surat/' . $this->view, [
			'data' => $this->data,
			'title' => $this->title,
			'sub_menu' => $this->subMenu
		]);
	}
	public function masuk()
	{
		$this->subMenu = Sub_menu::getWhere(['id_menu' => 4])->result();
		$this->title = 'Surat Masuk';
		$this->view = 'masuk';
		return $this->index();
	}
	public function Keluar()
	{
		$this->subMenu = Sub_menu::getWhere(['id_menu' => 4])->result();
		$this->title = 'Surat Masuk';
		$this->view = 'keluar';
		return $this->index();
	}
}


/* End of file Surat.php */