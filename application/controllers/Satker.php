<?php

use function Matrix\identity;

defined('BASEPATH') or exit('No direct script access allowed');

class Satker extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('notifikasi');
    $this->load->model('identity');
  }

  public function index()
  {
    if ($_FILES['file']['error'] == 0) {
      echo self::deleteOldLogo();
      Identity::update(['Value' => $this->upload()], ['name' => 'Logo']);
    }
    if (isset($_POST['NamaPN'])) {
      foreach (requestAll() as $req => $value) {
        Identity::update(['value' => $value], ['name' => $req]);
      }
      Notifikasi::flash('success', 'Identitas Satker Berhasil di Update');
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    } else {
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
  }
  public function upload()
  {
    $filename = time();
    $config['upload_path'] = './assets/logo/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '1024';
    $config['file_name'] = $filename;
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('file')) {
      Notifikasi::flash('danger', $this->upload->display_errors());
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    } else {
      return $filename . $this->upload->data()['file_ext'];
    }
  }
  public static function deleteOldLogo()
  {
    $filename = Identity::getWhere(['name' => 'Logo'])->row()->value;
    if (file_exists(FCPATH . 'assets/logo/' . $filename)) {
      if (unlink(FCPATH . 'assets/logo/' . $filename)) {
        return 'File Berhasil di Hapus';
      } else {
        return 'File Gagal di Hapus';
      }
    } else {
      return 'File Tidak Ada';
    }
  }
  public function sync()
  {
    Identity::sync();
    Notifikasi::flash('success', 'Identitas Berhasil di Sinkronisasi dengan Data SIPP');
    redirect($_SERVER['HTTP_REFERER'], 'refresh');
  }
}

/* End of file Satker.php */
