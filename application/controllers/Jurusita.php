<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Jurusita extends CI_Controller
{
	public $data;
	public $subMenu;
	public $title;
	public $view;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tabayun_masuk');
		$this->load->model('tabayun_proses_masuk');
		$this->load->model('tabayun_file_masuk');
		$this->load->model('tabayun_file_keluar');
		$this->load->model('SIPP');
		$this->load->library('components');
		$this->load->library('files');
		$this->load->library('notifikasi');
		$this->submenu = $this->db->get_where('sub_menu', ['id_menu' => 6])->result();
		if ($this->uri->segment(2) == '') {
			redirect('Jurusita/baru', 'refresh');
		}
	}
	public function index()
	{
		$this->templating->load('template/master', 'jurusita/' . $this->view, [
			'title' => $this->title,
			'sub_menu' => $this->submenu,
			'data' => $this->data
		]);
	}
	public function baru()
	{
		$this->title = 'Panggilan Baru';
		$me = 5;
		$this->view = 'baru';
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 0)->where('jurusita_id', $me)->get()->result();
		return $this->index();
	}
	public function control()
	{
		$this->title = 'Panggilan Yang di Kirim';
		$me = 5;
		$this->view = 'control';
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 1)->where('jurusita_id', $me)->get()->result();
		return $this->index();
	}
	public function proses($id = null)
	{
		CI_Defender::zeroReferer()->secure();
		$this->title = 'Proses Panggilan';
		$this->data = Tabayun_masuk::getWhere(['id' => $id])->row();
		$this->data->proses = Tabayun_proses_masuk::getWhere(['delegasi_id' => $id])->row();
		$this->data->files = Tabayun_file_masuk::getWhere(['delegasi_id' => $id])->result();
		$this->data->hasil = Tabayun_file_keluar::getWhere(['delegasi_id' => $id])->result();
		$this->view = 'proses';
		return $this->index();
	}
	public function biaya()
	{
		$this->title = 'Biaya Panggilan';
		$me = 5;
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 1)->where('jurusita_id', $me)->get()->result();
		$this->view = 'biaya';
		return $this->index();
	}
}

/* End of file Jurusita.php */
