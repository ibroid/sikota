<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<?= Notifikasi::showFlash('notif'); ?>
			<div class="panel">
				<div class="panel-body">
					<form action="<?= base_url() ?>TabayunKeluar/update_mandiri" method="POST" enctype="multipart/form-data">
						<hr>
						<h4 class="center">Penunjukan Jurusita</h4>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Nama Jurusita</label>
								<div class="col-sm-8">
									<input type="hidden" name="delegasi_id" value="<?= $data->id ?>">
									<input type="hidden" name="catatan" value="Proses Mandiri">
									<input type="hidden" name="status_delegasi" value="7">
									<input type="hidden" name="diinput_oleh" value="<?= event()->inputBy() ?>">
									<input type="hidden" name="diinput_tanggal" value="<?= event()->inputAt() ?>">
									<input type="text" required name="jurusita_nama" class="primary form-control">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Tanggal Penunjukan</label>
								<div class="col-sm-8">
									<input type="text" autocomplete="off" name="tgl_penunjukan_jurusita" class="primary form-control datepicker">
								</div>
							</div>
						</div>
						<br>
						<hr>
						<h4 class="center">Pelaksanaan Delegasi</h4>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Nomor Relaas</label>
								<div class="col-sm-8">
									<input type="text" name="nomor_relaas" value="<?= $data->nomor_perkara ?>" class="primary form-control">
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Tanggal Pelaksanaan</label>
								<div class="col-sm-8">
									<input type="text" name="tgl_pelaksanaan" class="primary form-control datepicker">
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Status Pelaksanaan</label>
								<div class="col-sm-8">
									<select required name="status_pelaksanaan" class="form-control primary">
										<option>Bertemu (ditandatangani)</option>
										<option>Bertemu (tidak bersedia tanda tangan)</option>
										<option>Tidak Bertemu (diterima lurah/kantor desa)</option>
										<option>Tidak Bertemu (Alamat Tidak ada)</option>
										<option>Tidak Dilaksanakan</option>
									</select>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">File Pelaksanaan</label>
								<div class="col-sm-8">
									<input required type="file" name="file" class="primary form-control">
								</div>
							</div>
						</div><br>

						<br><br>
						<center>
							<a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-primary margin-right-2"><i class="fa fa-backward"></i> Kembali</a>
							<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
						</center>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>