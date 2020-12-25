<?php
class M_surat extends CI_Model
{

	public function getAllSuratKeluar()
	{

		return $this->db->get('tbl_surat_keluar')->result_array();
	}

	
}