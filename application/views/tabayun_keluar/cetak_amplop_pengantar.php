<?php 
//buka file rtf
$template = "./rtf/template/template_amplop_pengantar.rtf";
$handle = fopen($template, "r+");
$hasilbaca = fread($handle, filesize($template));
fclose($handle);
 
//wew debol :p
 
//tuliskan data dalam template
$hasilbaca = str_replace('pn_asal_text', $data['pn_asal_text'], $hasilbaca);
$hasilbaca = str_replace('pengadilan', $data['pn_tujuan_text'], $hasilbaca);
$hasilbaca = str_replace('jenis_perkara', $data['jenis_perkara'], $hasilbaca);
$hasilbaca = str_replace('nomor_perkara', $data['nomor_perkara'], $hasilbaca);
$hasilbaca = str_replace('tgl_phs', $data['tgl_phs'], $hasilbaca);
$hasilbaca = str_replace('nomor_surat', $data['nomor_surat'], $hasilbaca);
$hasilbaca = str_replace('nama_pe', $data['pihak'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak_pe', $data['jenis_pihak_pe'], $hasilbaca);
$hasilbaca = str_replace('nama_te_1', $data['nama_te'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak_te', $data['jenis_pihak_te'], $hasilbaca);
$hasilbaca = str_replace('tgl_kirim', $data['tgl_kirim'], $hasilbaca);
$hasilbaca = str_replace('tgl_sidang', $data['tgl_sidang'], $hasilbaca);
$hasilbaca = str_replace('nama_pihak', $data['nama_pihak'], $hasilbaca);
$hasilbaca = str_replace('jenis_pihak', $data['jenis_pihak'], $hasilbaca);
$hasilbaca = str_replace('tgl_lahir_pihak', $data['tgl_lahir_pihak'], $hasilbaca);
$hasilbaca = str_replace('agama_pihak', $data['agama_pihak'], $hasilbaca);
$hasilbaca = str_replace('pekerjaan_pihak', $data['pekerjaan_pihak'], $hasilbaca);
$hasilbaca = str_replace('alamat_pihak', $data['alamat_pihak'], $hasilbaca);
$hasilbaca = str_replace('hari_sidang', $data['hari_sidang'], $hasilbaca);
$hasilbaca = str_replace('biaya_keluar', $data['biaya_keluar'], $hasilbaca);
$hasilbaca = str_replace('terbilang_biaya', $data['terbilang_biaya'], $hasilbaca);
$hasilbaca = str_replace('alamat_pa', $data['alamat_pengadilan'], $hasilbaca);
// $hasilbaca = str_replace('tgl_cetak', $bio['tgl_cetak'], $hasilbaca);
 
//membuat file baru dari hasil baca
$hasil = "./rtf/hasil/hasil_amplop_keluar.rtf";
$handle = fopen($hasil, "w+");
fwrite($handle, $hasilbaca);
fclose($handle);
 
//membuka file hasil secara langsung
//header('Location:'.$hasil); 
 
//atau membuka file melalui link
redirect(base_url($hasil))
// echo '<a href="'.base_url($hasil).'">Hasil</a>'
?>