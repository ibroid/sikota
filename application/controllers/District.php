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

	public function komdanas()
	{
		echo "<pre>";
		print_r(json_decode(file_get_contents("http://komdanas.mahkamahagung.go.id/jsons/radius04.json"), TRUE));
		echo "</pre>";
	}
	public function delete_before()
	{
		return $this->db->empty_table('radius');
	}
	public function sync()
	{
		$no = 1;
		$this->delete_before();
		foreach (json_decode(file_get_contents("http://komdanas.mahkamahagung.go.id/jsons/radius04.json")) as $d) {
			$this->db->insert('radius', $d);
			echo $no++. ". Insert Data Success <br>";
		}
		redirect("Radius/nasional");
	} 
}

/* End of file Radius.php */
