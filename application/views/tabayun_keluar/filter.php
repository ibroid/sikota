<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<?= Notifikasi::showFlash('notif'); ?>
			<div class="panel">
				<div class="panel-body">
					<div class="table-responsive">
						<h3 class="text-primary">
						</h3>
						<br><br>
						<table id="datatables-example" class="table table-responsive table table-hover table-bordered" style="width:100%">
							<thead>
								<tr class="text-white" style="background: #2196f3">
									<th class="text-center">No</th>
									<th class="text-center">Tujuan</th>
									<th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
									<th class="text-center">Nomor & <br> Tgl Surat</th>
									<th class="text-center">Nama & <br> Alamat Pihak</th>
									<th class="text-center">Biaya & Status Balasan</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($data)) { ?>
									<?php foreach ($data as $no => $val) { ?>
										<tr>
											<td><?= ++$no ?></td>
											<td><strong><?= $val->pn_tujuan_text ?></strong></td>
											<td><strong><?= $val->nomor_perkara . '</strong><br>' . dom()::badge($val->jenis_delegasi_text)  . '<br>' . dateTotext()->format_indo($val->tgl_sidang) ?></td>
											<td><strong><?= $val->nomor_surat . '</strong><br>' . dateTotext()->format_indo($val->tgl_surat)  ?></td>
											<td><strong><?= $val->pihak . '</strong><br>' . $val->alamat_pihak ?></td>
											<td><?= buatrp($val->biaya) . '<br>' . dom()::statusBalasan($val->id) ?></td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>