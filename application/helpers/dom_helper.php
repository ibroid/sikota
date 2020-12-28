<?php

function dom()
{
  $dom = new class
  {
    function fileHasil($data = [1, 3, 3, 1, 4, 4, 42, 3, 5])
    {
      $hasil = '';
      foreach ($data as $d) {
        $hasil .= '<li><a target="_blank" href="' . base_url('uploads/surat/keluar/') . $d['file'] . '">' . $d['file'] . '</a></li>';
      }
      return '<ul>' . $hasil . '</ul>';
    }
    function formProses($par = '')
    {
      if (!empty($par)) {
        return 'disabled';
      } else {
        return false;
      }
    }
    function siapProses($file = '')
    {
      if (!empty($file)) {
        return '<button class="btn btn-danger" id="siapProses" type="button"><i class="fa fa-paper-plane"></i> Kirim</button>';
      } else {
        return false;
      }
    }
  };
  return $dom;
}
