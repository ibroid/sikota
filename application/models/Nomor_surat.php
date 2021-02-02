<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nomor_surat extends Model
{
  public static function incerest()
  {
    self::update([
      'nomor_surat_ahir' => self::get()->row()->nomor_surat_ahir
    ]);
  }

  public static function tabayunKeluar()
  {
    $data = self::all()->row();
    $bulanRomawi = monthToRoman(date('m'));
    $tahun = date('Y');
    $nomorSurat = "$data->kode_pengantar_tabayun/$data->nomor_surat_ahir/$data->kode_tabayun_satker/$bulanRomawi/$tahun";
    return $nomorSurat;
  }

  public static function updateNomorSurat()
  {
    $nomorSurat = self::all()->row()->nomor_surat_ahir;
    $newNomorSurat = $nomorSurat + 1;
    $fixNomorSurat = str_pad($newNomorSurat, 4, '0', STR_PAD_LEFT);
    return $fixNomorSurat;
  }

  public static function saveUpdate()
  {
    self::update(['nomor_surat_ahir' => self::updateNomorSurat()], ['id' => self::idNow()]);
  }

  public static function idNow()
  {
    return self::all()->row()->id;
  }
}

/* End of file Nomor_surat.php */
