<div id="content">
  <?= Components::load('panel'); ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Tambah User Baru</h3>
        </div>
        <div class="panel-body">
          <div class="col-md-2">
          </div>
          <div class="col-md-8">
            <form action="<?= base_url('user') ?>" method="POST" enctype="multipart/form-data">
              <br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Username (Login)</label>
                <div class="col-sm-10">
                  <input required name="username" type="text" class="info form-control">
                </div>
              </div>

              <br><br>

              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Password (Login)</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="password" autocomplete="off" required name="password" class="danger form-control" aria-label="Text input with multiple buttons">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-danger" aria-label="Help"><span class="icons icon-eye"></span></button>
                    </div>
                  </div>
                </div>
              </div>

              <br><br>

              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Email (Login)</label>
                <div class="col-sm-10">
                  <input required name="email" type="email" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Role (Level User)</label>
                <div class="col-sm-10">
                  <select id="form-level-user" required name="level" required class="info form-control">
                    <option disabled selected>Pilih Satu</option>
                    <?php foreach (Role::all()->result() as $r) { ?>
                      <option value="<?= $r->id ?>"><?= $r->nama_role ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <br><br>
              <div class="form-group" id="row-form-nama-lengkap">
                <label class="col-sm-2 control-label text-right">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input required name="nama_lengkap" type="text" class="info form-control">
                </div>
              </div>
              <div class="form-group" id="row-form-nama-jurusita" hidden>
                <label class="col-sm-2 control-label text-right">Nama Lengkap</label>
                <div class="col-sm-10">
                  <select name="nama_lengkap" id="form-nama-jurusita" class="info form-control" disabled>
                    <option>Pilih Jurusita</option>
                    <?php foreach ($this->SIPP->jurusitaaktif() as $js) { ?>
                      <option><?= $js->nama_gelar; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input required name="nomor_telepon" type="text" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Pilih Foto</label>
                <div class="col-sm-6">
                  <?php $avf = array('avatar.jpg', 'avatar2.png', 'avatar3.png') ?>
                  <?php foreach ($avf as $f) { ?>
                    <a href="javascript:void(0)"><img width="100" src="<?= base_url('assets/backend/img/') . $f ?>" data-name="<?= $f ?>" alt="avatar"></a>
                  <?php } ?>
                  <input type="hidden" id="foto">
                </div>
                <div class="col-sm-2">
                  Atau Upload<input type="file" name="file">
                </div>
              </div>
              <br><br><br><br><br><br><br>
              <a href="<?= base_url('konfigurasi/user') ?>" class="btn btn-secondary"><i class="fa fa-backward"></i> Kembali</a>
              <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Tambah</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const password = document.querySelector('input.danger.form-control')
  const button = document.querySelector('button.btn.btn-danger')
  button.addEventListener('click', function(e) {
    if (password.type == 'password') {
      password.type = 'text'
    } else {
      password.type = 'password'
    }
  })
  const img = document.getElementsByTagName('img')
  for (let i = 0; i < img.length; i++) {
    const element = img[i];
    element.onclick = function() {
      for (let y = 0; y < img.length; y++) {
        img[y].removeAttribute('style')
      }
      this.style.borderRadius = '20%';
      document.getElementById('foto').setAttribute('name', 'foto')
      document.getElementById('foto').value = this.dataset.name
    }
  }

  document.getElementById('form-level-user').addEventListener('change', function(e) {
    if (this.value == 5) {
      document.getElementById('row-form-nama-lengkap').remove()
      document.getElementById('row-form-nama-jurusita').removeAttribute('hidden')
      document.getElementById('form-nama-jurusita').removeAttribute('disabled')


    }
  })
</script>