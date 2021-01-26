<div id="content">
	<?= Components::load('panel') ?>

	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<?php echo Notifikasi::showFlash('notif') ?>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<h4 style="color:white;">Tambah Data Surat Masuk (Klik Untuk Buka Halaman)</h4>
							</a>
						</h4>
					</div>

					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<div class="container">
								<form action="<?= base_url('/Surat_masuk/tambah') ?>" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Jenis Surat</label>
											<div class="col-sm-6">
												<select required name="jenis_surat" class="info form-control">
													<option>1. Surat Umum</option>
													<option>2. Bantuan Delegasi</option>
													<option>3. Jawaban Delegasi</option>
												</select>
											</div>
											<div class="col-md-3">
												<button type="button" onclick="cekdelegasi()" data-toggle="modal" data-target="#modelId" disabled class="btn bg-blue text-white margin-right-1"><i class="icons icon-user-following"></i></i> Cek Delegasi</button>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Pengirim</label>
											<div class="col-sm-8">
												<input type="text" autocomplete="off" name="asal_surat" value="" class="info form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Nomor Surat</label>
											<div class="col-sm-8">
												<input type="text" autocomplete="off" name="no_surat" required value="" class="info form-control" placeholder="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right"> Tanggal Surat </label>
											<div class="col-sm-8">
												<input type="text" required autocomplete="off" name="tgl_surat" class="info form-control datepicker">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right"> Tanggal Catat </label>
											<div class="col-sm-8">
												<input type="text" required autocomplete="off" name="tgl_diterima" class="info form-control datepicker">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Perihal</label>
											<div class="col-sm-8">
												<input type="text" autocomplete="off" name="perihal" required value="" class="info form-control" placeholder="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Isi Ringkas</label>
											<div class="col-sm-8">
												<textarea name="isi" required value="" class="info form-control" placeholder=""></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Keterangan</label>
											<div class="col-sm-8">
												<textarea name="keterangan" required value="" class="info form-control" placeholder=""></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right">Upload File</label>
											<div class="col-sm-8">
												<input type="file" class="info form-control" name="file">
											</div><!-- /.col-lg-6 -->
										</div>
									</div><!-- /.row -->
									<br>
									<div class="row">
										<div class="form-group">
											<label class="col-sm-2 control-label text-right"></label>
											<div class="col-sm-8">
												<button type="submit" class="btn btn-primary btn pull-right"><i class="fa fa-save"></i> Simpan</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<h4 style="color:white;">List Data Surat Masuk (Klik Untuk Buka Halaman)</h4>
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<div class="table-responsive">
								<table id="tableserverside" class="table table-responsive table table-hover table-bordered" style="width:100%">
									<thead>
										<tr class="text-white" style="background: #2196f3">
											<th class="text-center">No</th>
											<th class="text-center">Asal Surat</th>
											<th class="text-center">Jenis Surat</th>
											<th class="text-center">Nomor & <br> Tgl Surat</th>
											<th class="text-center">Perihal <br> Isi</th>
											<th class="text-center">Tgl Terima <br> Keterangan</th>
											<th class="text-center">File</th>
											<th class="text-center">Status</th>
											<th class="text-center">Aksi</th>
											<!--<th class="text-center">Aksi</th>-->
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
		</div>
	</div>
</div>

<script src="<?php echo base_url('assets/backend/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/datatables/js/dataTables.bootstrap.min.js') ?>"></script>

<script type="text/javascript">
	var tableserverside;

	$(document).ready(function() {

		//datatables
		table = $('#tableserverside').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('SuratMasuk/ajax_list') ?>",
				"type": "POST",
				"data": function(data) {
					data.asal_surat = $('#asal_surat').val();
					data.isi = $('#isi').val();
					data.perihal = $('#perihal').val();
					data.no_surat = $('#no_surat').val();
				}
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0], //first column / numbering column
				"orderable": false, //set not orderable
			}, ],

		});


	});
</script>