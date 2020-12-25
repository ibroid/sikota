<?php
require APPPATH.'libraries/Notifikasi.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('notifikasi');
		$this->load->model('Suratkeluar_model', 'suratk');
		$this->load->model('M_surat');
	}

	public function index()
	{
		$data['surat'] = $this->M_surat->get('tbl_surat_keluar');
		$data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 4])->result();
		$this->templating->load('template/master', 'page/v_surat_keluar', $data);
	}

	//jejen
	public function tambah()
	{
		if (isset($_FILES['file'])) {
			$config['upload_path'] = './uploads/surat/keluar/';
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
		$table = $_POST['type'];
		unset($_POST['type']);
		$this->db->insert($table, $this->input->post());
		$this->session->set_flashdata('notif', $this->notifikasi->flash('success', 'Surat Berhasil di Tambah'));
		redirect($_SERVER['HTTP_REFERER']);
	}

	//jejen
	public function ajax_list()
	{
		$list = $this->suratk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $suratk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $suratk->tujuan;
			$row[] = $suratk->no_surat;
			$row[] = $suratk->jenis_surat;
			$row[] = $suratk->perihal;
			$row[] = $suratk->isi;
			$row[] = $suratk->tgl_surat;
			$row[] = $suratk->tgl_catat;
			$row[] = $suratk->keterangan;
			$row[] =      "<div class='btn-group' role='group'>
                                    <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Pilih Aksi
                                    <span class='fa fa-angle-down'></span>
                                    </button>
                                    <ul class='dropdown-menu  pull-right '>
                                        <li><a class='waves-effect' href='' target='_blank'>Download</a></li>      
                                        <li><a class='waves-effect' href='' target='_blank'>Edit</a></li>  
                                        <li><a class='waves-effect' href='' target='_blank'>Hapus</a></li>
                                    </ul>
                                </div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->suratk->count_all(),
			"recordsFiltered" => $this->suratk->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
}

/* End of file Surat_keluar.php */
/* Location: ./application/controllers/Surat_keluar.php */