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
		auth()->user();
		auth()->jurusita();
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
	private static function id()
	{
		return isset(get_instance()->session->userdata('jurusita')['id']) ? get_instance()->session->userdata('jurusita')['id'] : '';
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
		$this->view = 'baru';
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 0)->where('jurusita_id', self::id())->get()->result();
		return $this->index();
	}
	public function control()
	{
		$this->title = 'Panggilan Yang di Kirim';
		$this->view = 'control';
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 1)->where('jurusita_id', self::id())->get()->result();
		return $this->index();
	}
	private static function cekProses($id)
	{
		$cek = Tabayun_proses_masuk::getWhere(['delegasi_id' => $id])->row();
		if (!$cek) {
			$id = Tabayun_proses_masuk::insertAndGetId([
				'delegasi_id' => $id,
				'status_delegasi' => 1,
				'diinput_oleh' => event()->inputBy(),
				'diinput_tanggal' => event()->inputAt()
			]);
			return Tabayun_proses_masuk::getWhere(['delegasi_id' => $id])->row();
		} else {
			return $cek;
		}
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
		$this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->where('status_kirim', 1)->where('jurusita_id', self::id())->get()->result();
		$this->view = 'biaya';
		return $this->index();
	}
	public function listActive()
	{
		$data = $this->SIPP->jurusitaaktif();
		$cangkang = [];
		foreach ($data as $d) {
			$cangkang[$d->id] = $d->nama_gelar;
		}
		echo json_encode($cangkang);
	}
	public function setJurusita()
	{
		self::cekProses(req()->post()->delegasi_id);
		Tabayun_proses_masuk::update([
			'jurusita_id' => req()->post()->id_js,
			'tgl_penunjukan_jurusita' => event()->inputAt(),
			'jurusita_nama' => $this->SIPP->customQuery("SELECT * FROM jurusita WHERE id =" . req()->post()->id_js)->row()->nama_gelar,
			'diperbaharui_oleh' => event()->inputBy(),
			'diperbaharui_tanggal' => event()->inputAt()
		], [
			'delegasi_id' => req()->post()->delegasi_id
		]);
		Tabayun_proses_masuk::update(['status_delegasi' => 2], ['delegasi_id' => req()->post()->delegasi_id]);
		Notifikasi::flash('success', 'Jurusita Telah di Tunjuk');
		echo Notifikasi::swal('success', 'Jurusita Berhasil di Tunjuk');
	}
}

/* End of file Jurusita.php */
