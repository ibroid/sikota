<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . 'libraries/Notifikasi.php';
require APPPATH . 'resource/SuratKeluarResource.php';
require APPPATH . 'controllers/Surat.php';

require 'vendor/autoload.php';

class SuratKeluar extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('files');
	}

	public function index()
	{
		$data['surat'] = $this->M_surat->get('tbl_surat_keluar');
		$data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 4])->result();
		$this->templating->load('template/master', 'page/v_surat_keluar', $data);
	}

	public function tambah()
	{
		if (isset($_FILES['file'])) {
			$config['upload_path'] = './uploads/surat/keluar/';
			$config['allowed_types'] = 'jpeg|jpg|png|docx|pdf';
			$config['max_size']  = '2048';
			$config['file_name'] = Ramsey\Uuid\Uuid::uuid4();
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file')) {
				Notifikasi::flash('danger', $this->upload->display_errors(), 'notif');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			} else {
				$filename = $this->upload->data('file_name');
			}
		}
		$_POST['file'] = $filename;
		$this->db->insert('surat_keluar', $this->input->post());
		$this->session->set_flashdata('notif', $this->notifikasi->flash('success', 'Surat Berhasil di Tambah'));
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function ajax_list()
	{
		return SuratKeluarResource::ajax_list();
	}
	public function hapus($id)
	{
		Files::delete('uploads/surat/keluar/', $this->db->get_where('surat_keluar', ['id' => $id])->row()->file);
		$this->db->delete('surat_keluar', ['id' => $id]);
		echo Notifikasi::swal('success', 'Data Telah di Hapus');
	}
	public function download($filename)
	{
		redirect('uploads/surat/keluar/' . $filename, 'refresh');
	}
	public function edit($id)
	{
		CI_Defender::zeroReferer()->secure();
		$surat = new Surat();
		return $surat->Keluar();
	}
}

/* End of file Surat_keluar.php */
/* Location: ./application/controllers/Surat_keluar.php */