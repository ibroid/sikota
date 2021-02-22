<div id="content">
	<?php Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Cari Radius Nasional</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<select name="nama_satker" class="form-control primary">
								<option selected disabled>Pilih Satker</option>
								<?php foreach ($data as $d) {
									echo "<option value=\"$d->kode\">$d->nama</option>";
								} ?>
							</select>
						</div>
						<div class="col-md-4">
							<button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div><br><br>
					<table id="datatables-example" class="table table-striped table-inverse table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>No</th>
								<th>Satker</th>
								<th>Provinsi</th>
								<th>Kabupaten Kota</th>
								<th>Kecamatan</th>
								<th>Keluarahan</th>
								<th>Biaya</th>
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