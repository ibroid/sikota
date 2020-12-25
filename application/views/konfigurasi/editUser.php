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
            <form action="<?= base_url('user/update') ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="slug" value="<?= $user->slug ?>">
              <br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Username (Login)</label>
                <div class="col-sm-10">
                  <input required disabled name="username" value="<?= $user->username ?>" type="text" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Email (Login)</label>
                <div class="col-sm-10">
                  <input required disabled name="email" value="<?= $user->email ?>" type="email" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input required disabled value="<?= $user->nama_lengkap ?>" name="nama_lengkap" type="text" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input required disabled value="<?= $user->nomor_telepon ?>" name="nomor_telepon" type="text" class="info form-control">
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Role (Level User)</label>
                <div class="col-sm-10">
                  <select required disabled name="level" required class="info form-control">
                    <option disabled selected><?= $user->nama_role; ?></option>
                    <?php foreach (Role::all()->result() as $r) { ?>
                      <option value="<?= $r->id ?>"><?= $r->nama_role ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <br><br>
              <div class="form-group">
                <label class="col-sm-2 control-label text-right">Pilih Foto</label>
                <div class="col-sm-2">
                  <img src="<?= base_url('assets/backend/img/') . $user->foto ?>" width="100" alt="foto">
                </div>
                <div class="col-sm-6">
                  Atau Upload<input disabled type="file" name="file" class="form-control">
                </div>
              </div>
              <br><br><br><br><br><br><br>
              <a href="<?= base_url('konfigurasi/user') ?>" class="btn btn-secondary"><i class="fa fa-backward"></i> Kembali</a>
              <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
              <button class="btn btn-success" disabled type="submit"><i class="fa fa-save"></i> Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const formB = document.querySelectorAll('.form-control')
  const editB = document.querySelector('button.btn.btn-warning')
  editB.addEventListener('click', function() {
    for (let i = 0; i < formB.length; i++) {
      formB[i].removeAttribute('disabled')
    }
    document.querySelector('button.btn.btn-success').removeAttribute('disabled')
  })
</script>