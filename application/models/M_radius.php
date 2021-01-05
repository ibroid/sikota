<?php
class M_radius extends CI_Model
{
	public function getBiayaPanggilan()
	{

		$this->db->get_where('radius', array('biaya_panggilan' => '125000'));
	}
	public function getRadiusSatker()
	{

		return $this->db->query("SELECT * FROM radius WHERE satker_code='400622' ORDER BY nomor_radius ASC ")->result_array();
	}
}
