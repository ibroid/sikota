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
    $this->load->model('tabayun_file_masuk');

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

  private static function retriveData()
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
        $_id = $hasil['data']['_id'];
        foreach ($hasil['data'] as $h) {
          unset($h['pull_status']);
          unset($h['_id']);
          unset($h['__v']);
          unset($h['id_from_client']);
          self::retriveFile($_id,   Tabayun_masuk::insertAndGetId($h));
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
  private static function retriveFile($_id, $id)
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/get_file_request', [
      GuzzleHttp\RequestOptions::JSON => [
        'tabayun_request_id' => $_id
      ]
    ]);
    $hasil = json_decode($response->getBody()->getContents());
    Tabayun_file_masuk::insert([
      'delegasi_id' => $id,
      'file' => $hasil->data->file_name,
      'status_file' => 0,
      'diinput_oleh' => event()->inputBy(),
      'diinput_tanggal' => event()->inputAt()
    ]);
  }
}

/* End of file TabayunMasuk.php */
