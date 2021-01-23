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
              List Antrian Tabayun Yang Sudah Dikirim
            </h3>
            <button class="btn btn-success" id="btn-cek-balasan"><i class="fa fa-recycle fa-xs fa-fw"></i> Cek Balasan</button>
            <br><br>
            <table class="table table-responsive table table-hover table-bordered" style="width:100%">
              <thead>
                <tr class="text-white" style="background: #2196f3">
                  <th class="text-center">No</th>
                  <th class="text-center">Tujuan</th>
                  <th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
                  <th class="text-center">Nomor & <br> Tgl Surat</th>
                  <th class="text-center">Nama & <br> Alamat Pihak</th>
                  <th class="text-center">Biaya & Status Balasan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $no => $val) { ?>
                  <tr>
                    <td><?= ++$no ?></td>
                    <td><strong><?= $val->pn_tujuan_text ?></strong></td>
                    <td><strong><?= $val->nomor_perkara . '</strong><br>' . dom()::badge($val->jenis_delegasi_text)  . '<br>' . dateTotext()->format_indo($val->tgl_sidang) ?></td>
                    <td><strong><?= $val->nomor_surat . '</strong><br>' . dateTotext()->format_indo($val->tgl_surat)  ?></td>
                    <td><strong><?= $val->pihak . '</strong><br>' . $val->alamat_pihak ?></td>
                    <td><?= buatrp($val->biaya) . '<br>' . dom()::statusBalasan($val->id) ?></td>
                    <td>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Pilih Aksi
                          <span class="fa fa-angle-down"></span>
                        </button>
                        <ul class="dropdown-menu  pull-right ">
                          <li><a class="waves-effect" href="<?= base_url('TabayunKeluar/balasan/') . $val->id ?>">Lihat Balasan</a></li>
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
            const result = await fetch(base_url + 'TabayunKeluar/hapus', {
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
  document.getElementById('btn-cek-balasan').addEventListener('click', function(e) {
    swal.fire({
      title: "Sedang Mengambil Data",
      didOpen: () => {
        swal.showLoading()
      }
    })
    cekData((result) => {
      notifAlert(result).then(() => {
        if (result.icon == 'success') {
          location.reload()
        }
      })
    })
  })
</script>