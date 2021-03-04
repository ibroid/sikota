<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">
  <?= Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-body">
          <div class="table-responsive">
            <h3 class="text-primary text-center">
              Periode Laporan Tabayun Keluar
            </h3>
            <form action="">
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="awal">Dari Tanggal</label>
                  <input type="text" class="form-control datepicker" name="awal">
                </div>
                <div class="col-md-4">
                  <label for="awal">Sampai Tanggal</label>
                  <input type="text" class="form-control datepicker" name="akhir">
                </div>
                <div class="col-md-4">
                  <br>
                  <button class="btn btn-block btn-success"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>