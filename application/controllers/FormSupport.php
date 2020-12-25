<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/Components.php';
class FormSupport extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_radius', 'radius');
    $this->load->model('SIPP');
  }

  public function nomor_perkara()
  {
    $model = $this->SIPP;
    $perkara = $model->customLike('perkara', 'nomor_perkara', request('key'), 10, 'after');
    $data = [];
    foreach ($perkara as $p) {
      array_push($data, $p->nomor_perkara);
    }
    echo json_encode($data);
  }

  public function pilih_pihak()
  {
    $model = $this->SIPP;
    $parapihak = [
      'pihak1' => $model->perkaraPihak(request('value'), 1),
      'pihak2' => $model->perkaraPihak(request('value'), 2),
      'pengacara1' => $model->perkaraPengacara(request('value'), 1),
      'pengacara2' => $model->perkaraPengacara(request('value'), 2),
    ];
    Components::load('tabelpihak', $parapihak);
  }

  public function daftar_pn()
  {
    $model = $this->SIPP;
    $pengadialnNegeri = $model->customLike('pengadilan_negeri', 'nama', request('key'), 10, 'after');
    $data = [];
    foreach ($pengadialnNegeri as $p) {
      array_push($data, $p->nama);
    }
    echo json_encode($data);
  }

  public function findRadius()
  {

    $kode = $this->db->get_where('pengadilan_negeri', ['nama' => request('namapn')])->row_array()['kode'];
    $model = $this->radius;
    $data = $model->customLike('radius', 'satker_code', $kode);
    Components::load('tabelradius', $data);
  }
}

/* End of file FormSupport.php */
