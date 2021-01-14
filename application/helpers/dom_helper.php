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
    function tahapanProses($par)
    {
      $these = &get_instance();
      $tahapan = $these->db->get_where('tahapan_pelaksanaan', ['id' => $par])->row();
      return "<span class='badge badge-" . $tahapan->color_type . "'>" . $tahapan->nama_tahapan . "</span>";
    }

    function formProsesTabayunMasuk($condition, $name, $type = 'text', $classOption = null)
    {
      if (empty($condition)) {
        return 'Mohon Selesaikan Proses Sebelum Nya';
      } else {
        return "<input type='$type' required autocomplete='off' class='info form-control $classOption' name='$name'>";
      }
    }
  };
  return $dom;
}
