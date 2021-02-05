<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public $data;
  public $sub_menu;
  public $title;

  public function __construct()
  {
    parent::__construct();
    auth()->user();
    $this->load->model('sub_menu');
    $this->load->library('templating');
    $this->load->library('components');
    $this->sub_menu = Sub_menu::getWhere(['id_menu' => 1])->result();
  }


  public function index()
  {
    switch (auth()::$level) {
      case '1':
        return $this->admin();
        break;
      case '2':
        return $this->surat();
        break;
      case '3':
        return $this->tabayunMasuk();
        break;
      case '4':
        return $this->tabayunKeluar();
        break;
      case '5':
        return $this->jurusita();
        break;
    }
  }
  public function admin()
  {
    Templating::render('dashboard/admin', [
      'data' => $this->data,
      'sub_menu' => $this->sub_menu,
      'title' => 'Dashboard ' . auth()::$nama_lengkap
    ]);
  }
  public function surat()
  {
    Templating::render('dashboard/admin', [
      'data' => $this->data,
      'sub_menu' => $this->sub_menu,
      'title' => 'Dashboard ' . auth()::$nama_lengkap
    ]);
  }
  public function tabayunMasuk()
  {
    Templating::render('dashboard/admin', [
      'data' => $this->data,
      'sub_menu' => $this->sub_menu,
      'title' => 'Dashboard ' . auth()::$nama_lengkap
    ]);
  }
  public function tabayunKeluar()
  {
    Templating::render('dashboard/admin', [
      'data' => $this->data,
      'sub_menu' => $this->sub_menu,
      'title' => 'Dashboard ' . auth()::$nama_lengkap
    ]);
  }
  public function jurusita()
  {
    Templating::render('dashboard/admin', [
      'data' => $this->data,
      'sub_menu' => $this->sub_menu,
      'title' => 'Dashboard ' . auth()::$nama_lengkap
    ]);
  }
}

/* End of file Dashboard.php */
