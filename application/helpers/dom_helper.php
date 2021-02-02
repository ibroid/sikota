<?php

function dom()
{
  $dom = new class
  {
    function fileHasil(array $data = [])
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

    function formProsesTabayunMasuk(array $condition,  $name,  $type = 'text',  $classOption = '')
    {
      if (empty($condition)) {
        return 'Mohon Selesaikan Proses Sebelum Nya';
      } else {
        return "<input type='$type' required autocomplete='off' class='info form-control $classOption' name='$name'>";
      }
    }

    static function statusBalasan(int $id)
    {
      $these = &get_instance();
      $cek = $these->db->get_where('tabayun_proses_keluar', ['delegasi_id' => $id])->row();
      return !$cek ? '<span class="badge badge-danger">Belum Ada Balasan</span>' : '<span class="badge badge-primary">Sudah Ada Balasan</span>';
    }
    static function badge($text,  $color = 'primary')
    {
      return "<span class=\"badge badge-$color\">$text</span>";
    }
  };
  return $dom;
}
