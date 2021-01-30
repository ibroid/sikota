<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    auth()->user();
    $this->load->model('sub_menu');
  }


  public function index()
  {
    $this->templating->load('template/master', 'page/dashboard');
  }
}

/* End of file Dashboard.php */
