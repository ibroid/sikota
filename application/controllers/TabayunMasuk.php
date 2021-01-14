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
    $this->load->model('tabayun_file_keluar');
    $this->load->model('tabayun_proses_masuk');

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
        $_id = $hasil['data'][0]['_id'];
        foreach ($hasil['data'] as $h) {
          unset($h['pull_status']);
          unset($h['_id']);
          unset($h['__v']);
          self::retriveFile($_id, Tabayun_masuk::insertAndGetId($h));
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
        'tabayun_request_id' => '"' . $_id . '"'
      ]
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    return Tabayun_file_masuk::insert([
      'delegasi_id' => $id,
      'file' => base_api() . 'request/' . $hasil['data']['file_name'],
      'status_file' => 0,
      'diinput_oleh' => event()->inputBy(),
      'diinput_tanggal' => event()->inputAt()
    ]);
  }
  public function proses($id = null)
  {
    $this->data = Tabayun_masuk::findOrDie(['id' => $id])->row();
    $this->data->proses = self::cekProses($this->data);
    $this->data->files = Tabayun_file_keluar::getWhere(['delegasi_id' => $id])->result();
    $this->title = 'Proses Tabayun Masuk';
    $this->view = 'tabayun_masuk/proses';
    $this->index();
  }
  private static function cekProses($data)
  {
    $cek = Tabayun_proses_masuk::getWhere(['delegasi_id' => $data->id])->row();
    if (!$cek) {
      Tabayun_proses_masuk::insert([
        'delegasi_id' => $data->id,
        'status_delegasi' => 1,
        'diinput_oleh' => event()->inputBy(),
        'diinput_tanggal' => event()->inputAt()
      ]);
    } else {
      return $cek;
    }
  }
  public function updateProses($to, $id)
  {
    CI_Defender::zeroReferer()->secure();
    $oldStatus = Tabayun_proses_masuk::getWhere(['delegasi_id' => $id])->row()->status_delegasi;
    switch ($to) {
      case '2':
        Tabayun_proses_masuk::update([
          'jurusita_id' => req()->post()->jurusita_id,
          'tgl_penunjukan_jurusita' => req()->post()->tgl_penunjukan_jurusita,
          'jurusita_nama' => $this->SIPP->customQuery("SELECT * FROM jurusita WHERE id =" . req()->post()->jurusita_id)->row()->nama_gelar,
        ], [
          'delegasi_id' => $id
        ]);
        if ($oldStatus < $to) {
          Tabayun_proses_masuk::update(['status_delegasi' => $to], ['delegasi_id' => $id]);
        }
        break;
      case '5':
        Tabayun_file_keluar::insert([
          'file' => $this->uploadFileBalasan(),
          'delegasi_id' => $id,
          'status_file' => 2,
          'diinput_oleh' => event()->inputBy(),
          'diinput_tanggal' => event()->inputAt(),
        ]);
        if ($oldStatus < $to) {
          Tabayun_proses_masuk::update(['status_delegasi' => $to], ['delegasi_id' => $id]);
        }
        break;
      default:
        Tabayun_proses_masuk::update(requestAll(), ['delegasi_id' => $id]);
        if ($oldStatus < $to) {
          Tabayun_proses_masuk::update(['status_delegasi' => $to], ['delegasi_id' => $id]);
        }
        break;
    }
    Notifikasi::flash('success', 'Delegasi Berhasil Di Proses');
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function uploadFileBalasan()
  {
    try {
      $config['upload_path'] = './uploads/surat/keluar';
      $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc|pdf|rtf';
      $config['max_size'] = '2024';
      $config['file_name'] = Ramsey\Uuid\Uuid::uuid1();
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        Notifikasi::flash('danger', $this->upload->display_errors());
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
      } else {
        return $this->upload->data('file_name');
      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function kirimBalasan()
  {
  }
}

/* End of file TabayunMasuk.php */
