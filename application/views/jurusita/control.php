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
            <table data-filter="0" class="table table-responsive table table-hover table-bordered" style="width:100%">
              <thead>
                <tr class="text-white" style="background: #2196f3">
                  <th class="text-center">No</th>
                  <th class="text-center">Asal</th>
                  <th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
                  <th class="text-center">Nomor & <br> Tgl Surat</th>
                  <th class="text-center">Nama & <br> Alamat Pihak</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $no => $d) { ?>
                  <tr>
                    <td><?= ++$no ?></td>
                    <td><strong><?= $d->pn_asal_text ?></strong></td>
                    <td><strong><?= $d->nomor_perkara . '</strong><br>' . dom()::badge($d->jenis_delegasi_text) . '<br>' . dateToText()->format_indo($d->tgl_sidang) ?></td>
                    <td><?= $d->nomor_surat . '<br>' . $d->tgl_surat ?></td>
                    <td><?= $d->pihak . '<br>' . $d->alamat_pihak ?></td>
                    <td><?= dom()::badge($d->status_pelaksanaan) ?></td>
                    <td>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Pilih Aksi
                          <span class="fa fa-angle-down"></span>
                        </button>
                        <ul class="dropdown-menu  pull-right ">
                          <li><a class="waves-effect" href="<?= base_url('') ?>">Cetak Wesel</a></li>
                          <li><a class="waves-effect" href="<?= base_url('Jurusita/proses/' . $d->iid) ?>">Proses</a></li>
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
</div>