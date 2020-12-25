
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TambahTabayunMasuk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('notifikasi');
  }

  public function index()
  {

    $data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 3])->result();
    $data['title'] = 'Tabayun Masuk';
    $this->templating->load('template/master', 'tabayun_masuk/tambah', $data);
  }
}

/* End of file TabayunMasuk.php */
