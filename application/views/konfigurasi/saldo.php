<div id="content">
	<div class="panel">
		<div class="panel-body padding-0">
			<div class="col-md-12 col-sm-12">
				<h3 class="animated fadeInLeft">Konfigurasi</h3>
				<p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Jakarta,Indonesia</p>

				<ul class="nav navbar-nav">
					<?php foreach ($sub_menu as $sb) { ?>
						<li><a href="<?= base_url() . $sb->link_sub  ?>"><?= $sb->nama_sub ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<!-- cuaca -->
		</div>
	</div>

	<div class="col-md-12 padding-0">
		<div class="col-md-12">
			<?php echo Notifikasi::showFlash('notif') ?>
			<div class="panel">
				<div class="panel-heading">
					<h3>Konfigurasi Saldo Awal</h3>
				</div>
				<div class="panel-body">
					<br>
					<h5 class="text-danger">Perhatian: Mengubah Saldo Awal akan Mengubah Saldo Berjalan</h5>
					<div class="container">
						<form action="<?php echo base_url() . 'Konfigurasi/tambah_saldo_awal'; ?>" method="post">
							<div class="row">
								<div class="form-group">
									<label class="col-sm-2 control-label text-right">Nominal Saldo Awal</label>
									<div class="col-sm-6">
										<input type="text" name="saldo_awal" required value="<?php echo $saldoAwal['saldo_awal'] ?>" class="info form-control">
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="form-group">
									<label class="col-sm-2 control-label text-right">Nominal Berjalan</label>
									<div class="col-sm-6">
										<input type="text" name="saldo_ahir" value="<?php echo $saldoAwal['saldo_ahir'] ?>" class="info form-control" disabled>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="form-group">
									<label class="col-sm-2 control-label text-right"></label>
									<div class="col-sm-6">
										<button class="btn btn-success btn" id="btn-save" disabled type="submit"><i class="fa fa-save"></i> Simpan</button>
										<button type="button" onclick="document.getElementById('btn-save').removeAttribute('disabled')" class="btn btn-danger btn" type="submit"><i class="fa fa-warning"></i> Buka</button>
									</div>
								</div>
							</div>
						</form>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>