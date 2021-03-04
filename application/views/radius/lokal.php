<div id="content">
	<?php Components::load('panel') ?>
	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Daftar Radius Lokal</h3>
				</div>
				<div class="panel-body">
					<button id="btn-sinkron" class="btn btn-primary"><i class="fa fa-link"></i> Sinkron</button><br><br>
					<table id="datatables-example" class="table table-striped table-inverse table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>No</th>
								<th>Kecamatan</th>
								<th>Keluarahan</th>
								<th>Biaya</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $no => $d) { ?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $d->kec ?></td>
									<td><?= $d->kel ?></td>
									<td><?= buatrp($d->nilai) ?></td>
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
	document.getElementById('btn-sinkron').addEventListener('click', async function() {
		const radius = await fetch("http://komdanas.mahkamahagung.go.id/jsons/radius04.json").then(
			response => response.json()
		)
		let body = []
		radius.filter(element => {
			if (element.satker_code == "<?= $data['kode_satker'] ?>") {
				body.push(element)
			}
		})

	})
</script>