<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/Notifikasi.php';
class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SIPP');
  }

  public function index()
  {
    $this->load->view('login');
  }
  public function proccess()
  {
    $req = $this->input;
    $set = $this->db->get_where('pengguna', ['username' => $req->post('username')]);
    $cek = $set->row();
    return $this->makeauth($cek, $set, $req);
  }
  private function makeauth($cek, $set, $req)
  {
    if ($cek) {
      if ($cek->password == hash('SHA256', $req->post('password'))) {
        if ($cek->role == 5) {
          $this->session->set_userdata([
            'jurusitadata' => $this->SIPP->customQuery("SELECT * FROM jurusita WHERE nama_gelar = '$cek->nama_lengkap'")->row_array(),
            'userdata' => $set->row_array(),
            'guard' => true
          ]);
        } else {
          $this->session->set_userdata([
            'userdata' => $set->row_array(),
            'guard' => true
          ]);
        }
        $this->session->set_userdata([
          'userdata' => $set->row_array(),
          'guard' => true
        ]);
        redirect('dashboard', 'refresh');
      } else {
        Notifikasi::flash('danger', 'Password Salah!');
        redirect($_SERVER['HTTP_REFERER']);
      }
    } else {
      Notifikasi::flash('danger', 'User Tidak Ada!');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function debug()
  {
    echo "<pre>";
    print_r($this->session->all_userdata());
    echo "</pre>";
  }
  public function destroy()
  {
    $this->session->sess_destroy();
    redirect('/login');
  }
}

/* End of file Login.php */
