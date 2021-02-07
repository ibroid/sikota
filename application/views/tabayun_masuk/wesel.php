<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">
	<?= Components::load('panel') ?>

	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<?= Notifikasi::showFlash('notif'); ?>
			<div class="panel panel-primary">
				<div class="panel-heading panel-primary">
					<h4 class="text-white">Tambah Wesel Masuk</h4>
				</div>
				<div class="panel-body">
					<form action="<?= base_url('Weseel/save') ?>" method="POST" role="form" enctype="multipart/form-data">

						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Pengadilan Asal</label>
							<div class="col-sm-6">
								<input type="hidden" name="delegasi_id" id="delegasi_id">
								<input type="text" required id="asalPA" value="PENGADILAN AGAMA " name="pn_asal_text" class="form-control primary" name="pn_asal_text">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Nomor Perkara</label>
							<div class="col-sm-6">
								<input type="text" required class="form-control primary" name="nomor_perkara" id="nomor_perkara">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Atas Nama Pihak</label>
							<div class="col-sm-6">
								<input type="text" required class="form-control primary" name="pihak" id="pihak">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Tanggal DIterima</label>
							<div class="col-sm-6">
								<input type="text" required class="form-control primary datepicker" name="tgl_diterima">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Nominal</label>
							<div class="col-sm-6">
								<input type="text" required class="form-control primary" name="nominal" id="nominal">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Catatan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary" name="catatan" id="catatan">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">File</label>
							<div class="col-sm-6">
								<input type="file" class="form-control primary" name="file">
							</div>
						</div>


						<button type="button" data-toggle="modal" id="btn-open-reference" href="#modal-id" class="btn btn-warning margin-right-2"><i class="fa fa-folder-open"></i> Referensi Delegasi</button>
						<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
					</form>

				</div>
			</div>

			<div class="panel">
				<div class="panel-heading">
					<h3>Daftar Masuk Wesel</h3>
				</div>
				<div class="panel-body">
					<p>Total Wesel Masuk <?= dom()::badge(buatrp(Saldo_awal::all()->row()->saldo_ahir), 'success') ?></p>
					<p>Total Wesel Bulan Ini <?= dom()::badge(buatrp(Saldo_awal::month())) ?></p>
					<table id="datatables-example" class="table table-responsive table table-hover table-bordered" style="width:100%">
						<thead>
							<tr class="text-white" style="background: #2196f3">
								<th class="text-center">No</th>
								<th class="text-center">Asal</th>
								<th class="text-center">Nomor Perkara</th>
								<th class="text-center">Atas Pihak</th>
								<th class="text-center">Nominal</th>
								<th class="text-center">Catatan</th>
								<th class="text-center">Bukti</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $va) { ?>
								<tr>
									<td><?= ++$no; ?></td>
									<td><?= $va->pn_asal_text; ?></td>
									<td><?= $va->nomor_perkara; ?></td>
									<td><?= $va->pihak; ?></td>
									<td><?= buatrp($va->nominal) . '<br>' . ucwords(to_word($va->nominal)); ?></td>
									<td><?= $va->catatan; ?></td>
									<td><a target="_blank" href="<?= base_url('uploads/wesel/' . $va->bukti); ?>">Lihat Bukti</a> </td>
									<td>
										<button onclick="hapusWesel(<?= $va->id ?>,'<?= $va->bukti ?>','<?= $va->nominal ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
										<!-- <button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button> -->
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

<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Referensi Delegasi Masuk</h4>
			</div>
			<div class="modal-body" id="tabelReference">
				<h4>Mohon Tunggu Sedang Mengambil Data</h4>



			</div>

		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/backend/js/autocomplete.js"></script>
<script>
	var base_url = "<?= base_url() ?>";
	var pn_asal_text = document.getElementById("asalPA");
	autocomplete(pn_asal_text, base_url + 'FormSupport/daftar_pn', () => {});

	async function connecting(body, callback) {
		const connect = await fetch(base_url + 'FormSupport/tabayunMasukReference', {
			method: 'POST',
			body: body
		}).then(response => {
			return response.text()
		})
		document.getElementById('tabelReference').innerHTML = connect
		callback()
	}

	document.getElementById('btn-open-reference').addEventListener('click', function() {
		const body = new FormData()
		body.append('pn_asal_text', pn_asal_text.value)
		return connecting(body, () => {
			dataTableReference('tabelReference')
		})
	})

	function setFieldWesel(pn_asal, nomor_perkara, jenis_delegasi, pihak, biaya, id) {
		pn_asal_text.value = pn_asal
		set('catatan', 'Untuk Keperluan ' +
			jenis_delegasi);
		set('nomor_perkara', nomor_perkara);
		set('pihak', pihak);
		set('nominal', biaya);
		set('delegasi_id', id);
		closeModal('#modal-id')
	}

	function set(selector, value) {
		document.getElementById(selector).value = value
	}

	function hapusWesel(id, bukti, nominal) {
		confirmAlert({
			title: "Apa anda yakin ?",
			icon: "warning",
			showLoaderOnConfirm: true,
			preConfirm: async () => {
				const body = new FormData()
				body.append('id', id)
				body.append('bukti', bukti)
				body.append('nominal', nominal)
				return await fetch(base_url + 'Weseel/delete', {
					method: 'POST',
					body: body
				}).then(response => {
					return response.json()
				})
			}
		}).then(function(result) {
			if (result.isConfirmed) {
				notifAlert(result.value).then(() => {
					location.reload()
				})
			}

		})
	}
</script>