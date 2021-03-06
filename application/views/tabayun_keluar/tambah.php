<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/autocomplete.css">
<div id="content">

  <?= Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash('notif'); ?>
      <div class="panel">
        <div class="panel-heading">
          <h3>Buat Tabayun Keluar</h3>
        </div>
        <div class="panel-body">
          <div class="container">
            <form action="<?= base_url() ?>TabayunKeluar/save" method="POST">
              <h4 style="margin-left: 200px ;">Status Delegasi Kirim</h4><br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Tujuan Delegasi</label>
                  <div class="col-sm-8">
                    <input type="text" required autocomplete="off" onblur="buttonradius()" id="perPN" value="PENGADILAN AGAMA " name="pn_tujuan_text" class="info form-control">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nomor Perkara</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" id="input-perkara" required autocomplete="off" name="nomor_perkara" class="info form-control">
                      <div class="input-group-btn">
                        <button type="button" onclick="pilihpihak()" data-toggle="modal" data-target="#modelId" disabled class="btn bg-blue text-white margin-right-2"><i class="icons icon-user-following"></i></i> Pilih Pihak</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Pihak</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="info form-control" name="pihak" id="nama-pihak" aria-label="Text input with multiple buttons">
                      <div class="input-group-btn">
                        <button type="button" data-toggle="modal" data-target="#modelIdPihak" class="btn bg-blue text-white" aria-label="Help"><span class="fa fa-eye"></span>&nbsp; Lihat Data Lengkap</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Jenis Delegasi</label>
                  <div class="col-sm-8">
                    <select required name="jenis_delegasi_text" id="jenis-delegasi" class="info form-control">
                      <?php foreach ($this->db->get('jenis_delegasi')->result() as $c) : ?><option><?= $c->jenis_delegasi; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="modal fade" id="modelIdPihak" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Data Pihak</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <input type="hidden" name="status_pihak" id="status-pihak">
                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Agama Pihak</label>
                            <div class="col-sm-8">
                              <input type="text" readonly name="agama_pihak" id="agama-pihak" class="info form-control">
                            </div>
                          </div>
                        </div>
                        <br>


                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right"> Tempat & Tanggal Lahir </label>
                            <div class="col-sm-4">
                              <input type="text" readonly name="tempat_lahir_pihak" id="tempat-lahir" class="info form-control">
                            </div>
                            <div class="col-sm-4">
                              <input type="text" readonly name="tanggal_lahir_pihak" id="tanggal-lahir" class="info form-control">
                            </div>
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Pendidikan & Pekerjaan</label>
                            <div class="col-sm-4">
                              <input type="text" readonly name="pendidikan_pihak" id="pendidikan-pihak" class="info form-control">
                            </div>
                            <div class="col-sm-4">
                              <input type="text" readonly name="pekerjaan_pihak" id="pekerjaan-pihak" class="info form-control">
                            </div>
                          </div>
                        </div>
                        <br>


                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right"> Alamat Pihak </label>
                            <div class="col-sm-8">
                              <textarea cols="10" readonly id="alamat-pihak" name="alamat_pihak" class="form-control info" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" hidden id="formTglPutusan">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Tanggal Putusan</label>
                  <div class="col-sm-8">
                    <input type="text" autocomplete="off" id="inputTglPutusan" disabled name="tgl_putusan" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row" hidden id="formAmarPutusan">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Amar Putusan</label>
                  <div class="col-sm-8">
                    <textarea name="amar_putusan" id="inputAmarPutusan" disabled class="info form-control" cols="5" rows="4"></textarea>
                  </div>
                </div>
              </div>


              <h4 style="margin-left: 200px ;">Data Delegasi Kirim</h4>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Nomor Surat </label>
                  <div class="col-sm-8">
                    <input type="text" required value="<?= $this->nomor_surat::tabayunKeluar() ?>" autocomplete="off" name="nomor_surat" class="info form-control">
                  </div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Surat </label>
                  <div class="col-sm-8">
                    <input type="text" required autocomplete="off" name="tgl_surat" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Delegasi </label>
                  <div class="col-sm-8">
                    <input type="text" required autocomplete="off" name="tgl_delegasi" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Tanggal Sidang </label>
                  <div class="col-sm-8">
                    <input type="text" required autocomplete="off" name="tgl_sidang" id="tgl_sidang" class="info form-control datepicker">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Biaya Delegasi </label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" required name="biaya" autocomplete="off" id="biaya" class="warning form-control">
                      <div class="input-group-btn">
                        <button disabled onclick="setRadius()" data-toggle="modal" data-target="#modelIdR" type="button" class="btn btn-warning"><i class="icons icon-list"></i> Daftar Radius</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right"> Catatan </label>
                  <div class="col-sm-8">
                    <textarea name="catatan" autocomplete="off" class="info form-control" cols="10" rows="3"></textarea>
                  </div>
                </div>
              </div>
              <br>
              <button class="btn btn-primary margin-right-2"><i class="fa fa-folder-open"></i> Referensi Surat</button>
              <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Silahkan Pilih Pihak yang akan di Panggil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="place-pilih-pihak">
            <strong>MOHON TUNGGU BEBERAPA DETIK. BILA DATA TIDAK KELUAR SILAHKAN REFRESH</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->



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

  var input = document.getElementById("input-perkara");
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
    const target = document.getElementById('place-pilih-pihak')
    target.innerHTML = element
    afterplacing()
  }


  function afterplacing() {
    const everypihak = document.getElementsByClassName('pihak')
    for (let item of everypihak) {
      item.onclick = function() {
        placeData(this, (data) => {
          document.getElementById('tgl_sidang').value = data
        })
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

  function placeData(data, callback) {
    findForm('nama-pihak', data.textContent)
    findForm('status-pihak', data.dataset.status)
    findForm('agama-pihak', data.dataset.agama)
    findForm('pendidikan-pihak', data.dataset.pendidikan)
    findForm('pekerjaan-pihak', data.dataset.pekerjaan)
    findForm('alamat-pihak', data.dataset.alamat)
    findForm('tempat-lahir', data.dataset.tempatlahir)
    findForm('tanggal-lahir', data.dataset.tanggallahir)
    callback(data.dataset.tgl_sidang)
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

  function placeRadius() {
    document.getElementById('rad').innerHTML = result
    datatableradius()
  }

  function selectRadius(params) {
    document.getElementById('biaya').value = params
  }
  document.getElementById('jenis-delegasi').addEventListener('change', async function() {
    const formTglPutusan = document.getElementById('formTglPutusan');
    const formAmarPutusan = document.getElementById('formAmarPutusan');
    const inputTglPutusan = document.getElementById('inputTglPutusan');
    const inputAmarPutusan = document.getElementById('inputAmarPutusan');
    const pemberitahuan = [
      'Pemberitahuan Putusan Pengadilan Tingkat Pertama',
      'Pemberitahuan Putusan Pengadilan Tinggi',
      'Pemberitahuan Putusan Mahkamah Agung (Kasasi)',
      'Pemberitahuan Putusan Mahkamah Agung (PK)'
    ];
    const eval = pemberitahuan.indexOf(this.value);
    if (eval != -1) {
      formTglPutusan.removeAttribute('hidden');
      formAmarPutusan.removeAttribute('hidden');
      inputTglPutusan.removeAttribute('disabled');
      inputAmarPutusan.removeAttribute('disabled');
      const hasil = await fetch("<?= base_url() ?>FormSupport/getAmarPutusan", {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({
          data: input.value
        })
      }).then(response => response.json())
      console.log(hasil)
      inputTglPutusan.value = hasil.tanggal_putusan
      inputAmarPutusan.value = hasil.amar_putusan
    } else {
      formTglPutusan.setAttribute('hidden', true);
      formAmarPutusan.setAttribute('hidden', true);
      inputAmarPutusan.setAttribute('disabled', true);
      inputTglPutusan.setAttribute('disabled', true)
    }
  })
</script>