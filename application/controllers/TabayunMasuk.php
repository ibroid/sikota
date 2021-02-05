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
    auth()->user();
    $this->load->library('Components');
    $this->load->library('notifikasi');
    $this->load->library('files');
    $this->load->model('sub_menu');
    $this->load->model('SIPP');
    $this->load->model('identity');
    $this->load->model('nomor_surat');
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
        foreach ($hasil['data'] as $h) {
          unset($h['pull_status']);
          unset($h['__v']);
          self::retriveFile($h, Tabayun_masuk::insertAndGetId($h));
        }
        Notifikasi::flash('success', count($hasil['data']) . ' Data Telah Di Tambahkan');
        return Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
        break;
      default:
        return Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
        break;
    }
  }
  public function save()
  {
    if ($_FILES['file']['name'] != null) $filename =  $this->upload($_FILES);
    Tabayun_file_masuk::insert([
      'delegasi_id' => Tabayun_masuk::insertAndGetId(requestAll()),
      'file' => isset($filename) ? $filename : 'imal',
      'status_file' => 'File Pengajuan',
      'diinput_oleh' => event()->inputBy(),
      'diinput_tanggal' => event()->inputBy()
    ]);
    Notifikasi::flash('success', 'Data Tabayun Masuk baru telah ditambahkan', 'notif');
    redirect('TabayunMasuk/daftar', 'refresh');
  }

  private function upload()
  {

    $config['upload_path'] = './uploads/surat/masuk/';
    $config['max_width']  = '2048';
    $config['allowed_types'] = '*';
    $config['file_name'] = Ramsey\Uuid\Uuid::uuid4();
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file')) {
      Notifikasi::flash('danger',  $this->upload->display_errors(), 'file');
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      return $this->upload->data('file_name');
    }
  }

  public function hapus()
  {
    CI_Defender::zeroReferer()->secure();
    echo self::delete();
  }
  private static function delete()
  {
    $res = Tabayun_masuk::getWhere(['id' => request('id')])->row();
    if (empty($res)) {
      return Notifikasi::swal('error', 'Data Tidak Ditemukan, Silahkan Refresh');
    } else {
      Tabayun_masuk::delete(['id' => request('id')]);
      Tabayun_file_masuk::delete(['delegasi_id' => request('id')]);
      Tabayun_proses_masuk::delete(['delegasi_id' => request('id')]);
      Tabayun_file_keluar::delete(['delegasi_id' => request('id')]);
      self::deleteFileBalasan(request('id'));
      return Notifikasi::swal('success', 'Data Berhasil di Hapus');
    }
  }
  private static function deleteFileBalasan($id)
  {
    $files = Tabayun_file_keluar::getWhere(['delegasi_id' => $id])->result();
    foreach ($files as $no => $file) {
      Files::delete('uploads/surat/keluar/' . $file->file);
    }
  }
  private static function retriveFile($data, $id)
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/get_file_request', [
      GuzzleHttp\RequestOptions::JSON => [
        'tabayun_request_id' => $data['_id']
      ]
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    foreach ($hasil['data'] as $file) {
      Tabayun_file_masuk::insert([
        'delegasi_id' => $id,
        'file' => base_api() . 'request/' . $file['file_name'],
        'status_file' => "File Pengajuan",
        'diinput_oleh' => event()->inputBy(),
        'diinput_tanggal' => event()->inputAt(),
        'id_pn_asal' => $data['id_pn_asal'],
        'id_pn_tujuan' => $data['perkara_id']
      ]);
    }
  }
  public function proses($id = null)
  {
    CI_Defender::zeroReferer()->secure();
    $this->data = Tabayun_masuk::findOrDie(['id' => $id])->row();
    $this->data->proses = self::cekProses($this->data);
    $this->data->files = Tabayun_file_masuk::getWhere(['delegasi_id' => $id])->result();
    $this->data->hasil = Tabayun_file_keluar::getWhere(['delegasi_id' => $id])->result();
    $this->title = 'Proses Tabayun Masuk';
    $this->view = 'tabayun_masuk/proses';
    $this->index();
  }
  private static function cekProses($data)
  {
    $cek = Tabayun_proses_masuk::getWhere(['delegasi_id' => $data->id])->row();
    if (!$cek) {
      $id = Tabayun_proses_masuk::insertAndGetId([
        'delegasi_id' => $data->id,
        'status_delegasi' => 1,
        'diinput_oleh' => event()->inputBy(),
        'diinput_tanggal' => event()->inputAt()
      ]);
      return Tabayun_proses_masuk::getWhere(['delegasi_id' => $data->id])->row();
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
          'diperbaharui_oleh' => event()->inputBy(),
          'diperbaharui_tanggal' => event()->inputAt()
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
      $config['file_name'] = Ramsey\Uuid\Uuid::uuid4();
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
    CI_Defender::zeroReferer()->setReferer(base_url('TabayunMasuk/proses/') . request('id'))->secure();

    $tpm = Tabayun_proses_masuk::getWhere(['delegasi_id' => request('id')])
      ->row_array();
    $tm = Tabayun_masuk::getWhere(['id' => request('id')])
      ->row_array();
    if ($tm['status_kirim'] == 1) {
      echo Notifikasi::swal('warning', 'Tabayun Ini Sudah di Kirim');
      die;
    }
    $data = array_merge($tpm, [
      'id_pn_asal' => Identity::take(['IDPN'])['IDPN'],
      'id_pn_tujuan' =>  $tm['id_pn_tujuan'],
      'id_from_client' => $tm['id_from_client']
    ]);

    try {
      $hasil = self::sendData($data);
      $this->sendFile(Tabayun_file_keluar::getWhere(['delegasi_id' => request('id')])->result_array(), $hasil['data']['_id']);
      self::updateStatus(request('id'));
      echo Notifikasi::swal($hasil['icon'] . ' : ' . $hasil['status'], $hasil['message']);
    } catch (\Throwable $th) {
      echo Notifikasi::swal('error', 'Server Sedang Perbaikan');
    }
  }
  private static function sendData($data)
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/response', [
      GuzzleHttp\RequestOptions::JSON => $data
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    return $hasil;
  }
  public function hapusFileBalasan()
  {
    CI_Defender::zeroReferer()->setReferer(base_url('TabayunMasuk/proses/') . request('id'))->secure();
    if (Files::delete('uploads/surat/keluar/' . request('file')) == true) {
      Tabayun_file_keluar::delete(['file' => request('file')]);
      Notifikasi::flash('warning', 'File Telah di Hapus');
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      echo Files::delete('uploads/surat/keluar/' . request('file'));
    }
  }
  private function sendFile($data, $id)
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    foreach ($data as $no => $file) {
      $client->post('api/tabayun/upload_file_response', [
        GuzzleHttp\RequestOptions::MULTIPART =>  [
          [
            'name' => 'data', 'contents' => json_encode($id)
          ],
          [
            'name' => 'doc',
            'contents' => file_exists(FCPATH . 'uploads/surat/keluar/' . $file['file']) ? fopen(FCPATH . 'uploads/surat/keluar/' . $file['file'], 'r') : json_encode('file doesnt exist in client')
          ]
        ]
      ]);
    }
  }
  private static function updateStatus($id)
  {
    Tabayun_masuk::update(['status_kirim' => 1], ['id' => $id]);
  }
  public function control()
  {
    $this->title = 'Control Data Tambah Tabayun Masuk';
    $this->view = 'tabayun_masuk/control';
    $this->data = Tabayun_masuk::select('tabayun_masuk.id as iid,tabayun_masuk.*,tabayun_proses_masuk.*')->join('tabayun_proses_masuk', 'delegasi_id = tabayun_masuk.id', 'LEFT')->get()->result();
    $this->index();
  }
  public function wesel()
  {
    $this->title = 'Wesel Masuk';
    $this->view = 'tabayun_masuk/wesel';
    return $this->index();
  }
  public function edit($id = null)
  {
    if ($id == null) redirect($_SERVER['HTTP_REFERER'], 'refresh');
    CI_Defender::zeroReferer()->secure();
    $this->data = Tabayun_masuk::findOrDie(['id' => $id])->row();
    $this->data->file = Tabayun_file_masuk::getWhere(['delegasi_id' => $id])->result();
    $this->title = 'Edit Tabayun Masuk';
    $this->view = 'tabayun_masuk/edit';
    return $this->index();
  }

  public function hapusFilePengantar()
  {
    Files::delete('uploads/surat/masuk/', request('filename'));
    Tabayun_file_masuk::delete(['file' => request('filename')]);
    echo Notifikasi::swal('success', 'File Berhasil di Hapus');
  }
  public function update()
  {
    if ($_FILES['file']['name'] != null) {
      $filename =  $this->upload($_FILES);
      Tabayun_file_masuk::insert([
        'delegasi_id' => request('id'),
        'file' => isset($filename) ? $filename : 'imal',
        'status_file' => 'File Pengajuan',
        'diinput_oleh' => event()->inputBy(),
        'diinput_tanggal' => event()->inputBy()
      ]);
    }
    Tabayun_masuk::update(requestAll(), ['id' => request('id')]);
    Notifikasi::flash('success', 'Data Tabayun Masuk baru telah di Perbaharui', 'notif');
    redirect('TabayunMasuk/daftar', 'refresh');
  }
}

/* End of file TabayunMasuk.php */
