<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading panel-primary">
					<h4 class="text-white">Tambah Wesel Masuk</h4>
				</div>
				<div class="panel-body">
					<form action="" method="POST" role="form">

						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Pengadilan Asal</label>
							<div class="col-sm-6">
								<input type="text" name="pn_asal_text" class="form-control primary" placeholder="Input field">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Nomor Perkara</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary" placeholder="Input field">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Atas Nama Pihak</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary" placeholder="Input field">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Tanggal DIterima</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary datepicker" placeholder="Input field">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Nominal</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary" placeholder="Input field">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label text-right">Catatan</label>
							<div class="col-sm-6">
								<input type="text" class="form-control primary" placeholder="Input field">
							</div>
						</div>


						<button class="btn btn-warning margin-right-2"><i class="fa fa-folder-open"></i> Referensi Delegasi</button>
						<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
					</form>

				</div>
			</div>

			<div class="panel">
				<div class="panel-heading">
					<h3>Daftar Masuk Wesel</h3>
				</div>
				<div class="panel-body">
					<p>Total Wesel Masuk <?= dom()::badge('Rp. 120.000,-') ?></p>
					<p>Total Bulan Ini <?= dom()::badge('Rp. 120.000,-', 'success') ?></p>
					<table id="datatables-example" class="table table-responsive table table-hover table-bordered" style="width:100%">
						<thead>
							<tr class="text-white" style="background: #2196f3">
								<th class="text-center">No</th>
								<th class="text-center">Asal</th>
								<th class="text-center">Nomor Perkara</th>
								<th class="text-center">Atas Pihak</th>
								<th class="text-center">Nominal</th>
								<th class="text-center">Aksi</th>
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

<script>

</script>