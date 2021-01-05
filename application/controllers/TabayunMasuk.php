<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'resource/TabayunMasukResource.php';
class TabayunMasuk extends CI_Controller
{

  public $data;
  public $view;
  public $title;

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Components');
    $this->load->library('notifikasi');
    $this->load->model('sub_menu');
    $this->load->model('SIPP');
    $this->load->model('identity');

    if ($this->uri->segment(2) == '') {
      redirect('TabayunMasuk/tambah', 'refresh');
    }
  }

  public function index()
  {
    Templating::render($this->view, [
      'data' => $this->data,
      'title' => $this->title,
      'sub_menu' => Sub_menu::getWhere(['id_menu' => 3])->result()
    ]);
  }

  public function tambah()
  {
    $this->title = 'Tambah Tabayun Masuk';
    $this->view = 'tabayun_masuk/tambah';
    $this->index();
  }

  public function daftar()
  {
    $this->title = 'Daftar Tabayun Masuk';
    $this->view = 'tabayun_masuk/daftar';
    $this->index();
  }

  public static function resource()
  {
    return TabayunMasukResource::setDatatable(request('status'))->datatableResource();
  }

  public function cek_tabayun_masuk()
  {
    CI_Defender::zeroReferer()->secure();
    echo self::retriveData();
  }

  private static function retriveData()
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/get_request', [
      GuzzleHttp\RequestOptions::JSON => [
        'identity_id' => Identity::take(['IDPN'])['IDPN']
      ]
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    if ($hasil['status'] == 200) {
      Tabayun_keluar::update(['status_kirim' => 1], ['id' => request('data')]);
      return Notifikasi::swal('success : ' . $hasil['status'], $hasil['message']);
    } else {
      return Notifikasi::swal('error : ' . $hasil['status'], $hasil['message']);
    };
  }
}

/* End of file TabayunMasuk.php */
