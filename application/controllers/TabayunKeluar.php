<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

require_once APPPATH . 'libraries/Validation.php';
require_once APPPATH . 'libraries/Notifikasi.php';
require_once APPPATH . 'models/Tabayun_keluar.php';
require_once APPPATH . 'models/Cetak_model.php';
require_once APPPATH . 'resource/TabayunKeluarResource.php';

class TabayunKeluar extends CI_Controller
{

  public $submenu = '';
  public $title = 'Tabayun Keluar';
  public $list = [];
  public $view = 'tambah';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SIPP');
    $this->load->model('nomor_surat');
    $this->load->model('tabayun_file_keluar');
    $this->load->library('components');
    $this->load->library('files');
    $this->submenu = $this->db->get_where('sub_menu', ['id_menu' => 2])->result();
  }

  public function index()
  {
    $this->templating->load('template/master', 'tabayun_keluar/' . $this->view, [
      'title' => $this->title,
      'sub_menu' => $this->submenu,
      'data' => $this->list
    ]);
  }

  public function tambah()
  {
    $this->title = 'Tambah Tabayun Keluar';
    $this->index();
  }

  public function daftar()
  {
    $this->title = 'Tabayun Keluar';
    $this->list = null;
    $this->view = 'daftar';
    $this->index();
  }

  public function save()
  {
    $validate = Validation::make(requestAll(), 'required|trim');
    if ($validate == FALSE) {
      Notifikasi::flash('danger', 'Pastikan Semua Form Telah Terisi');
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    } else {
      $_POST['nomor_surat'] = Nomor_surat::tabayunKeluar();
      $this->db->insert('tabayun_keluar', array_merge(requestAll(), self::completingdata(), [
        'created_by' => event()->inputBy(),
        'tgl_pengiriman' => request('tgl_surat'),
      ]));
      Nomor_surat::saveUpdate();
      Notifikasi::flash('success', 'Data Berhasil di Tambahkan');
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
  }

  public static function completingdata()
  {
    $these = parent::get_instance();
    $perkara_id = $these->SIPP->customWhere('perkara_id,jenis_perkara_text,para_pihak', [
      [
        'value' => req()->post()->nomor_perkara,
        'field' => 'nomor_perkara'
      ]
    ], 'perkara');
    $identity = $these->SIPP->sysConfig(['IDPN', 'kode_satker', 'NamaPN']);
    $destination = $these->SIPP->customWhere('id,kode', [
      [
        'value' => req()->post()->pn_tujuan_text,
        'field' => 'nama'
      ]
    ], 'pengadilan_negeri');
    $identity['kode_satker_asal'] = $identity['kode_satker'];
    $identity['id_pn_asal'] = $identity['IDPN'];
    $identity['pn_asal_text'] = $identity['NamaPN'];
    unset($identity['kode_satker']);
    unset($identity['IDPN']);
    unset($identity['NamaPN']);
    return array_merge($identity, array(
      'kode_satker_tujuan' => $destination[0]->kode,
      'id_pn_tujuan' => $destination[0]->id,
      'perkara_id' => $perkara_id[0]->perkara_id,
      'para_pihak' => $perkara_id[0]->para_pihak,
      'jenis_perkara_text' => $perkara_id[0]->jenis_perkara_text,
      'status_pihak' => self::statusPihak($perkara_id[0]->jenis_perkara_text, request('status_pihak'))
    ));
  }
  public function proses($id = '')
  {
    $this->list = Tabayun_keluar::findOrDie(['id' => $id])->row_array();
    if (empty($this->list) || $id = '') {
      $this->output->set_status_header('404');
      echo "404 - not found";
      die;
    } else {
      if ($this->list['status_kirim'] == 1) {
        $this->output->set_status_header('404');
        echo "404 - not found";
        die;
      }
      $this->list['file'] = Tabayun_file_keluar::getWhere(['delegasi_id' => $this->list['id']])->result_array();
      $this->view = 'proses';
      $this->data['title'] = 'Proses Tabayun keluar';
      $this->index();
    }
  }

  public static function statusPihak($jenisPerkara, $status)
  {
    $SIPP = new SIPP;
    $resultG = [];
    foreach ($SIPP->customQuery("SELECT alur_perkara_id, jenis_perkara_id AS id,nama_lengkap AS nama
    FROM jenis_alur_perkara AS j, jenis_perkara AS p
    WHERE j.jenis_perkara_id = p.id AND j.alur_perkara_id = 15 ORDER BY nama_lengkap ASC")->result_array() as $each) {
      array_push($resultG, $each['nama']);
    }
    $resultP = [];
    foreach ($SIPP->customQuery("SELECT alur_perkara_id, jenis_perkara_id AS id,nama_lengkap AS nama
    FROM jenis_alur_perkara AS j, jenis_perkara AS p
    WHERE j.jenis_perkara_id = p.id AND j.alur_perkara_id = 16 ORDER BY nama_lengkap ASC")->result_array() as $each) {
      array_push($resultP, $each['nama']);
    }
    if (in_array($jenisPerkara, $resultG)) {
      if ($jenisPerkara === 'Cerai Talak') {
        return $status . 'mohon';
      } else {
        if ($status == 'Pe' || $status == 'Kuasa Hukum Pe') {
          return $status . 'ngugat';
        } else {
          return $status . 'gugat';
        }
      }
    }
    if (in_array($jenisPerkara, $resultP)) {
      return $status . 'mohon';
    }
  }

  public static function resource()
  {
    return TabayunkeluarResource::setDatatable(request('status'))->datatableResource();
  }

  public function update()
  {
    if (!in_array(4, $_FILES['document']['error'])) {
      foreach ($_FILES['document']['name'] as $i => $value) {
        $_FILES['document' . $i] = array(
          'name' => $_FILES['document']['name'][$i],
          'type' => $_FILES['document']['type'][$i],
          'tmp_name' => $_FILES['document']['tmp_name'][$i],
          'error' => $_FILES['document']['error'][$i],
          'size' => $_FILES['document']['size'][$i],
        );
        Tabayun_file_keluar::insert([
          'delegasi_id' => request('id'),
          'id_pn_asal' => request('id_pn_asal'),
          'id_pn_tujuan' => request('id_pn_tujuan'),
          'file' =>  $this->upload('document' . $i),
          'status_file' => 1,
          'perkara_id' => request('perkara_id'),
          'diinput_oleh' => 'Web Master',
          'diinput_tanggal' => date('yy-m-d')
        ]);
      }
      Notifikasi::flash('success', 'Upload Berhasil', 'upload');
    }
    if (count(requestAll()) == 4) {
      Notifikasi::flash('warning', 'Data Tidak ada yang berubah');
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    } else {
      $id = request('id');
      unset($_POST['id']);
      Tabayun_keluar::update(array_merge(requestAll(), [
        'created_by' => event()->inputBy(),
        'updated_at' => event()->updatedAt()
      ]), [
        'id' => $id
      ]);
      Notifikasi::flash('success', 'Data Berhasil di perbaharui');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  public function upload($par)
  {
    if ($par == '') {
      $this->output->set_status_header('404');
      echo 'Not Found';
      die;
    }
    $config['upload_path'] = './uploads/surat/keluar';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc|pdf|rtf';
    $config['max_size'] = '2024';
    $config['file_name'] = Ramsey\Uuid\Uuid::uuid1();
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload($par)) {
      Notifikasi::flash('danger', $this->upload->display_errors());
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    } else {
      return $this->upload->data('file_name');
    }
  }
  public function deleteFile()
  {
    if (!request('id')) {
      $this->output->set_status_header('404');
      echo "404 - not found";
    } else {
      $filename = Tabayun_file_keluar::findOrDie(['id' => request('id')])->row()->file;
      Tabayun_file_keluar::delete(['id' => request('id')]);
      Files::delete('uploads/surat/keluar/', $filename);
      echo json_encode(array(
        'title' => ucfirst('success'),
        'text' => 'Sukses',
        'icon' => 'success',
      ));
    }
  }
  public function hapus()
  {
    echo self::delete();
  }
  private static function delete()
  {
    $res = Tabayun_keluar::getWhere(['id' => request('id')])->row();
    if (empty($res)) {
      return Notifikasi::swal('error', 'Data Tidak Ditemukan, Silahkan Refresh');
    } else {
      Tabayun_keluar::delete(['id' => request('id')]);
      return Notifikasi::swal('success', 'Data Berhasil di Hapus');
    }
  }
  public function sendData()
  {
    CI_Defender::noUriParameters('data')
      ->setReferer(base_url() . 'TabayunKeluar/proses/' . request('data'))
      ->zeroReferer()
      ->secure();
    $data = Tabayun_keluar::findOrDie(['id' => request('data')])->row_array();
    $data['id_from_client'] = $data['id'];
    unset($data['id']);
    try {
      echo self::requestAPI($data);
    } catch (\Throwable $th) {
      echo Notifikasi::swal('error', 'Server Sedang dalam Perbaikan');
    }
  }
  public function control()
  {
    $this->title = 'Tabayun Keluar';
    $this->view = 'control';
    $this->index();
  }
  private static function requestAPI($data)
  {
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $response = $client->post('api/tabayun/request', [
      GuzzleHttp\RequestOptions::JSON => $data
    ]);
    $hasil = json_decode($response->getBody()->getContents(), TRUE);
    if ($hasil['status'] == 200) {
      try {
        self::uploadAPI($data['id_from_client'], $hasil['data']['_id']);
        Tabayun_keluar::update(['status_kirim' => 1], ['id' => request('data')]);
        return Notifikasi::swal('success', $hasil['message'] . ':' . $hasil['data']['_id']);
      } catch (\Throwable $th) {
        return Notifikasi::swal('warning', 'Data berhasil di Kirim Tanpa file pengantar');
      }
    } else {
      return Notifikasi::swal('error', $hasil['message']);
    };
  }
  private static function uploadAPI($id, $_id)
  {
    $files = Tabayun_file_keluar::getWhere(['delegasi_id' => $id])->result();
    $body = [[
      'name' => 'data', 'contents' => json_encode($_id)
    ]];
    foreach ($files as $file) {
      array_push($body, [
        'name' => 'doc',
        'contents' => file_exists(FCPATH . 'uploads/surat/keluar/' . $file->file) ? fopen(FCPATH . 'uploads/surat/keluar/' . $file->file, 'r') : 'file doesnt exist in client'
      ]);
    }
    $client = new GuzzleHttp\Client(['base_uri' => base_api()]);
    $client->post('api/tabayun/upload_file_request', [
      GuzzleHttp\RequestOptions::MULTIPART => $body
    ]);
  }
}

/* End of file TabayunKeluar.php */
