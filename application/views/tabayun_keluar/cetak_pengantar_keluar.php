<?php
//buka file rtf
$template = "./rtf/template/template_pengantar_keluar.rtf";
$handle = fopen($template, "r+");
$hasilbaca = fread($handle, filesize($template));
fclose($handle);

//nilai yang akan dituliskan dalam template
//pada praktek sebenarnya anda bisa mengambil data dari database
// $nama = 'Dede Lukman, S.Kom.';
// $dob = '06 Februari 1984';
// $alamat = 'Kuningan, Indonesia';
// $tgl_cetak = date('d-m-Y H:i:s');

//tuliskan data dalam template
// print_r('<pre>');
// print_r($template);
// exit; 
$hasilbaca = str_replace('pengadilan', $data['pengadilan'], $hasilbaca);
$hasilbaca = str_replace('jenis_perkara', $data['jenis_perkara'], $hasilbaca);
$hasilbaca = str_replace('nomor_perkara', $data['nomor_perkara'], $hasilbaca);
$hasilbaca = str_replace('tgl_phs', $data['tgl_phs'], $hasilbaca);
$hasilbaca = str_replace('nomor_surat', $data['nomor_surat'], $hasilbaca);
$hasilbaca = str_replace('nama_pe', $data['pihak'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak_pe', $data['jenis_pihak_pe'], $hasilbaca);
$hasilbaca = str_replace('nama_te_1', $data['nama_te'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak_te', $data['jenis_pihak_te'], $hasilbaca);
$hasilbaca = str_replace('tgl_kirim', dateToText()->tanggal_indo_monthtext($data['tgl_surat']), $hasilbaca);
$hasilbaca = str_replace('tgl_sidang', dateToText()->tanggal_indo_monthtext($data['tgl_sidang']), $hasilbaca);
$hasilbaca = str_replace('tgl_phs', dateToText()->tanggal_indo($phs[0]->penetapan_hari_sidang), $hasilbaca);
$hasilbaca = str_replace('nama_pihak', $data['pihak'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak', $data['jenis_pihak'], $hasilbaca);
$hasilbaca = str_replace('tgl_lahir_pihak', $data['tgl_lahir_pihak'], $hasilbaca);
$hasilbaca = str_replace('agama_pihak', $data['agama_pihak'], $hasilbaca);
$hasilbaca = str_replace('pekerjaan_pihak', $data['pekerjaan_pihak'], $hasilbaca);
$hasilbaca = str_replace('alamat_pihak', $data['alamat_pihak'], $hasilbaca);
$hasilbaca = str_replace('hari_sidang', $data['hari_sidang'], $hasilbaca);
$hasilbaca = str_replace('biaya_keluar', buatrp($data['biaya']), $hasilbaca);
$hasilbaca = str_replace('terbilang_biaya', ucwords(to_word($data['biaya'])), $hasilbaca);
// $hasilbaca = str_replace('tgl_cetak', $data['tgl_cetak'], $hasilbaca);

//membuat file baru dari hasil baca
$hasil = "./rtf/hasil/hasil_pengantar_rellas_keluar.rtf";
$handle = fopen($hasil, "w+");
fwrite($handle, $hasilbaca);
fclose($handle);

//membuka file hasil secara langsung
//header('Location:'.$hasil); 

//atau membuka file melalui link
redirect(base_url($hasil));
// echo '<a href="'.base_url($hasil).'">Hasil</a>'
