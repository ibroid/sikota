<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/Components.php';
class FormSupport extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('request');

    $this->load->model('radius');
    $this->load->model('identity');
    $this->load->model('SIPP');
    $this->load->model('tabayun_masuk');
  }

  public function cari_tgl_sidang()
  {
    $req = request('nomor_perkara');
    echo json_encode([
      'tgl_sidang' => $this->SIPP->customQuery("SELECT tanggal_sidang FROM perkara_penetapan_hari_sidang JOIN perkara USING(perkara_id) WHERE nomor_perkara = '$req'")->row()
    ]);
    echo json_encode($req);
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
    $noper = request('value');
    $model = $this->SIPP;
    $parapihak = [
      'pihak1' => $model->perkaraPihak(request('value'), 1),
      'pihak2' => $model->perkaraPihak(request('value'), 2),
      'pengacara1' => $model->perkaraPengacara(request('value'), 1),
      'pengacara2' => $model->perkaraPengacara(request('value'), 2),
      'tgl_sidang' => $model->customQuery("SELECT tanggal_sidang FROM perkara_penetapan_hari_sidang JOIN perkara USING(perkara_id) WHERE nomor_perkara = '$noper'")->row_array()['tanggal_sidang']
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

  public function daftar_jenis_perkara()
  {
    $model = $this->SIPP;
    $jenisPerkara = $model->customLike('jenis_perkara', 'nama', request('key'), 10, 'after');
    $data = [];
    foreach ($jenisPerkara as $p) {
      array_push($data, $p->nama);
    }
    echo json_encode($data);
  }

  public function findRadius()
  {

    $kode = $this->db->get_where('pengadilan_negeri', ['nama' => request('namapn')])->row_array()['kode'];
    $data = Radius::like('satker_code', $kode)->get()->result();
    Components::load('tabelradius', $data);
  }
  public function getAmarPutusan()
  {
    echo json_encode($this->SIPP->customWhere('tanggal_putusan,amar_putusan', [
      [
        'field' => 'perkara_id',
        'value' => $this->SIPP->customWhere('perkara_id', [
          [
            'field' => 'nomor_perkara',
            'value' => req()->json()->data
          ]
        ], 'perkara')[0]->perkara_id
      ]
    ], 'perkara_putusan')[0]);
  }
  public function tabayunMasukReference()
  {
    $data = Tabayun_masuk::like('pn_asal_text', request('pn_asal_text'))->get()->result();
    Components::load('referenceTabayunMasuk', $data);
  }
}

/* End of file FormSupport.php */
