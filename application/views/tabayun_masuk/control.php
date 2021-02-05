<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>List Data Yang Sedang di Proses</h3>
				</div>
				<div class="panel-body">
					<table id="datatables-example" class="table table-responsive table table-hover table-bordered" style="width:100%">
						<thead>
							<tr class="text-white" style="background: #2196f3">
								<th class="text-center">No</th>
								<th class="text-center">Asal</th>
								<th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
								<th class="text-center">Nama & <br> Alamat Pihak</th>
								<th class="text-center">Status Pelaksanaan <br> & Jurusita</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $val) { ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><strong><?= $val->pn_asal_text ?></strong></td>
									<td><strong><?= $val->nomor_perkara . '</strong><br>' . dom()::badge($val->jenis_delegasi_text) . '<br>' . dateToText()->format_indo($val->tgl_sidang) ?></td>
									<td><strong><?= $val->pihak . '</strong><br>' . $val->alamat_pihak ?></td>
									<td><?= dom()->tahapanProses($val->status_delegasi) . '<br>' . $val->jurusita_nama  ?></td>
									<td><?= buatrp($val->biaya) ?></td>
									<td>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Pilih Aksi
												<span class="fa fa-angle-down"></span>
											</button>
											<ul class="dropdown-menu  pull-right ">
												<li><a class="waves-effect" href="<?= base_url('TabayunMasuk/proses/' . $val->iid) ?>">Proses</a></li>
												<li><a class="waves-effect" data-id="<?= $val->iid ?>" href="javascript:void(0)">Hapus</a></li>
											</ul>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var base_url = '<?= base_url() ?>'
	async function hapusTabayun() {
		document.body.addEventListener('click', (e) => {
			if (e.target.classList.contains('hapus')) {
				confirmAlert({
					title: 'Apa Anda Yakin ?',
					text: 'Data yang di Hapus Tidak akan kembali',
					icon: 'warning'
				}).then(async (click) => {
					if (click.isConfirmed) {
						let body = new FormData()
						body.append('id', e.target.dataset.id)
						const result = await fetch(base_url + 'TabayunMasuk/hapus', {
							method: 'POST',
							body: body
						}).then(response => {
							return response.json()
						})
						notifAlert(result).then((err) => location.reload())
					}
				})
			}
		})
	}
	hapusTabayun()
	async function cekData(callback) {
		const hasil = await fetch(base_url + 'TabayunKeluar/cek_tabayun_balasan').then((result) => result.json())
		callback(hasil)
	}
</script>