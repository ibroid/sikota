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
            <table id="daftarTabayunKeluar" class="table table-responsive table-hover table-bordered">
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
  var base_url = "<?= base_url() ?>"
  document.body.addEventListener('click', function(e) {
    if (e.target.classList.contains('hapus')) {
      console.log(e.target.dataset.id)
      confirmAlert({
        title: "Apa Anda Yakin ?",
        text: "Data yang dihapus tidak akan Kembali",
        icon: "warning"
      }).then(async (result) => {
        if (result.isConfirmed) {
          const body = new FormData()
          body.append('id', e.target.dataset.id)
          const connect = await fetch(base_url + 'TabayunKeluar/hapus', {
              method: 'POST',
              body: body
            })
            .then((response) => {
              return response.json()
            });
          notifAlert(connect).then(() => {
            location.reload()
          });
        }
      })
    }


    if (e.target.classList.contains('btn-block')) {
      Swal.mixin({
        confirmButtonText: 'Simpan dan Lanjutkan;',
        showCancelButton: true,
        progressSteps: ['1', '2', '3'],
        didOpen: () => {
          console.log(document.getElementById('ok'))
        },
      }).queue([{
          title: 'Masukan Nomor Resi',
          input: 'text'
        },
        {
          title: 'Masukan Tanggal Resi',
          html: '<input type="date" name="tgl_resi" class="swal2-input">',
          customClass: 'swal-custom-width',
        },
        {
          title: "Masukan File",
          input: "file",
          id: "ok"
        }
      ]).then((result) => {
        if (result.value) {
          const answers = JSON.stringify(result.value)
          console.log(result)
        }
      })
    }
  })
</script>