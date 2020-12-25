<?php

function monthToRoman($angka)
{
  $hsl = "";
  if ($angka < 1 || $angka > 5000) {
    $hsl = "Batas Angka 1 s/d 5000";
  } else {
    while ($angka >= 1000) {
      $hsl .= "M";
      $angka -= 1000;
    }
  }


  if ($angka >= 500) {
    if ($angka > 500) {
      if ($angka >= 900) {
        $hsl .= "CM";
        $angka -= 900;
      } else {
        $hsl .= "D";
        $angka -= 500;
      }
    }
  }
  while ($angka >= 100) {
    if ($angka >= 400) {
      $hsl .= "CD";
      $angka -= 400;
    } else {
      $angka -= 100;
    }
  }
  if ($angka >= 50) {
    if ($angka >= 90) {
      $hsl .= "XC";
      $angka -= 90;
    } else {
      $hsl .= "L";
      $angka -= 50;
    }
  }
  while ($angka >= 10) {
    if ($angka >= 40) {
      $hsl .= "XL";
      $angka -= 40;
    } else {
      $hsl .= "X";
      $angka -= 10;
    }
  }
  if ($angka >= 5) {
    if ($angka == 9) {
      $hsl .= "IX";
      $angka -= 9;
    } else {
      $hsl .= "V";
      $angka -= 5;
    }
  }
  while ($angka >= 1) {
    if ($angka == 4) {
      $hsl .= "IV";
      $angka -= 4;
    } else {
      $hsl .= "I";
      $angka -= 1;
    }
  }

  return ($hsl);
}

function dateToText()
{
  $obb = new class
  {
    function tanggal_indo($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      $tgl = $hari . "/" . $bulan . "/" . $tahun;
      return $tgl;
    }

    function tanggal_english($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      $tgl = $bulan . "/" . $hari . "/" . $tahun;
      return $tgl;
    }

    function tanggal_dmy($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      $tgl = $tahun . "-" . $bulan . "-" . $hari;
      return $tgl;
    }

    function get_only_date($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      return $hari;
    }

    function get_only_month($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      return $bulan;
    }

    function get_only_year($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      return $tahun;
    }

    function tanggal_indo_monthtext($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);

      $bulantext = $this->get_bulan(intval($bulan));

      $tgl = $hari . " " . $bulantext . " " . $tahun;
      return $tgl;
    }

    function get_selisih($tanggal1, $tanggal2)
    {
      $date1 = new DateTime($tanggal1);
      $date2 = new DateTime($tanggal2);
      $diff = $date1->diff($date2);

      return $diff->days;
    }

    function tanggal_jam_indo($tanggal)
    {
      $hari = substr($tanggal, 8, 2);
      $bulan = substr($tanggal, 5, 2);
      $tahun = substr($tanggal, 0, 4);
      $tgl = $hari . "/" . $bulan . "/" . $tahun;
      $jam = substr($tanggal, 11, 8);
      return $tgl . " " . $jam;
    }

    function get_jam($tanggaljam)
    {
      $temp = explode(" ", $tanggaljam);
      $tgl = $temp[0];
      $jam = $temp[1];

      return $jam;
    }

    function tanggal_simpan_db($tanggal)
    {
      $hari = substr($tanggal, 0, 2);
      $bulan = substr($tanggal, 3, 2);
      $tahun = substr($tanggal, 6, 4);
      $tgl = $tahun . "-" . $bulan . "-" . $hari;
      return $tgl;
    }

    function get_hari($tanggal)
    {
      $dt = strtotime($tanggal);
      $day = date('D', $dt);

      switch ($day) {
        case 'Sun':
          $hari = 'Minggu';
          break;
        case 'Mon':
          $hari = 'Senin';
          break;
        case 'Tue':
          $hari = 'Selasa';
          break;
        case 'Wed':
          $hari = 'Rabu';
          break;
        case 'Thu':
          $hari = 'Kamis';
          break;
        case 'Fri':
          $hari = 'Jum\'at';
          break;
        case 'Sat':
          $hari = 'Sabtu';
          break;
        default:
          # code...
          $hari = 'Tidak terdefinisi';
          break;
      }

      return $hari;
    }

    function get_bulan_romawi($bulan)
    {
      switch ($bulan) {
        case '1':
          $nama_bulan = 'I';
          break;
        case '2':
          $nama_bulan = 'II';
          break;
        case '3':
          $nama_bulan = 'III';
          break;
        case '4':
          $nama_bulan = 'IV';
          break;
        case '5':
          $nama_bulan = 'V';
          break;
        case '6':
          $nama_bulan = 'VI';
          break;
        case '7':
          $nama_bulan = 'VII';
          break;
        case '8':
          $nama_bulan = 'VIII';
          break;
        case '9':
          $nama_bulan = 'IX';
          break;
        case '10':
          $nama_bulan = 'X';
          break;
        case '11':
          $nama_bulan = 'XI';
          break;
        case '12':
          $nama_bulan = 'XII';
          break;
        default:
          $nama_bulan = 'ERROR FUNCTION';
          break;
      }

      return $nama_bulan;
    }

    function get_bulan($bulan)
    {
      switch ($bulan) {
        case '1':
          $nama_bulan = 'Januari';
          break;
        case '2':
          $nama_bulan = 'Februari';
          break;
        case '3':
          $nama_bulan = 'Maret';
          break;
        case '4':
          $nama_bulan = 'April';
          break;
        case '5':
          $nama_bulan = 'Mei';
          break;
        case '6':
          $nama_bulan = 'Juni';
          break;
        case '7':
          $nama_bulan = 'Juli';
          break;
        case '8':
          $nama_bulan = 'Agustus';
          break;
        case '9':
          $nama_bulan = 'September';
          break;
        case '10':
          $nama_bulan = 'Oktober';
          break;
        case '11':
          $nama_bulan = 'November';
          break;
        case '12':
          $nama_bulan = 'Desember';
          break;
        default:
          $nama_bulan = 'ERROR FUNCTION';
          break;
      }

      return $nama_bulan;
    }

    function convert_to_24($timestring, $ampm)
    {
      if (!$timestring || !$ampm) {
        return false;
      } else {
        $tmp = explode(':', $timestring);
        $hour = $tmp[0];
        $minute = $tmp[1];

        if ($ampm == 'PM') {
          $hour = intval($hour) + 12;
        }

        return $hour . ':' . $minute;
      }
    }

    function convert_to_12($timestring)
    {
      $tmp = explode(':', $timestring);
      $hour = $tmp[0];
      $minute = $tmp[1];
      $second = $tmp[2];

      if (intval($hour) > 12) {
        $hour = intval($hour) - 12;

        return $hour . ':' . $minute . ' PM';
      } else {
        return $hour . ':' . $minute . ' AM';
      }
    }
  };

  return $obb;
}
