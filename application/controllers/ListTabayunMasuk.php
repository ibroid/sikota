<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Validation.php';
require_once APPPATH . 'libraries/Notifikasi.php';

class ListTabayunMasuk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('notifikasi');
    $this->load->model('Tabayun_masuk', 'ltm');
    $this->load->model('SIPP');
  }

  public function index()
  {

    $data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 3])->result();
    $data['title'] = 'Tabayun Masuk';
    $this->templating->load('template/master', 'tabayun_masuk/list', $data);
  }


  public function ajax_list()
  {
    $list = $this->ltm->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $ltm) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $ltm->pn_asal_text;
      $row[] = $ltm->nomor_perkara . '<br>' . $ltm->jenis_delegasi_text . '<br>' . $ltm->tgl_sidang;
      $row[] = $ltm->pihak . '<br>' . $ltm->alamat_pihak;
      $row[] = $ltm->nomor_surat. '<br>' . $ltm->tgl_delegasi;
      $row[] = $ltm->biaya . '<br>' . $ltm->nomor_resi;
      $row[] = '<a data-toggle=modal href=#modalTunjukJS><p><center>[ Pilih ]</center></p></a>' . '<p class=text-danger text-muted><center>badge status</center></p>' . '<p><center>waktu proses</center></p>';
      $row[] = '<a data-toggle=modal href=#modalPelaksanaan><p><center>[Pelaksanaan]</center></p></a>' . '<p><center>asal data</center></p>' . '<p><center>Status Wesel</center></p>';
      //$row[] =  "<div class='btn-group' role='group'>
      //            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      //            Pilih Aksi
      //            <span class='fa fa-angle-down'></span>
      //            </button>
      //           <ul class='dropdown-menu  pull-right '>
      //                <li><a class='waves-effect' href='' target='_blank'>Penunjukan</a></li>      
      //                <li><a class='waves-effect' href='' target='_blank'>Edit</a></li>  
      //                <li><a class='waves-effect' href='' target='_blank'>Hapus</a></li>
      //            </ul>
              //</div>";

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->ltm->count_all(),
      "recordsFiltered" => $this->ltm->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }




}

/* End of file TabayunMasuk.php */
