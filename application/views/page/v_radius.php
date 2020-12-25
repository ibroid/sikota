<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/css/plugins/datatables.bootstrap.min.css') ?>"/>
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
          <h3>Konfigurasi Radius</h3>
        </div>
        <div class="panel-body">
                  <button data-toggle="modal" data-target="#ModalRadius" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Radius</button>
<br>
<br>
<!--Memulai Datatable-->
        <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th><center>No</center></th>
                    <th><center>Kode Radius</center></th>
                    <th><center>Nama Radius</center></th>
                    <th><center>Kelurahan</center></th>
                    <th><center>Kecamatan</center></th>
                    <th><center>Kab/Kota</center></th>
                    <th><center>Provinsi</center></th>
                    <th><center>Biaya</center></th>
                    <th><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                        $no = 1;
                           foreach ($radius as $r) :
                    ?>
                  <tr>
                    <td><center><?= $no++; ?></center></td>
                    <td><center><?= $r['kode_radius']; ?></center></td>
                    <td><center><?= $r['keterangan']; ?></center></td>
                    <td><center><?= $r['kelurahan']; ?></center></td>
                    <td><center><?= $r['kecamatan']; ?></center></td>
                    <td><center><?= $r['kab_kota']; ?></center></td>
                    <td><center><?= $r['provinsi']; ?></center></td>
                    <td><center><?= $r['biaya_panggilan']; ?></center></td>
                    <td>
                            <!--
                              <center><button data-toggle="modal" data-target="#modelId2" onclick="edit_user(<?= $d->id ?>,'<?= $d->nama ?>','<?= $d->foto ?>')" class="btn btn-warning"><i class="fa fa-pencil fa-xs"></i></button><button class="btn btn-danger"><i class="fa fa-trash fa-xs"></i></button></center> -->
                            <center><button class="btn btn-warning"><i class="fa fa-pencil fa-xs"></i></button><button class="btn btn-danger"><i class="fa fa-trash fa-xs"></i></button></center>
                    </td>
                  	<?php
                       endforeach;
                    ?>
                </tbody>
              </table>
            </div>
<!--Ahir Dari Data Table-->

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalRadius" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Radius</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          
            <form action="">
              <div class="container">
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kode Radius</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Radius</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Kelurahan</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nama Kecamatan</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Kab/Kota</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Provinsi</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>
<br>
              <div class="row">
                <div class="form-group">
                  <label class="col-sm-2 control-label text-right">Nominal Rp.</label>
                  <div class="col-sm-3">
                    <input type="text" id="input-perkara" autocomplete="off" name="saldoAwal" class="info form-control">
                  </div>
                </div>
              </div>

            </form>
         </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- start: Javascript -->
<script src="<?php echo base_url('assets/backend/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/js/jquery.ui.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/js/bootstrap.min.js') ?>"></script>

<!-- plugins -->
<script src="<?php echo base_url('assets/backend/js/plugins/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/js/plugins/jquery.datatables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/js/plugins/datatables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/js/plugins/jquery.nicescroll.js') ?>"></script>

<!-- custom -->
<script src="<?php echo base_url('assets/backend/js/main.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>