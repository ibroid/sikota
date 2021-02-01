<?php
require_once APPPATH . 'models/Tabayun_masuk.php';
class TabayunMasukResource
{
  static $list = [];
  static $status;

  public static function setDatatable($grid = 0)
  {
    self::$list = Tabayun_masuk::withStatus($grid)->datatables();
    self::$status = $grid;
    return new static;
  }
  public static function datatableResource()
  {
    $data = array();
    $no = $_POST['start'];
    foreach (self::$list as $tbk) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $tbk->pn_asal_text;
      $row[] = $tbk->nomor_perkara . '<br>' . $tbk->jenis_delegasi_text . '<br>' . $tbk->tgl_sidang;
      $row[] = $tbk->nomor_surat . '<br>' . $tbk->tgl_surat;
      $row[] = $tbk->pihak . '<br>' . $tbk->alamat_pihak;
      $row[] = "<div class='btn-group' role='group'>
                  <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Pilih Aksi
                  <span class='fa fa-angle-down'></span>
                  </button>
                  <ul class='dropdown-menu  pull-right '>
                      <li><a class='waves-effect' href='" . base_url('TabayunMasuk/proses/') . $tbk->id . "'>Proses</a></li>  
                      <li><a class='waves-effect hapus' data-id='" . $tbk->id . "' href='javascript:void(0)'>Hapus</a></li>
                  </ul>
              </div>";
      $data[] = $row;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => Tabayun_masuk::withStatus(self::$status)->count_all(),
      "recordsFiltered" => Tabayun_masuk::withStatus(self::$status)->count_filtered(),
      "data" => $data,
    );
    echo json_encode($output);
  }
}
