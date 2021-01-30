<div id="content">
  <?= Components::load('panel'); ?>
  <div class="col-md-12 padding-0">
    <div class="col-md-12">
      <?= Notifikasi::showFlash(); ?>
      <div class="panel">
        <div class="panel-heading">
          <h3>Konfigurasi User</h3>
        </div>
        <div class="panel-body">
          <a href="<?= base_url('Konfigurasi/addUser') ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah User</a>
          <br>
          <br>
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>
                    <center>No</center>
                  </th>
                  <th>
                    <center>Nama</center>
                  </th>
                  <th>
                    <center>Email</center>
                  </th>
                  <th>
                    <center>Username</center>
                  </th>
                  <th>
                    <center>Role</center>
                  </th>
                  <th>
                    <center>Foto</center>
                  </th>
                  <th>
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $y = 1;
                foreach ($user as $u) { ?>
                  <tr>
                    <td><?= $y++; ?></td>
                    <td><?= $u->nama_lengkap; ?></td>
                    <td><?= $u->email; ?></td>
                    <td><?= $u->username; ?></td>
                    <td><?= $u->nama_role; ?></td>
                    <td><a data-toggle="modal" data-target="#modelId<?= $u->id_pengguna ?>" href="javascript:void(0)"><?= $u->foto; ?></a> </td>
                    <td width="150">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Aksi
                          <span class="fa fa-angle-down"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="<?= base_url('Konfigurasi/editUser/') . $u->slug ?>">Edit</a></li>
                          <li><a data-id="<?= $u->slug ?>" id="btn-hapus-user" href="javascript:void(0)">Hapus</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php foreach ($user as $f) { ?>

            <div class="modal fade" id="modelId<?= $f->id_pengguna ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="<?= base_url('assets/backend/img/') . $f->foto ?>" alt="">
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var base_url = '<?= base_url() ?>'
  document.getElementById('btn-hapus-user').addEventListener('click', function(e) {
    confirmAlert({
      title: "Apa anda yakin ?",
      text: "User yang di hapus tidak bisa kembali",
      icon: "warning"
    }).then((result) => {
      if (result.isConfirmed) location.href = base_url + 'User/delete/' + e.target.dataset.id
    })
  })
</script>