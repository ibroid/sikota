<?php
require_once APPPATH . 'models/Surat_keluar.php';
class SuratKeluarResource
{
	public static function ajax_list()
	{
		$list = Surat_keluar::get_datatables();
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
			$row[] = "<div class='btn-group' role='group'>
						<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						Pilih Aksi
						<span class='fa fa-angle-down'></span>
						</button>
						<ul class='dropdown-menu  pull-right '>
								<li><a class='waves-effect' href='" . base_url('SuratKeluar/download/' . $suratk->file) . "' target='_blank'>Download</a></li>      
								<li><a class='waves-effect' href='" . base_url('SuratKeluar/edit') . "' target='_blank'>Edit</a></li>  
								<li><a class='waves-effect hapus' data-id='" . $suratk->id . "' href='javascript:void(0)' >Hapus</a></li>
						</ul>
				</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => Surat_keluar::count_all(),
			"recordsFiltered" => Surat_keluar::count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
}
