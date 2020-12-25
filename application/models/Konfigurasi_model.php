<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {

	var $table = 'konfigurasi'; 

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_konfigurasi($value='')
	{
		$config = $this->db->get($this->table);
		return $config;
	}
	
	

}

/* End of file Konfigurasi_model.php */
/* Location: ./application/models/Konfigurasi_model.php */