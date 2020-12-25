<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/css/plugins/datatables.bootstrap.min.css') ?>" />
<div id="content">
  <div class="panel">
    <div class="panel-body padding-0">
      <div class="col-md-12 col-sm-12">
        <h3 class="animated fadeInLeft">Konfigurasi</h3>
        <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Jakarta,Indonesia</p>

        <ul class="nav navbar-nav">
          <?php foreach ($sub_menu as $sb) { ?>
            <li><a href="<?= base_url() . $sb->link_sub  ?>"><?= $sb->nama_sub ?></a></li>
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
                  <th>
                    <center>No</center>
                  </th>
                  <th>
                    <center>Nama Radius</center>
                  </th>
                  <th>
                    <center>Kecamatan</center>
                  </th>
                  <th>
                    <center>Kode Radius</center>
                  </th>
                  <th>
                    <center>Biaya</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?= Components::load('tabelradius', $radius); ?>
              </tbody>
            </table>
          </div>
          <!--Ahir Dari Data Table-->

        </div>
      </div>
    </div>
  </div>
</div>