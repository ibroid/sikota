<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
}

/* End of file TabayunMasuk.php */
