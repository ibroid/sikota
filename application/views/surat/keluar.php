<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/css/plugins/datatables.bootstrap.min.css') ?>" />
<div id="content">
	<?= Components::load('panel') ?>
	<?= $this->session->flashdata('notif'); ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<button data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Surat</button>
					<h3 class="text-primary">
						List Data Surat Keluar
					</h3>
					<div class="table-responsive">
						<table id="tableserverside" class="table table-responsive table table-hover table-bordered" style="width:100%">
							<thead>
								<tr class="text-white" style="background: #2196f3">
									<th>No</th>
									<th>Tujuan</th>
									<th>Nomor Surat</th>
									<th>Jenis Surat</th>
									<th>Perihal</th>
									<th>Isi Ringkas</th>
									<th>Tgl Surat </th>
									<th>Tgl Catat</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Data Surat Keluar</h4>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('/SuratKeluar/tambah') ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="sell">Jenis Surat</label>
							<select class="form-control" required name="jenis_surat" id="sell">
								<option>Surat Umum</option>
								<option>Bantuan Delegasi</option>
								<option>Jawaban Delegasi</option>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Tujuan</label>
							<input type="text" class="form-control" name="tujuan" placeholder="Input Pengirim Surat">
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Nomor Surat</label>
							<input type="text" class="form-control" name="no_surat" placeholder="Input Nomor Surat">
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Perihal</label>
							<input type="text" class="form-control" name="perihal" placeholder="Masukan Perihal Surat">
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Tentang/Isi Ringkas:</label>
							<textarea class="form-control" name="isi" placeholder="Input Isi Ringkas Surat"></textarea>
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Keterangan:</label>
							<textarea class="form-control" name="keterangan" placeholder="Input Keterangan"></textarea>
						</div>
						<div class="form-group">
							<label for="" class="col-form-label">Upload File:</label>
							<input type="file" class="form-control" name="file">
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="" class="mr-sm-4">Tgl Surat:</label>
								<input type="date" class="form-control mb-4 mr-sm-4" name="tgl_surat">
							</div>
							<div class="col-md-6">
								<label for="pwd" class="mr-sm-4">Tgl Catat:</label>
								<input type="date" class="form-control mb-4 mr-sm-4" name="tgl_catat">
							</div>
						</div>

						<br>
						<div class="text-right">
							<button type="submit" class="btn ripple-infinite btn-raised btn-primary"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>


</div>

<script src="<?php echo base_url('assets/backend/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/dataTables.bootstrap.min.js') ?>"></script>


<script type="text/javascript">
	var base_url = "<?= base_url() ?> ";
	$(document).ready(function() {
		applyTable(() => {
			document.body.addEventListener('click', (e) => {
				if (e.target.classList.contains('hapus')) {
					confirmAlert({
						title: "Apa anda yakin ?",
						icon: "warning",
						text: "Data yang dihapus tidak akan Kembali",
						showLoaderOnConfirm: true,
						preConfirm: async () => {
							return await fetch(base_url + 'SuratKeluar/hapus/' + e.target.dataset.id).then(response => {
								return response.json()
							})
						}
					}).then((result) => {
						if (result.isConfirmed) {
							notifAlert(result.value).then(() => {
								location.reload()
							})
						}
					})
				}
			})
		})
	});

	function applyTable(callback) {
		$('#tableserverside').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('SuratKeluar/ajax_list') ?>",
				"type": "POST",
				"data": function(data) {
					data.tujuan = $('#tujuan').val();
					data.jenis_surat = $('#jenis_surat').val();
					data.perihal = $('#perihal').val();
					data.isi = $('#isi').val();
				}
			},
			"columnDefs": [{
				"targets": [0],
				"orderable": false,
			}, ],
		});
		callback();
	}
</script>