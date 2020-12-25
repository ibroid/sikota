<div id="content">
  <?= Components::load('panel') ?>

  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash(); ?>
      <div class="panel">
        <div class="panel-heading">
          <h3>Konfigurasi</h3>
        </div>
        <div class="panel-body">
          <div class="container">
            <form action="<?= base_url('satker') ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Satker</label>
                  <div class="col-sm-8"><input name="NamaPN" readonly value="<?= $sys_config['NamaPN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kode Satker</label>
                  <div class="col-sm-8"><input readonly name="kode_satker" value="<?= $sys_config['kode_satker'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kode PA</label>
                  <div class="col-sm-8"><input readonly name="KodePN" value="<?= $sys_config['KodePN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Website Satker</label>
                  <div class="col-sm-8"><input name="Website" readonly type="text" value="<?= $sys_config['Website'] ?>" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Email Satker</label>
                  <div class="col-sm-8"><input readonly name="Email" type="text" value="<?= $sys_config['Email'] ?>" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nomor Telepon</label>
                  <div class="col-sm-8"><input readonly name="NomorTelepon" value="<?= $sys_config['NomorTelepon'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Alamat</label>
                  <div class="col-sm-8"><input name="AlamatPN" readonly value="<?= $sys_config['AlamatPN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Logo</label>
                  <div class="col-sm-2"><img width="200" src="<?= base_url('assets/logo/') . $sys_config['Logo'] ?>" alt="logo"></div>
                  <div class="col-sm-4 margin-left-2"><input disabled name="file" class="form-control" type="file"></div>
                </div>
              </div>
              <br>
              <button class="btn btn-warning" type="button"><i class="fa fa-pencil-square-o"></i> Edit</button>
              <a href="<?= base_url('satker/sync') ?>" class="btn btn-primary margin-right-2" disabled><i class="fa fa-chain"></i> Sinkron</a>
              <button class="btn btn-success" disabled type="submit"><i class="fa fa-save"></i> Save</button>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const editButton = document.querySelector('button.btn.btn-warning')
  editButton.onclick = function() {
    const allForm = document.querySelectorAll('input.form-control')
    for (let i = 0; i < allForm.length; i++) {
      const element = allForm[i];
      element.removeAttribute('readonly')
      element.removeAttribute('disabled')
      document.querySelector('button.btn.btn-success').removeAttribute('disabled')
      document.querySelector('a.btn.btn-primary').removeAttribute('disabled')
      element.classList.remove('border-left')
      element.classList.add('info')
    }
  }
</script>