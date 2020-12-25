<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">

  <?= Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-body">
          <div class="table-responsive">
            <h3 class="text-primary">
              List Antrian Tabayun Belum Dikirim
            </h3>
            <table id="tListTabayun" class="table table-responsive table table-hover table-bordered" style="width:100%">
              <thead>
                <tr class="text-white" style="background: #2196f3">
                  <th class="text-center">No</th>
                  <th class="text-center">Tujuan</th>
                  <th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
                  <th class="text-center">Nomor & <br> Tgl Surat</th>
                  <th class="text-center">Nama & <br> Alamat Pihak</th>
                  <th class="text-center">Panitera Pengganti</th>
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
</div>