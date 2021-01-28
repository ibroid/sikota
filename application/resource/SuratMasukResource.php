<?php
require_once APPPATH . 'models/Surat_masuk.php';
class SuratMasukResource
{
	public static function ajax_list()
	{
		$list = Surat_masuk::get_datatables();
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
			"draw" => request('draw'),
			"recordsTotal" => Surat_masuk::count_all(),
			"recordsFiltered" => Surat_masuk::count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
}
