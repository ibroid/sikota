<div id="content">
	<?= Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
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
								<th class="text-center">Nominal</th>
								<th class="text-center">Jurusita</th>
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