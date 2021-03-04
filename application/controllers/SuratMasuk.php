<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'resource/SuratMasukResource.php';
class SuratMasuk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function tambah()
	{
		if (isset($_FILES['file'])) {
			$config['upload_path'] = './uploads/surat/masuk/';
			$config['allowed_types'] = 'jpeg|jpg|png|docx|pdf';
			$config['max_size']  = '2048';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file')) {
				$error = array('error' => $this->upload->display_errors());
				echo "<pre>";
				print_r($error);
				echo "</pre>";
			} else {
				$upload_data = array('upload_data' => $this->upload->data());
				$filename = $upload_data['upload_data']['orig_name'];
			}
		}
		$_POST['file'] = $filename;
		$this->db->insert('surat_masuk', $this->input->post());
		Notifikasi::flash('success', 'Data Berhasil Di Tambahkan');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function ajax_list()
	{
		return SuratMasukResource::ajax_list();
	}
}

/* End of file Surat_keluar.php */
/* Location: ./application/controllers/Surat_masuk.php */