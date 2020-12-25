<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Notifikasi.php';
require APPPATH . 'libraries/Components.php';

class Konfigurasi extends CI_Controller
{

  public $title = 'Konfigurasi';
  public $view = '';
  public $subMenu = [];
  public $data = [];

  public function __construct()
  {
    parent::__construct();
    $this->load->library('components');
    $this->load->model('radius');
    $this->load->model('Identity');
    $this->load->model('sub_menu');
    $this->load->model('pengguna');
    $this->load->model('role');
    $this->data['sub_menu'] = Sub_menu::getWhere(['id_menu' => 5])->result();
    if ($this->uri->segment(2) == '') {
      redirect('konfigurasi/satker', 'refresh');
    }
  }

  public function index()
  {
    Templating::render($this->view, $this->data);
  }

  public function satker()
  {
    $this->view = 'konfigurasi/satker';
    $this->data['title'] = $this->title . ' Satker';
    $this->data['sys_config'] = Identity::take([
      'NamaPN', 'KodePN', 'kode_satker', 'AlamatPN', 'Email', 'NomorTelepon', 'Logo', 'Website'
    ]);
    $this->index();
  }

  public function penomoran()
  {
    $nomor_surat = $this->db->get('nomor_surat')->row_array();
    if (!empty($nomor_surat)) {
      $data['penomoran'] = $nomor_surat;
    } else {
      $data['penomoran'] = array(
        'nomor_surat_awal' => '',
        'nomor_surat_ahir' => '',
        'kode_pengantar_tabayun' => '',
        'kode_tabayun_satker' => ''
      );
    }
    $data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 5],)->result();
    $this->templating->load('template/master', 'page/v_nomor_surat', $data);
  }

  public function tambah_nomor_surat()
  {
    $data = array(
      'nomor_surat_awal' => $this->input->post('nomor_surat_awal'),
      'nomor_surat_ahir' => $this->input->post('nomor_surat_awal'),
      'kode_pengantar_tabayun' => $this->input->post('kode_pengantar_tabayun'),
      'kode_tabayun_satker' => $this->input->post('kode_tabayun_satker')
    );
    $id = $this->db->get('nomor_surat')->row_array();
    if (!empty($id)) {
      $this->db->update('nomor_surat', $data, array('id' => $id['id']));
    } else {
      $this->db->insert('nomor_surat', $data);
    }
    Notifikasi::flash('success', 'Data Berhasil Di Update');
    redirect('Konfigurasi/penomoran');
  }

  public function user()
  {
    $this->data['title'] = $this->title . ' User';
    $this->data['user'] = Pengguna::join('role', 'pengguna.level = role.id', 'left')
      ->get()
      ->result();
    $this->view = 'konfigurasi/user';
    return $this->index();
  }

  public function addUser()
  {
    $this->data['title'] = 'Tambah User';
    $this->view = 'konfigurasi/addUser';
    $this->index();
  }

  public function editUser($par = '')
  {
    if (empty($par)) {
      $this->output->set_status_header('404');
      echo "404 - not found";
    } else {
      $this->data['title'] = 'Edit User';
      $this->data['user'] = Pengguna::join('role', 'pengguna.level = role.id', 'left')
        ->where('slug', $par)
        ->get()
        ->row();
      $this->view = 'konfigurasi/editUser';
      $this->index();
    }
  }

  public function radius()
  {
    $this->data['title'] = 'Daftar Radius';
    $this->data['radius'] = Radius::getWhere(['satker_code' => Identity::take(['kode_satker'])['kode_satker']])->result();
    $this->view = 'konfigurasi/radius';
    $this->index();
  }

  public function saldoAwal()
  {
    $saldo_awal = $this->db->get('saldo_awal')->row_array();
    if (!empty($saldo_awal)) {
      $data['saldoAwal'] = $saldo_awal;
    } else {
      $data['saldoAwal'] = array(
        'saldo_awal' => '',
        'saldo_ahir' => ''
      );
    }

    $data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 5],)->result();
    $this->templating->load('template/master', 'page/v_saldo_awal', $data);
  }

  public function tambah_saldo_awal()
  {
    $data = array(
      'saldo_awal' => $this->input->post('saldo_awal')
    );
    $id = $this->db->get('saldo_awal')->row_array();
    if (!empty($id)) {
      $this->db->update('saldo_awal', $data, array('id' => $id['id']));
    } else {
      $this->db->insert('saldo_awal', $data);
    }

    Notifikasi::flash('success', 'Data Berhasil Di Update');
    redirect('Konfigurasi/SaldoAwal');
  }
}

/* End of file Konfigurasi.php */
