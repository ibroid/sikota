<style>
  button {
    margin-right: 10px;
  }
</style>
<div id="content">
  <?= Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('upload'); ?>
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-heading">
          <h3>Proses Tabayun Keluar</h3>
        </div>
        <div class="panel-body">
          <div class="container">
            <form action="<?= base_url() ?>TabayunKeluar/update" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="idTabayun" name="id" value="<?= $data['id'] ?>">
              <input type="hidden" name="id_pn_asal" value="<?= $data['id_pn_asal'] ?>">
              <input type="hidden" name="id_pn_tujuan" value="<?= $data['id_pn_tujuan'] ?>">
              <input type="hidden" name="perkara_id" value="<?= $data['perkara_id'] ?>">
              <h4 style="margin-left: 200px ;">Status Delegasi Kirim</h4><br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nomor Perkara</label>

                  <div class="col-sm-6">
                    <input <?= dom()->formProses($data['nomor_perkara']) ?> type="text" id="input-perkara" required autocomplete="off" value="<?= $data['nomor_perkara'] ?>" name="nomor_perkara" class="info form-control">
                  </div>

                  <div class="col-md-2">
                    <button type="button" onclick="pilihpihak()" data-toggle="modal" data-target="#modelId" <?= dom()->formProses($data['nomor_perkara']) ?> class="btn bg-blue text-white margin-right-2"><i class="icons icon-user-following"></i></i> Pilih Pihak</button>
                  </div>

                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Jenis Delegasi</label>
                  <div class="col-sm-8">
                    <select required <?= dom()->formProses($data['jenis_delegasi_text']) ?> name="jenis_delegasi_text" class="info form-control">
                      <option><?= $data['jenis_delegasi_text']; ?></option>
                      <?php foreach ($this->db->get('jenis_delegasi')->result() as $c) : ?><option><?= $c->jenis_delegasi; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Tujuan Delegasi</label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['pn_tujuan_text']) ?> required autocomplete="off" onblur="buttonradius()" id="perPN" value="<?= $data['pn_tujuan_text'] ?>" name="pn_tujuan_text" class="info form-control">
                  </div>
                </div>
              </div>
              <br>

              <hr>

              <h4 style="margin-left: 200px ;">Data Pihak Yang akan di Panggil</h4>
              <br>


              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama & Agama Pihak</label>
                  <div class="col-sm-4">
                    <input type="text" value="<?= $data['pihak'] ?>" <?= dom()->formProses($data['pihak']) ?> name="pihak" id="nama-pihak" class="info form-control">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" <?= dom()->formProses($data['agama_pihak']) ?> name="agama_pihak" value="<?= $data['agama_pihak'] ?>" id="agama-pihak" class="info form-control">
                  </div>
                </div>
              </div>
              <br>


              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tempat & Tanggal Lahir </label>
                  <div class="col-sm-4">
                    <input type="text" <?= dom()->formProses($data['tempat_lahir_pihak']) ?> value="<?= $data['tempat_lahir_pihak'] ?>" name="tempat_lahir_pihak" id="tempat-lahir" class="info form-control">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" <?= dom()->formProses($data['tanggal_lahir_pihak']) ?> value="<?= $data['tanggal_lahir_pihak'] ?>" name="tanggal_lahir_pihak" id="tanggal-lahir" class="info form-control">
                  </div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Pendidikan & Pekerjaan</label>
                  <div class="col-sm-4">
                    <input type="text" <?= dom()->formProses($data['pendidikan_pihak']) ?> value="<?= $data['pendidikan_pihak'] ?>" name="pendidikan_pihak" id="pendidikan-pihak" class="info form-control">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" <?= dom()->formProses($data['pekerjaan_pihak']) ?> name="pekerjaan_pihak" value="pekerjaan_pihak" id="pekerjaan-pihak" class="info form-control">
                  </div>
                </div>
              </div>
              <br>


              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Alamat Pihak </label>
                  <div class="col-sm-8">
                    <textarea cols="10" <?= dom()->formProses($data['alamat_pihak']) ?> id="alamat-pihak" name="alamat_pihak" class="form-control info" rows="3"><?= $data['alamat_pihak']; ?></textarea>
                  </div>
                </div>
              </div>
              <hr>
              <h4 style="margin-left: 200px ;">Data Delegasi Kirim</h4>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Nomor Surat </label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['nomor_surat']) ?> required value="<?= $data['nomor_surat'] ?>" autocomplete="off" name="nomor_surat" class="info form-control">
                  </div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Surat </label>
                  <div class="col-sm-8">
                    <input type="text" required autocomplete="off" <?= dom()->formProses($data['tgl_surat']) ?> value="<?= $data['tgl_surat'] ?>" name="tgl_surat" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Delegasi </label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['tgl_delegasi']) ?> required autocomplete="off" value="<?= $data['tgl_delegasi'] ?>" name="tgl_delegasi" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Sidang </label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['tgl_sidang']) ?> value="<?= $data['tgl_sidang'] ?>" required autocomplete="off" name="tgl_sidang" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Biaya Delegasi </label>
                  <div class="col-sm-6">
                    <input type="text" <?= dom()->formProses($data['biaya']) ?> value="<?= $data['biaya'] ?>" required name="biaya" autocomplete="off" id="biaya" class="info form-control">
                  </div>
                  <div class="col-sm-4">
                    <button <?= dom()->formProses($data['biaya']) ?> onclick="setRadius()" data-toggle="modal" data-target="#modelIdR" type="button" class="btn btn-warning"><i class="icons icon-list"></i> Daftar Radius</button>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Catatan </label>
                  <div class="col-sm-8">
                    <textarea required <?= dom()->formProses($data['catatan']) ?> name="catatan" autocomplete="off" class="info form-control" cols="10" rows="3"><?= $data['catatan']; ?></textarea>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Nomor Resi </label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['nomor_resi']) ?> value="<?= $data['nomor_resi'] ?>" name="nomor_resi" class="info form-control">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Resi </label>
                  <div class="col-sm-8">
                    <input type="text" <?= dom()->formProses($data['tgl_resi']) ?> value="<?= $data['tgl_resi'] ?>" name="tgl_resi" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> File Pengantar </label>
                  <div class="col-sm-8">
                    <?php if (empty($data['file'])) { ?>
                      <input type="file" multiple name="document[]" class="info form-control">
                    <?php } else { ?>
                      <input type="file" multiple name="document[]" class="info form-control">
                      <br>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($data['file'] as $f => $v) { ?>
                            <tr>
                              <td><?= ++$f; ?></td>
                              <td><a target="_blank" href="<?= base_url('uploads/surat/keluar/') . $v['file'] ?>"><?= $v['file'] ?></a></td>
                              <td><button data-id="<?= $v['id'] ?>" type="button" class="btn btn-danger hapus-file">Hapus</button></td>
                            </tr>
                          <?php } ?>
                        </tbody>

                      </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <br>
              <a href="<?= base_url('TabayunKeluar/daftar') ?>" class="btn btn-secondary margin-right-2"><i class="fa fa-backward"></i> Kembali</a>
              <button type="button" id="edit" class="btn btn-warning margin-right-2"><i class="fa fa-pencil"></i> Edit</button>
              <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
              <?= dom()->siapProses($data['file']); ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Silahkan Pilih Pihak yang akan di Panggil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <p>ok</p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelIdR" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-radius"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <table id="trad" class="table table-striped table-hover table-inverse table-responsive">
            <thead class="thead-inverse">
              <tr>
                <th>No</th>
                <th>Nama Kelurahan</th>
                <th>Nama Kecamatan</th>
                <th>Nama Radius</th>
                <th>Biaya Radius</th>
              </tr>
            </thead>
            <tbody id="rad">
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url() ?>assets/backend/js/autocomplete.js"></script>
<script>
  function buttonradius() {
    document.querySelector('button.btn.btn-warning')
      .removeAttribute('disabled')
  }

  var pihak = null;

  const input = document.getElementById("input-perkara");
  autocomplete(input, "<?= base_url() ?>FormSupport/nomor_perkara", () => {
    input.addEventListener('blur', function() {
      if (this.value != '') {
        document.querySelector('button.btn.bg-blue.text-white.margin-right-2').removeAttribute('disabled')
      }
    })
  });

  autocomplete(document.getElementById('perPN'), "<?= base_url() ?>FormSupport/daftar_pn", () => {})

  async function pilihpihak(params) {
    const body = new FormData()
    body.append('value', input.value)

    const data = await fetch("<?= base_url() ?>FormSupport/pilih_pihak", {
      method: "POST",
      body: body
    }).then(response => response.text())

    placing(data)

  }

  function placing(element, callback) {
    const target = document.querySelector('div div.container-fluid')
    target.innerHTML = element
    afterplacing()
  }


  const hapusbtn = document.getElementsByClassName('hapus-file');
  for (let y = 0; y < hapusbtn.length; y++) {
    const element = hapusbtn[y];
    element.addEventListener('click', function() {
      confirmAlert({
          title: 'Apa Anda Yakin?',
          text: "Data Yang di Hapus Tidak akan Kembali",
          icon: 'warning',
        })
        .then(async (result) => {
          if (result.isConfirmed) {
            const hasil = await fetch(base_url + 'TabayunKeluar/deleteFile?id=' + this.dataset.id).then((hasil) => hasil.json())
            notifAlert(hasil).then(() => {
              location.reload()
            })
          }
        })
    })
  }


  function afterplacing() {
    const everypihak = document.getElementsByClassName('pihak')
    for (let item of everypihak) {
      item.onclick = function() {
        placeData(this)
      }
    }
  }

  function closeAllModals() {
    const modals = document.getElementsByClassName('modal');
    for (let i = 0; i < modals.length; i++) {
      modals[i].classList.remove('show');
      modals[i].setAttribute('aria-hidden', 'true');
      modals[i].setAttribute('style', 'display: none');
    }
    const modalsBackdrops = document.getElementsByClassName('modal-backdrop');
    for (let i = 0; i < modalsBackdrops.length; i++) {
      document.body.removeChild(modalsBackdrops[i]);
    }
  }

  function placeData(data) {
    findForm('nama-pihak', data.textContent)
    findForm('agama-pihak', data.dataset.agama)
    findForm('pendidikan-pihak', data.dataset.pendidikan)
    findForm('pekerjaan-pihak', data.dataset.pekerjaan)
    findForm('alamat-pihak', data.dataset.alamat)
    findForm('tempat-lahir', data.dataset.tempatlahir)
    findForm('tanggal-lahir', data.dataset.tanggallahir)
    findForm('biodata-pihak', data.textContent + ',' + ' ' + data.dataset.tempatlahir + ',' + ' ' + data.dataset.tanggallahir + ',' + ' ' + data.dataset.agama + ',' + ' ' + data.dataset.pendidikan + ',' + ' ' + data.dataset.pekerjaan + ',' + ' ' + data.dataset.alamat)
  }


  function findForm(id, value) {
    if (value) {
      document.getElementById(id).value = value
    } else {
      document.getElementById(id).value = ' '
    }
  }

  var result = '';

  async function setRadius() {
    const namapn = document.getElementById('perPN').value
    const body = new FormData()
    body.append('namapn', namapn)
    if (result == '') {
      result = await fetch('<?= base_url() ?>FormSupport/findRadius', {
        method: 'POST',
        body: body
      }).then(response => response.text())
      placeRadius()
      document.querySelector('h5.modal-title.title-radius').textContent = 'DAFTAR RADIUS ' + document.getElementById('perPN').value
    } else {
      return false;
    }
  }

  document.getElementById('edit').addEventListener('click', function(e) {
    const allForm = document.getElementsByClassName('form-control')
    for (let i = 0; i < allForm.length; i++) {
      const element = allForm[i];
      element.removeAttribute('disabled')
    }
  })

  function placeRadius() {
    document.getElementById('rad').innerHTML = result
    datatableradius()
  }

  function selectRadius(params) {
    document.getElementById('biaya').value = params
  }

  document.getElementById('siapProses').addEventListener('click', function(e) {
    const idTabayun = document.getElementById('idTabayun').value
    confirmAlert({
      title: 'Apa Anda Yakin?',
      text: "Data Yang di Kirim Tidak Bisa di Ubah",
      icon: 'warning',
      showLoaderOnConfirm: true,
      preConfirm: async () => {
        try {
          const hasil = await fetch(base_url + 'TabayunKeluar/sendData?data=' + idTabayun)
            .then((response) => response.json())
          return hasil;
        } catch (error) {
          notifAlert({
            title: 'Error',
            icon: 'error',
            text: 'Data Gagal di Kirim'
          })
        }
      },
    }).then(async (result) => {
      if (result.isConfirmed) {
        notifAlert(result.value).then(() => {
          location.href = base_url + 'TabayunKeluar/daftar'
        })
      }
    })
  })
</script>