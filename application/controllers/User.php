<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    auth()->user();
    $this->load->model('pengguna');
    $this->load->library('validation');
    $this->load->library('notifikasi');
  }

  public function index()
  {
    if ($_FILES['file']['error'] == 0) {
      Pengguna::insert(array_merge(requestAll(), ['foto' => $this->upload()]));
    } else {
      if (Validation::make(requestAll(), 'required|trim') != FALSE) {
        Pengguna::insert([
          'username' => req()->post()->username,
          'nama_lengkap' => req()->post()->nama_lengkap,
          'email' => req()->post()->email,
          'nomor_telepon' => req()->post()->nomor_telepon,
          'password' => hash('SHA256', req()->post()->password),
          'slug' => str_replace(' ', '-', req()->post()->nama_lengkap),
          'level' => req()->post()->level,
          'foto' => req()->post()->foto
        ]);
        Notifikasi::flash('success', 'User Baru Telah di Tambahkan');
        redirect('konfigurasi/user', 'refresh');
      } else {
        Notifikasi::flash('danger', 'Periksa Kembali Form');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
      }
    }
  }

  public function upload()
  {
    $filename = time();
    $config['upload_path'] = './assets/backend/img';
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

  public function update()
  {
    if (!isset($_POST['slug'])) {
      $this->output->set_status_header('404');
      echo "404 - not found";
    } else {
      if ($_FILES['file']['error'] == 0) {
        Pengguna::update(['foto' => $this->upload()], ['slug' => req()->post()->slug]);
        Pengguna::update(requestAll(), ['slug' => req()->post()->slug]);
      } else {
        Pengguna::update(requestAll(), ['slug' => req()->post()->slug]);
      }
    }
    Notifikasi::flash('success', 'User Berhasil di Update');
    redirect('konfigurasi/user');
  }

  public function delete($par = '')
  {
    if ($par == '') {
      $this->output->set_status_header('404');
      echo "404 - not found";
    } else {
      Pengguna::delete(['slug' => $par]);
    }
    Notifikasi::flash('success', 'User Berhasil di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }
}

/* End of file User.php */
