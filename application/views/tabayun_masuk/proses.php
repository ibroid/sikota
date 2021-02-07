<div id="content">
  <?= Components::load('panel') ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rincian Tabayun Masuk</h3>
        </div>
        <div class="panel-body">
          <a href="<?= base_url('TabayunMasuk/control') ?>" class="btn btn-secondary margin-right-2"><i class="fa fa-backward"></i> Kembali</a>
          <br><br>
          <table class="table table-responsive">
            <thead class="bg-primary text-white">
              <tr>
                <th>Pengaju</th>
                <th>Nomor &<br> Jenis Perkara</th>
                <th>Tanggal Sidang</th>
                <th>Jenis Delegasi</th>
                <th>Tanggal Delegasi</th>
                <th>Biaya di Terima</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?= $data->pn_asal_text; ?></td>
                <td><?= $data->nomor_perkara . '<br>' . $data->jenis_perkara_text; ?></td>
                <td><?= dateToText()->format_indo($data->tgl_sidang); ?></td>
                <td><?= $data->jenis_delegasi_text  ?></td>
                <td><?= dateToText()->format_indo($data->tgl_delegasi); ?></td>
                <td><?= buatrp($data->biaya); ?></td>
                <td><?= dom()->tahapanProses($data->proses->status_delegasi); ?></td>
              </tr>
            </tbody>
          </table>

          <table class="table table-responsive">
            <thead class="bg-primary text-white">
              <tr>
                <th>Pihak</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?= $data->pihak; ?></td>
                <td><?= $data->tempat_lahir_pihak; ?> <br> <?= dateToText()->format_indo($data->tanggal_lahir_pihak); ?></td>
                <td><?= $data->pendidikan_pihak; ?></td>
                <td><?= $data->pekerjaan_pihak; ?></td>
                <td width="300"><?= $data->alamat_pihak; ?></td>
              </tr>

            </tbody>
          </table>

          <hr>
          <div class="col-md-12 tab-content">
            <?= Notifikasi::showFlash(); ?>

            <div role="tabpanel" class="tab-pane fade active in" id="tabs-area-demo" aria-labelledby="tabs1">
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="col-md-12 tabs-area">
                    <div class="liner"></div>
                    <ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
                      <li class="active">
                        <a href="#tabs-demo6-area1" data-toggle="tab" title="profile">
                          <span data-toggle="tooltip" data-placement="top" title="Penunjukan Jurusita" class="round-tabs two">
                            <i class="glyphicon glyphicon-user"></i>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#tabs-demo6-area2" data-toggle="tab" title="welcome">
                          <span data-toggle="tooltip" data-placement="top" title="Berkas Delegasi" class="round-tabs one">
                            <i class="glyphicon glyphicon-file"></i>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#tabs-demo6-area3" data-toggle="tab" title="bootsnipp goodies">
                          <span data-toggle="tooltip" data-placement="top" title="Pelaksanaan Delgasi" class="round-tabs three">
                            <i class="glyphicon glyphicon-road"></i>
                          </span> </a>
                      </li>
                      <li>
                        <a href="#tabs-demo6-area4" data-toggle="tab" title="blah blah">
                          <span data-toggle="tooltip" data-placement="top" title="Pengiriman Berkas Kembali" class="round-tabs four">
                            <i class="glyphicon glyphicon-level-up"></i>
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#tabs-demo6-area5" data-toggle="tab" title="completed">
                          <span data-toggle="tooltip" data-placement="top" title="Selesai" class="round-tabs five">
                            <i class="glyphicon glyphicon-ok"></i>
                          </span> </a>
                      </li>
                    </ul>

                    <div class="tab-content tab-content-v5">
                      <div class="tab-pane fade in active" id="tabs-demo6-area1">

                        <h3 class="head text-center">Penunjukan Jurusita</h3>
                        <form action="<?= base_url('TabayunMasuk/updateProses/2/' . $data->id) ?>" method="POST">
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Tanggal Penunjukan</label>
                              <div class="col-sm-8">
                                <input type="text" name="tgl_penunjukan_jurusita" required autocomplete="off" value="<?= $data->proses->tgl_penunjukan_jurusita ?>" class="info form-control datepicker">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Nama Jurusita</label>
                              <div class="col-sm-8">
                                <select name="jurusita_id" class="form-control info" required>
                                  <?php if ($data->proses->jurusita_id) { ?>
                                    <option selected value="<?= $data->proses->jurusita_id ?>"><?= $data->proses->jurusita_nama; ?></option>
                                  <?php } ?>
                                  <option disabled>Pilih Salah Satu</option>
                                  <?php foreach ($this->SIPP->jurusitaaktif() as $js) { ?>
                                    <option class="opsi-js" data-id="<?= $js->id ?>" value="<?= $js->id ?>"><?= $js->nama_gelar; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <?php if ($data->status_kirim != 1) {
                            echo " <p class=\"text-center\">
                            <button class=\"btn btn-success btn-round green\"> Simpan Proses <span style=\"margin-left:10px;\" class=\"glyphicon glyphicon-ok\"></span></button>
                          </p>";
                          } ?>
                        </form>
                        <br><br><br>
                      </div>
                      <div class="tab-pane fade" id="tabs-demo6-area2">
                        <h3 class="head text-center">Berkas Delegasi </h3>
                        <div class="card text-left card-info">
                          <div class="card-body">
                            <h4 class="card-title">Title</h4>
                            <table class="table table-bordered table-responsiv">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td scope="row">1</td>
                                  <td>Surat Permohonan Delegasi</td>
                                  <td>
                                    <?php foreach ($data->files as $file) { ?>
                                      <?php if ($data->_id != '') {
                                        echo "<a href=\"http://$file->file\" target=\"_blank\">Download &nbsp;</a>";
                                      } else {
                                        echo "<a href=\"" . base_url('uploads/surat/masuk/' . $file->file) . "\" target=\"_blank\">Download &nbsp;</a>";
                                      } ?>

                                    <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td scope="row">2</td>
                                  <td>Cetak Relaas</td>
                                  <td><a href="<?= base_url('Cetak/relaas/') . $data->id ?>">Download</a></td>
                                </tr>
                                <tr>
                                  <td scope="row">3</td>
                                  <td>Amplop Relaas</td>
                                  <td><a href="<?= base_url('Cetak/amplop_relaas/') . $data->id ?>">Download</a></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tabs-demo6-area3">
                        <h3 class="head text-center">Pelaksanaan Delegasi</h3>
                        <form action="<?= base_url('TabayunMasuk/updateProses/3/') . $data->id ?>" method="POST">
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Nomor Relaas</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->nomor_perkara ?>" required autocomplete="off" name="nomor_relaas" class="info form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Tanggal Pelaksanaan</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->proses->tgl_pelaksanaan ?>" name="tgl_pelaksanaan" required autocomplete="off" class="info form-control datepicker">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Status Pelaksanaan</label>
                              <div class="col-sm-8">
                                <select name="status_pelaksanaan" class="form-control info">
                                  <?php if ($data->proses->status_pelaksanaan) { ?>
                                    <option selected><?= $data->proses->status_pelaksanaan ?></option>
                                  <?php } ?>
                                  <option>Bertemu (ditandatangani)</option>
                                  <option>Bertemu (tidak bersedia tanda tangan)</option>
                                  <option>Tidak Bertemu (diterima lurah/kantor desa)</option>
                                  <option>Tidak Bertemu (Alamat Tidak ada)</option>
                                  <option>Tidak Dilaksanakan</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Catatan Pelaksanaan</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control info" name="catatan" value="<?= $data->proses->catatan; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <?php if ($data->status_kirim != 1) { ?>
                              <?php if ($data->proses->status_delegasi > 1) { ?>
                                <p class="text-center">
                                  <button class="btn btn-success btn-round green"> Simpan Proses <span style="margin-left:10px;" class="glyphicon glyphicon-ok"></span></button>
                                </p>
                              <?php } ?>
                            <?php } ?>
                          </div>
                          <br><br>
                        </form>

                      </div>
                      <div class="tab-pane fade" id="tabs-demo6-area4">
                        <h3 class="head text-center">Pengiriman Berkas Kembali!</h3>
                        <form action="<?= base_url('TabayunMasuk/updateProses/4/') . $data->id ?>" method="POST">
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Tanggal Pengiriman Relaas Kembali</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->proses->tgl_pengiriman_relaas ?>" required autocomplete="off" name="tgl_pengiriman_relaas" class="info datepicker form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Nomor Surat Pengantar</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= !$data->proses->nomor_surat_pengantar_relaas ? Nomor_surat::tabayunKeluar() : $data->proses->nomor_surat_pengantar_relaas  ?>" required autocomplete="off" name="nomor_surat_pengantar_relaas" class="info form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Tanggal Surat Pengantar</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->proses->tgl_surat_pengantar_relaas ?>" required autocomplete="off" name="tgl_surat_pengantar_relaas" class="info datepicker form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Tanggal Resi</label>
                              <div class="col-sm-8">
                                <input type="text" required autocomplete="off" value="<?= $data->proses->tgl_resi ?>" name="tgl_resi" class="info datepicker form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Nomor Resi</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->proses->nomor_resi ?>" required autocomplete="off" name="nomor_resi" class="info form-control">
                              </div>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="form-group">
                              <label class="col-sm-3 control-label text-right">Biaya Pengiriman</label>
                              <div class="col-sm-8">
                                <input type="text" value="<?= $data->proses->biaya ?>" required autocomplete="off" name="biaya" class="info form-control">
                              </div>
                            </div>
                          </div>
                          <?php if ($data->status_kirim != 1) { ?>
                            <?php if ($data->proses->status_delegasi > 2) { ?>
                              <p class="text-center">
                                <button class="btn btn-success btn-round green"> Simpan Proses <span style="margin-left:10px;" class="glyphicon glyphicon-ok"></span></button>
                              </p>
                            <?php } ?>
                          <?php } ?>
                          <br><br>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="tabs-demo6-area5">
                        <div class="text-center">
                          <i class="img-intro icon-checkmark-circle"></i>
                        </div>
                        <h3 class="head text-center">Upload Dokumen Pelaksanaan</h3>
                        <p class="narrow text-center">
                          Silahkan Upload dokumen pelaksanaan untuk menyelesaikan delgasi
                        </p>
                        <br>
                        <form action="<?= base_url('TabayunMasuk/updateProses/5/') . $data->id ?>" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <input type="file" class="info form-control" name="file"><br>
                              <table class="table table-bordered table-inverse table-responsive">
                                <thead class="thead-default">
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Doc Pelaksanaan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($data->hasil as $no => $val) { ?>
                                    <tr>
                                      <td><?= ++$no; ?></td>
                                      <td><a href=""><strong> <?= $val->file; ?></strong></a></td>
                                      <td><?= dateToText()->format_indo($val->diinput_tanggal); ?></td>
                                      <td><a href="<?= base_url('TabayunMasuk/hapusFileBalasan?file=') . $val->file . '&id=' . $this->uri->segment(3) ?>" class="text-danger">Hapus</a></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php if ($data->status_kirim != 1) { ?>
                            <?php if ($data->proses->status_delegasi > 3) { ?>
                              <p class="text-center">
                                <button class="btn btn-success btn-round green"> Upload File <span style="margin-left:10px;" class="glyphicon glyphicon-ok"></span></button>

                                <?php if (!empty($data->hasil)) { ?>
                                  <button type="button" id="btn-kirim-balasan" class="btn btn-primary btn-round primary"> Kirim Balasan <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></button>
                                <?php } ?>
                              </p>
                            <?php } ?>
                          <?php } ?>
                          <br>
                          <br>
                        </form>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var base_url = "<?= base_url() ?>";
  const btnKirimBalasan = document.getElementById("btn-kirim-balasan")
  if (btnKirimBalasan) btnKirimBalasan.addEventListener('click', function(e) {
    confirmAlert({
      title: "Data Akan di Kirim",
      text: "Pastikan Semua Data Sudah Terisi dan Benar!",
      icon: "warning",
      showLoaderOnConfirm: true,
      preConfirm: async () => {
        const body = new FormData()
        body.append('id', '<?= $this->uri->segment(3) ?>')
        const result = await fetch(base_url + 'TabayunMasuk/kirimBalasan', {
          method: 'POST',
          body: body
        }).then(response => {
          return response.json()
        })
        return result;
      }
    }).then((result) => {
      if (result.isConfirmed) {
        notifAlert(result.value).then((err) => {
          if (err) console.log(err);
          location.href = base_url + 'TabayunMasuk/control'
        })
      }
    })
  })
</script>