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
            <table id="tListTabayun" data-filter="1" class="table table-responsive table table-hover table-bordered" style="width:100%">
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
            notifAlert(result)
          }
        })
      }
    })
  }
  hapusTabayun()
</script>