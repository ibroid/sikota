<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Rincian Tabayun Balasan</h3>
				</div>
				<div class="panel-body">
					<a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary margin-right-2"><i class="fa fa-backward"></i> Kembali</a>
					<br><br>
					<table class="table table-responsive">
						<thead class="bg-primary text-white">
							<tr>
								<th>Pengaju</th>
								<th>Nomor Perkara</th>
								<th>Jenis Perkara</th>
								<th>Tanggal Sidang</th>
								<th>Tanggal Delegasi</th>
								<th>Biaya di Terima</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= $data->pn_asal_text; ?></td>
								<td><?= $data->nomor_perkara; ?></td>
								<td><?= $data->jenis_perkara_text; ?></td>
								<td><?= dateToText()->format_indo($data->tgl_sidang); ?></td>
								<td><?= dateToText()->format_indo($data->tgl_delegasi); ?></td>
								<td><?= buatrp($data->biaya); ?></td>
								<td><?= isset($data->proses->status_delegasi)  ?  dom()->tahapanProses($data->proses->status_delegasi) : dom()::badge('Belum ada Balasan', 'danger') ?></td>
							</tr>
						</tbody>
					</table>

					<table class="table table-responsive">
						<thead class="bg-primary text-white">
							<tr>
								<th>Pihak</th>
								<th>Tempat Tanggal Lahir</th>
								<th>Pendidikan</th>
								<th>Pekerjaan</th>
								<th>Alamat</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?= $data->pihak; ?></td>
								<td><?= $data->tempat_lahir_pihak; ?> <br> <?= dateToText()->format_indo($data->tanggal_lahir_pihak); ?></td>
								<td><?= $data->pendidikan_pihak; ?></td>
								<td><?= $data->pekerjaan_pihak; ?></td>
								<td width="300"><?= $data->alamat_pihak; ?></td>
							</tr>

						</tbody>
					</table>

					<hr>
					<div class="col-md-12 tab-content">
						<?= Notifikasi::showFlash(); ?>

						<div role="tabpanel" class="tab-pane fade active in" id="tabs-area-demo" aria-labelledby="tabs1">
							<div class="col-md-12">
								<div class="col-md-12">
									<div class="col-md-12 tabs-area">
										<div class="liner"></div>
										<ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
											<li class="active">
												<a href="#tabs-demo6-area1" data-toggle="tab" title="welcome">
													<span data-toggle="tooltip" data-placement="top" title="Berkas Delegasi" class="round-tabs one">
														<i class="glyphicon glyphicon-file"></i>
													</span>
												</a>
											</li>


											<li>
												<a href="#tabs-demo6-area2" data-toggle="tab" title="profile">
													<span data-toggle="tooltip" data-placement="top" title="Penunjukan Jurusita" class="round-tabs two">
														<i class="glyphicon glyphicon-user"></i>
													</span>
												</a>
											</li>

											<li>
												<a href="#tabs-demo6-area3" data-toggle="tab" title="bootsnipp goodies">
													<span data-toggle="tooltip" data-placement="top" title="Pelaksanaan Delgasi" class="round-tabs three">
														<i class="glyphicon glyphicon-road"></i>
													</span> </a>
											</li>

											<li>
												<a href="#tabs-demo6-area4" data-toggle="tab" title="blah blah">
													<span data-toggle="tooltip" data-placement="top" title="Pengiriman Berkas Kembali" class="round-tabs four">
														<i class="glyphicon glyphicon-level-up"></i>
													</span>
												</a>
											</li>

											<li>
												<a href="#tabs-demo6-area5" data-toggle="tab" title="completed">
													<span data-toggle="tooltip" data-placement="top" title="Selesai" class="round-tabs five">
														<i class="glyphicon glyphicon-ok"></i>
													</span> </a>
											</li>
										</ul>
										<div class="tab-content tab-content-v5">
											<div class="tab-pane fade in active" id="tabs-demo6-area1">
												<h3 class="head text-center">Berkas Delegasi </h3>
												<div class="card text-left card-info">
													<div class="card-body">
														<h4 class="card-title">Title</h4>
														<table class="table table-bordered table-responsiv">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Nama</th>
																	<th>Aksi</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td scope="row">1</td>
																	<td>Template Surat Pengantar</td>
																	<td><a href="">Download</a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="tabs-demo6-area2">
												<h3 class="head text-center">Penunjukan Jurusita</h3>
												<form action="#" method="POST">
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal Penunjukan</label>
															<div class="col-sm-8">
																<input type="text" disabled name="tgl_penunjukan_jurusita" required autocomplete="off" value="<?= dateToText()->format_indo($data->proses->tgl_penunjukan_jurusita) ?>" class="primary form-control ">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Nama Jurusita</label>
															<div class="col-sm-8">
																<input type="text" disabled class="form-control primary" value="<?= $data->proses->jurusita_nama ?>">
															</div>
														</div>
													</div>

												</form>
												<br><br>
											</div>
											<div class="tab-pane fade" id="tabs-demo6-area3">
												<h3 class="head text-center">Pelaksanaan Delegasi</h3>

												<form action="#" method="POST">
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal diterima</label>
															<div class="col-sm-8">
																<input type="text" value="<?= isset($data->proses->tgl_surat_diterima) ? dateToText()->format_indo($data->proses->tgl_surat_diterima) : '' ?>" required disabled autocomplete="off" class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Nomor Relaas</label>
															<div class="col-sm-8">
																<input type="text" value="<?= $data->proses->nomor_relaas ?>" required autocomplete="off" disabled class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal Pelaksanaan</label>
															<div class="col-sm-8">
																<input type="text" value="<?= dateToText()->format_indo($data->proses->tgl_pelaksanaan)  ?>" disabled autocomplete="off" class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Status Pelaksanaan</label>
															<div class="col-sm-8">
																<input type="text" class="form-control primary" value="<?= $data->proses->status_pelaksanaan ?>" disabled>
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Catatan Pelaksanaan</label>
															<div class="col-sm-8">
																<input type="text" class="form-control primary" disabled value="<?= $data->proses->catatan ?>">
															</div>
														</div>
													</div>
													<br><br>
												</form>

											</div>
											<div class="tab-pane fade" id="tabs-demo6-area4">
												<h3 class="head text-center">Pengiriman Berkas Kembali!</h3>

												<form action="#">
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal Pengiriman Relaas Kembali</label>
															<div class="col-sm-8">
																<input type="text" value="<?= isset($data->proses->tgl_pengiriman_relaas) ? dateToText()->format_indo($data->proses->tgl_pengiriman_relaas) : '' ?>" required autocomplete="off" disabled class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Nomor Surat Pengantar</label>
															<div class="col-sm-8">
																<input type="text" value="<?= $data->proses->nomor_surat_pengantar_relaas ?>" required autocomplete="off" disabled class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal Surat Pengantar</label>
															<div class="col-sm-8">
																<input type="text" value="<?= isset($data->proses->tgl_surat_pengantar_relaas) ? dateTotext()->format_indo($data->proses->tgl_surat_pengantar_relaas) : '' ?>" required autocomplete="off" disabled class="primary datepicker form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Tanggal Resi</label>
															<div class="col-sm-8">
																<input type="text" required autocomplete="off" value="<?= isset($data->proses->tgl_resi) ? dateToText()->format_indo($data->proses->tgl_resi) : '' ?>" disabled class="primary datepicker form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Nomor Resi</label>
															<div class="col-sm-8">
																<input type="text" value="<?= $data->proses->nomor_resi ?>" required autocomplete="off" disabled class="primary form-control">
															</div>
														</div>
													</div>
													<br>
													<div class="row">
														<div class="form-group">
															<label class="col-sm-3 control-label text-right">Biaya Pengiriman</label>
															<div class="col-sm-8">
																<input type="text" value="<?= buatrp($data->proses->biaya)  ?>" required autocomplete="off" disabled class="primary form-control">
															</div>
														</div>
													</div>
													<br><br>
												</form>
											</div>
											<div class="tab-pane fade" id="tabs-demo6-area5">
												<div class="text-center">
													<i class="img-intro icon-checkmark-circle"></i>
												</div>
												<h3 class="head text-center"> Dokumen Pelaksanaan</h3>
												<p class="narrow text-center">
													Silahkan Upload dokumen pelaksanaan untuk menyelesaikan delgasi
												</p>
												<br>
												<form action="#d=">
													<div class="row">
														<div class="col-md-2"></div>
														<div class="col-md-8">
															<table class="table table-bordered table-inverse table-responsive">
																<thead class="thead-default">
																	<tr>
																		<th>No</th>
																		<th>Nama Doc Pelaksanaan</th>
																		<th>Tanggal</th>
																		<th>Aksi</th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach ($data->files as $key => $value) { ?>
																		<tr>
																			<td><?= ++$key ?></td>
																			<td>File Pelaksanaan</td>
																			<td><?= dateToText()->format_indo($value->diinput_tanggal) ?></td>
																			<td><a target="_blank" href="http://<?= $value->file ?>">Download</a></td>
																		</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
													</div>
													<br>
													<br>
												</form>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var base_url = "<?= base_url() ?>";
	const btnKirimBalasan = document.getElementById("btn-kirim-balasan")
	if (btnKirimBalasan) btnKirimBalasan.addEventListener('click', function(e) {
		confirmAlert({
			title: "Data Akan di Kirim",
			text: "Pastikan Semua Data Sudah Terisi dan Benar!",
			icon: "warning",
			showLoaderOnConfirm: true,
			preConfirm: async () => {
				const body = new FormData()
				body.append('id', '<?= $this->uri->segment(3) ?>')
				const result = await fetch(base_url + 'TabayunMasuk/kirimBalasan', {
					method: 'POST',
					body: body
				}).then(response => {
					return response.json()
				})
				return result;
			}
		}).then((result) => {
			if (result.isConfirmed) {
				notifAlert(result.value).then((err) => {
					if (err) console.log(err);
					location.href = base_url + 'TabayunMasuk/control'
				})
			}
		})
	})
</script>