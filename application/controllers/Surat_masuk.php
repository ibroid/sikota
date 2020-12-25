<?php
require APPPATH.'libraries/Notifikasi.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller 
{

	public function __construct()
	{
		
		parent::__construct();
		$this->load->library('notifikasi');
		$this->load->model('Suratmasuk_model', 'suratm');
		$this->load->model('M_surat');
	}
	
	public function index()
	{
		
		$data['surat'] = $this->M_surat->get('tbl_surat_masuk');
		$data['sub_menu'] = $this->db->get_where('sub_menu', ['id_menu' => 4])->result();
		$this->templating->load('template/master', 'page/v_surat_masuk', $data);
	
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
		$table = $_POST['type'];
		unset($_POST['type']);
		$this->db->insert($table, $this->input->post());
		Notifikasi::flash('success','Data Berhasil Di Tambahkan');
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function ajax_list()
	{
		$list = $this->suratm->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $suratm) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $suratm->asal_surat;
			$row[] = $suratm->jenis_surat;
			$row[] = $suratm->no_surat . '<br>' . $suratm->tgl_surat;
			$row[] = $suratm->perihal . '<br>' . $suratm->isi;
			$row[] = $suratm->tgl_diterima . '<br>' . $suratm->keterangan;
			$row[] = $suratm->file;
			$row[] = '<p>Disposisi Kpd Panitera</p>';
			$row[] =      "<div class='btn-group'>
                                    <button type='button' class='btn btn-primary waves-effect dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <i class='material-icons'>Aksi</i>
                                    <span></span> <span class='caret'></span>
                                    </button>
                                    <ul class='dropdown-menu  pull-right '>
                                    	<li><a class='waves-effect' href='' target='_blank'>Disposisi</a></li>
                                        <li><a class='waves-effect' href='' target='_blank'>Download</a></li>      
                                        <li><a class='waves-effect' href='' target='_blank'>Edit</a></li>  
                                        <li><a class='waves-effect' href='' target='_blank'>Hapus</a></li>
                                    </ul>
                                </div>";

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->suratm->count_all(),
						"recordsFiltered" => $this->suratm->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}

/* End of file Surat_keluar.php */
/* Location: ./application/controllers/Surat_masuk.php */