<?php
function sippTable()
{
  $ovj = new class
  {
    public function getPP($par = '')
    {
      $these = &get_instance();
      $these->load->model('SIPP');
      $data = $these->SIPP->customWhere('panitera_pengganti_text', [
        [
          'field' => 'perkara_id',
          'value' => $par
        ]
      ], 'perkara_penetapan');
      return isset($data[0]->panitera_pengganti_text) ? $data[0]->panitera_pengganti_text :  false;
    }
    public static function reversePihak($pihak)
    {
      switch ($pihak) {
        case 'Termohon':
          return 'Pemohon';
          break;
        case 'Pemohon':
          return 'Termohon';
          break;
        case 'Penggugat':
          return 'Tergugat';
          break;
        case 'Tergugat':
          return 'Penggugat';
          break;
      }
    }
    public static function lawanPihak($nomor_perkara, $pos)
    {
      require_once APPPATH . 'models/SIPP.php';
      $sipp = new SIPP;
      return $sipp->getLawanPihak($nomor_perkara, $pos);
    }
    public static function pihakSebagai($pihak, $type)
    {
      if (isset(explode('m', $pihak)[1])) {
        $pihak = 'm' . explode('m', $pihak)[1];
      } else if (isset(explode('n', $pihak)[1])) {
        if ($type == 'Pe') {
          $pihak = 'n' . explode('ng', $pihak)[1];
        } else {
          $pihak = explode('ng', $pihak)[1];
        }
      } else {
        $pihak = explode('r', $pihak)[1];
      }
      return $type . $pihak;
    }
    public static function whoIsIt($nomor_perkara, $who)
    {
      if (explode('/', $nomor_perkara)[1] == 'Pdt.G') {
        if ($who == 'P') {
          return 'Penggugat';
        } else {
          return 'Tergugat';
        }
      }
      if (explode('/', $nomor_perkara)[1] == 'Pdt.P') {
        if ($who == 'P') {
          return 'Pemohon';
        } else {
          return 'Termohon';
        }
      }
    }
    public static function identityPnTujuan($nama)
    {
      require_once APPPATH . 'models/SIPP.php';
      $sipp = new SIPP;
      return $sipp->customQuery("SELECT * FROM pengadilan_negeri WHERE nama = '$nama' ")->row_array();
    }
  };
  return $ovj;
}
