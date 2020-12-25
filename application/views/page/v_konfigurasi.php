<div id="content">
  <div class="panel">
    <div class="panel-body padding-0">
      <div class="col-md-12 col-sm-12">
        <h3 class="animated fadeInLeft">Konfigurasi</h3>
        <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Jakarta,Indonesia</p>

        <ul class="nav navbar-nav">
          <?php foreach ($sub_menu as $sb) { ?>
            <li><a href="<?= base_url().$sb->link_sub  ?>"><?= $sb->nama_sub ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <!-- cuaca -->
    </div>
  </div>

  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Konfigurasi</h3>
        </div>
        <div class="panel-body">
          <div class="container">
            <form action="">
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Satker</label>
                  <div class="col-sm-8"><input readonly value="<?= $sys_config['NamaPN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kode Satker</label>
                  <div class="col-sm-8"><input readonly value="<?= $sys_config['kode_satker'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kode PA</label>
                  <div class="col-sm-8"><input readonly value="<?= $sys_config['KodePN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Email Satker</label>
                  <div class="col-sm-8"><input readonly type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nomor Telepon</label>
                  <div class="col-sm-8"><input readonly type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Alamat</label>
                  <div class="col-sm-8"><input readonly value="<?= $sys_config['AlamatPN'] ?>" type="text" class="border-left form-control"></div>
                </div>
              </div>
              <br>
              <button class="btn btn-warning" type="button"><i class="fa fa-pencil-square-o"></i>  Edit</button>
              <button class="btn btn-primary margin-right-2"><i class="fa fa-chain"></i>  Sinkron</button>
              <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>  Save</button>
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
    for (let i = 0; i  < allForm.length; i++) {
      const element = allForm[i] ;
      element.removeAttribute('readonly')
      element.classList.remove('border-left')
      element.classList.add('info')
    }
  }
</script>