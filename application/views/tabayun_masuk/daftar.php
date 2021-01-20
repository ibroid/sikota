<div id="content">
  <?= Components::load('panel') ?>

  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-heading">
          <h3>Data Tabayun Masuk</h3>
        </div>
        <div class="panel-body">
          <button class="btn btn-success"><i class="fa fa-unlink"></i> Cek Tabayun Masuk
          </button><br><br>
          <table id="tTabayunMasuk" data-filter="0" class="table table-responsive table table-hover table-bordered" style="width:100%">
            <thead>
              <tr class="text-white" style="background: #2196f3">
                <th class="text-center">No</th>
                <th class="text-center">Asal</th>
                <th class="text-center">Nomor Perkara <br> Jenis Delegasi <br> Tgl Sidang</th>
                <th class="text-center">Nomor & <br> Tgl Surat</th>
                <th class="text-center">Nama & <br> Alamat Pihak</th>
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
  var base_url = "<?= base_url() ?>";
  const btnCek = document.querySelector('button.btn.btn-success')
  async function cekData(callback) {
    const hasil = await fetch(base_url + 'TabayunMasuk/cek_tabayun_masuk').then((result) => result.json())
    callback(hasil)
  }
  btnCek.addEventListener('click', async function() {
    swal.fire({
      title: 'Sedang Mengambil Data',
      didOpen: () => {
        swal.showLoading()
      },
    })
    cekData((result) => {
      notifAlert(result).then(() => {
        if (result.icon == 'success') {
          location.reload()
        }
      })
    })
  })

  document.body.addEventListener('click', function(e) {
    if (e.target.classList.contains('hapus')) {
      confirmAlert({
        title: 'Apa Anda Yakin ?',
        text: 'Data yang di Hapus Tidak akan Kembali',
        icon: 'warning',
      }).then(async (result) => {
        if (result.isConfirmed) {
          const body = new FormData();
          body.append('id', e.target.dataset.id)
          const doHapus = await fetch(base_url + 'TabayunMasuk/hapus', {
            method: 'POST',
            body: body
          }).then(response => {
            response.json()
          })
          notifAlert({
            title: "Success",
            text: "Data Berhasil di Hapus",
            icon: "success"
          }).then((re) => {
            location.reload()
          })
        }
      })
    }
  })
</script>