<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'resource/TabayunMasukResource.php';
require_once APPPATH . 'models/Tabayun_masuk.php';
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
    try {
      echo self::retriveData();
    } catch (\Throwable $th) {
      echo Notifikasi::swal('error', 'Server Sedang Dalam Perbaikan');
    }
  }

  public static function retriveData()
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/get_request', [
      GuzzleHttp\RequestOptions::JSON => [
        'identity_id' => Identity::take(['IDPN'])['IDPN']
      ]
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    switch ($hasil['status']) {
      case 200:
        foreach ($hasil['data'] as $h) {
          unset($h['pull_status']);
          unset($h['_id']);
          unset($h['__v']);
          unset($h['id_from_client']);
          Tabayun_masuk::insert($h);
        }
        Notifikasi::flash('success', count($hasil['data']) . ' Data Telah Di Tambahkan');
        return Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
        break;
      case 202:
        return Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
        break;
      default:
        return Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
        break;
    }
  }
  public function hapus()
  {
    echo self::delete();
  }
  private static function delete()
  {
    $res = Tabayun_masuk::getWhere(['id' => request('id')])->row();
    if (empty($res)) {
      return Notifikasi::swal('error', 'Data Tidak Ditemukan, Silahkan Refresh');
    } else {
      Tabayun_masuk::delete(['id' => request('id')]);
      return Notifikasi::swal('success', 'Data Berhasil di Hapus');
    }
  }
}

/* End of file TabayunMasuk.php */
