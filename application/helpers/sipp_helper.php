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
  };
  return $ovj;
}
