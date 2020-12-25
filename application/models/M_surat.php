<?php
require_once APPPATH . 'helpers/date_helper.php';
class M_surat extends CI_Model
{

	public function getAllSuratKeluar()
	{

		return $this->db->get('tbl_surat_keluar')->result_array();
	}

	public function getAllSuratMasuk()
	{

		return $this->db->get('tbl_surat_masuk')->result_array();
	}

	public function get($table)
	{
		return $this->db->get($table)->result_array();
	}
	public function nomorSuratTabayun()
	{
		$bulanRomawi = monthToRoman(date('m'));
		$tahun = date('Y');
		$data = $this->db->get('nomor_surat')->row();
		$nomorSurat = "$data->kode_tabayun_satker/$data->nomor_surat_ahir/$data->kode_pengantar_tabayun/$bulanRomawi/$tahun";
		return $nomorSurat;
	}
}
