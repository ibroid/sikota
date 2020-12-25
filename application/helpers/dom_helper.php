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
  };
  return $dom;
}
