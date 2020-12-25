<?php
function sippTable()
{
  $ovj = new class
  {
    public function getPP($par)
    {
      $these = &get_instance();
      $these->load->model('SIPP');
      $data = $these->SIPP->customWhere('panitera_pengganti_text', [
        [
          'field' => 'perkara_id',
          'value' => $par
        ]
      ], 'perkara_penetapan');
      return $data[0]->panitera_pengganti_text;
      // return 'test';
    }
  };
  return $ovj;
}
