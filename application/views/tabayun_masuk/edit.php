<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Tambah Data Tabayun Masuk Baru</h3>
				</div>
				<div class="panel-body">
					<form action="<?= base_url() ?>TabayunMasuk/update" method="POST" enctype="multipart/form-data">
						<h4 style="margin-left: 200px ;">Status Delegasi Masuk</h4><br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Asal Delegasi</label>
								<div class="col-sm-8">
									<input type="hidden" value="<?= $data->id ?>" name="id">
									<input type="text" required autocomplete="off" id="asalPA" value="<?= $data->pn_asal_text ?>" name="pn_asal_text" class="info form-control">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Nomor Perkara</label>
								<div class="col-sm-8">
									<input type="text" id="input-perkara" value="<?= $data->nomor_perkara ?>" required autocomplete="off" name="nomor_perkara" class="info form-control">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Jenis Perkara</label>
								<div class="col-sm-8">
									<input type="text" autocomplete="off" value="<?= $data->jenis_perkara_text ?>" name="jenis_perkara_text" class="info form-control" id="jenisPerkara">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Jenis Delegasi</label>
								<div class="col-sm-8">
									<select required name="jenis_delegasi_text" class="info form-control">
										<?= isset($data->jenis_delegasi_text) ? "<option>$data->jenis_delegasi_text</option>" : false ?>
										<?php foreach ($this->db->get('jenis_delegasi')->result() as $c) : ?>
											<option><?= $c->jenis_delegasi; ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Tanggal Sidang </label>
								<div class="col-sm-8">
									<input type="text" required value="<?= $data->tgl_sidang ?>" autocomplete="off" name="tgl_sidang" class="info form-control datepicker">
								</div>
							</div>
						</div>
						<hr>

						<h4 style="margin-left: 200px ;">Data Pihak Yang akan di Panggil</h4>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Nama Pihak </label>
								<div class="col-sm-8">
									<input type="text" required value="<?= $data->pihak ?>" autocomplete="off" name="pihak" class="info form-control">
								</div>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Status & Agama Pihak</label>
								<div class="col-sm-4">
									<select name="status_pihak" class="form-control info">
										<?= "<option>$data->status_pihak</option>" ?>
										<option>Penggugat</option>
										<option>Pemohon</option>
										<option>Tergugat</option>
										<option>Termohon</option>
										<option>Pengacara Penggugat</option>
										<option>Kuasa Pemohon</option>
										<option>Pengacara Tergugat</option>
										<option>Kuasa Termohon</option>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="text" value="<?= $data->agama_pihak ?>" name="agama_pihak" id="agama-pihak" class="info form-control">
								</div>
							</div>
						</div>
						<br>


						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Tempat & Tanggal Lahir </label>
								<div class="col-sm-4">
									<input type="text" value="<?= $data->tempat_lahir_pihak ?>" name="tempat_lahir_pihak" id="tempat-lahir" class="info form-control">
								</div>
								<div class="col-sm-4">
									<input type="text" value="<?= $data->tanggal_lahir_pihak ?>" name="tanggal_lahir_pihak" id="tanggal-lahir" class="info form-control datepicker">
								</div>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right">Pendidikan & Pekerjaan</label>
								<div class="col-sm-4">
									<input type="text" name="pendidikan_pihak" value="<?= $data->pendidikan_pihak ?>" id="pendidikan-pihak" class="info form-control">
								</div>
								<div class="col-sm-4">
									<input type="text" name="pekerjaan_pihak" value="<?= $data->pekerjaan_pihak ?>" class="info form-control">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Alamat Pihak </label>
								<div class="col-sm-8">
									<textarea cols="10" id="alamat-pihak" name="alamat_pihak" class="form-control info" rows="3"><?= $data->alamat_pihak ?></textarea>
								</div>
							</div>
						</div>
						<hr>
						<h4 style="margin-left: 200px ;">Data Delegasi Masuk</h4>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Nomor Surat </label>
								<div class="col-sm-8">
									<input type="text" value="<?= $data->nomor_surat ?>" required autocomplete="off" name="nomor_surat" class="info form-control">
								</div>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Tanggal Surat </label>
								<div class="col-sm-8">
									<input type="text" value="<?= $data->tgl_surat ?>" required autocomplete="off" name="tgl_surat" class="info form-control datepicker">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Tanggal Terima Delegasi </label>
								<div class="col-sm-8">
									<input type="text" value="<?= $data->tgl_delegasi ?>" autocomplete="off" name="tgl_delegasi" class="info form-control datepicker">
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> Catatan </label>
								<div class="col-sm-8">
									<textarea required name="catatan" autocomplete="off" class="info form-control" cols="10" rows="3"><?= $data->catatan ?></textarea>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-2 control-label text-right"> File Pengantar </label>
								<div class="col-sm-8">
									<input type="file" class="info form-control" name="file">
									<br>
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>File</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($data->file as $no => $f) { ?>
												<tr>
													<td><?= ++$no ?></td>

													<?php if ($data->_id != '') {
														echo "	<td><a target=\"_blank\" href=\"http://$f->file\"> File Pengajuan</a></td>";
													} else {
														echo "	<td><a target=\"_blank\" href=\"" . base_url('uploads/surat/masuk/' . $f->file) . "\"> File Pengajuan</a></td>";
													} ?>
													<td>
														<?php if ($data->_id == '') echo "
														<button type=\"button\" id=\"btn-hapus-file\" data-name=\"$f->file\" class=\"btn btn-danger btn-sm\">Hapus</button>" ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
						<br><br>
						<center>
							<a href="<?= base_url('TabayunMasuk/daftar') ?>" class="btn btn-primary margin-right-2"><i class="fa fa-backward"></i> Kembali</a>
							<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
						</center>

					</form>


				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/backend/js/autocomplete.js"></script>

<script>
	var base_url = "<?= base_url() ?>";
	autocomplete(document.getElementById("asalPA"), base_url + 'FormSupport/daftar_pn', () => {});
	autocomplete(document.getElementById("jenisPerkara"), base_url + 'FormSupport/daftar_jenis_perkara', () => {});
	document.getElementById("btn-hapus-file").addEventListener('click', async function() {
		confirmAlert({
			title: "Apa anda Yakin ?",
			icon: "warning",
			preConfirm: async () => {
				const body = new FormData()
				body.append('filename', this.dataset.name)
				return await fetch(base_url + 'TabayunMasuk/hapusFilePengantar', {
					method: "POST",
					body: body
				}).then((response) => {
					return response.json()
				})
			},
			showLoaderOnConfirm: true
		}).then((result) => {
			notifAlert(result.value).then(() => {
				location.reload()
			})
		})


	})
</script>