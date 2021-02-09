<?php

use phpDocumentor\Reflection\Types\Array_;

defined('BASEPATH') or exit('No direct script access allowed');

class SIPP extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->sipp = $this->load->database('sipp', TRUE);
  }

  public static function sysConfig($par = [])
  {
    $these = new self;
    foreach ($par as $p) {
      $these->sipp->or_where('name', $p);
    }
    $result = $these->sipp->get('sys_config')->result();
    $case = [];
    foreach ($result as $r) {
      $case[$r->name] = $r->value;
    }
    return $case;
  }

  public function customAll($table, $limit = '')
  {
    return $this->sipp->get($table, $limit)->result();
  }

  public function customWhere($select, $where = [], $table)
  {
    $this->sipp->select($select);
    foreach ($where as $w) {
      $this->sipp->where($w['field'], $w['value']);
    }
    return $this->sipp->get($table)->result();
  }
  public static function customLike($table, $key, $like, $limit = '', $position)
  {
    $these = new self;
    $these->sipp->select($key);
    $these->sipp->like($key, $like, $position);
    return $these->sipp->get($table, $limit)->result();
  }

  public function customQuery($query)
  {
    return $this->sipp->query($query);
  }

  public function perkaraPihak($nomor_perkara, $urutan)
  {
    $this->sipp->select("perkara_pihak$urutan.nama,tempat_lahir,tanggal_lahir,jenis_kelamin,pihak.alamat,pekerjaan,pendidikan_id,tingkat_pendidikan.nama as pendidikan,agama.nama AS agama");
    $this->sipp->join("pihak", "perkara_pihak$urutan.pihak_id = pihak.id", "left");
    $this->sipp->join("tingkat_pendidikan", "pihak.pendidikan_id = tingkat_pendidikan.id", "left");
    $this->sipp->join("agama", "pihak.agama_id = agama.id", "left");
    $this->sipp->where("perkara_pihak$urutan.perkara_id", "(SELECT perkara_id from perkara where nomor_perkara = '$nomor_perkara' )", FALSE);
    return $this->sipp->get("perkara_pihak$urutan")->result();
  }

  public function perkaraPengacara($nomor_perkara, $urutan)
  {
    $this->sipp->select("perkara_pengacara.`nama`,tempat_lahir,tanggal_lahir,perkara_pengacara.`alamat`,agama.nama AS agama,tingkat_pendidikan.`nama` AS pendidikan,pihak.`pekerjaan`");
    $this->sipp->join('pihak', 'perkara_pengacara.`pengacara_id` = pihak.id', 'left');
    $this->sipp->join('agama', 'pihak.`agama_id` = agama.`id`', 'left');
    $this->sipp->join('tingkat_pendidikan', 'pihak.`pendidikan_id` = tingkat_pendidikan.`id`', 'left');
    $this->sipp->where('perkara_pengacara.`perkara_id`', "( SELECT perkara_id FROM perkara WHERE nomor_perkara = '$nomor_perkara')", FALSE);
    $this->sipp->where('perkara_pengacara.`pihak_ke`', $urutan);
    return $this->sipp->get('perkara_pengacara')->result();
  }
  public function jurusitaaktif()
  {
    $this->sipp->select("jurusita.*");
    $this->sipp->where("jurusita.aktif='Y' ORDER BY nama_gelar ASC;");
    return $this->sipp->get('jurusita')->result();
  }
  public function getLawanPihak($nomor_perkara, $pos)
  {
    $data = $this->sipp->get_where('perkara', ['nomor_perkara' => $nomor_perkara])->row_array();
    return $data[$pos];
  }
  public function get_where(String $table, array $par)
  {
    return $this->sipp->get_where($table, $par);
  }
  public function pengadilan()
  {
  }
}

/* End of file SIPP.php */
