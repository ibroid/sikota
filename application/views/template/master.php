<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiKoTa</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>/css/bootstrap.min.css" />

  <!-- plugins -->

  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/simple-line-icons.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/animate.min.css" />
  <link href="<?= base_url('assets/backend/') ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/backend/datatables/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <style>
    .swal2-popup {
      font-size: 1.4rem !important;
    }
  </style>
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?= base_url('assets/backend/') ?>img/logomi.png">
</head>

<body id="mimin" class="dashboard">
  <!-- start: Header -->
  <nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
      <div class="navbar-header" style="width:100%;">
        <div class="opener-left-menu is-open">
          <span class="top"></span>
          <span class="middle"></span>
          <span class="bottom"></span>
        </div>
        <a href="index.html" class="navbar-brand">
          <b>SiKoTa</b>
        </a>
        <ul class="nav navbar-nav navbar-right user-nav ">
          <li class="user-name"><span>$user_name</span></li>
          <li class="dropdown avatar-dropdown mr-2">
            <img src="<?= base_url('assets/backend/') ?>img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" />
            <ul class="dropdown-menu user-dropdown">
              <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
              <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
              <li role="separator" class="divider"></li>
              <li class="more">
                <ul>
                  <li><a href=""><span class="fa fa-cogs"></span></a></li>
                  <li><a href=""><span class="fa fa-lock"></span></a></li>
                  <li><a href="<?= base_url('/login/destroy') ?>"><span class="fa fa-power-off "></span></a></li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- coffee chat -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- end: Header -->

  <div class="container-fluid mimin-wrapper">

    <!-- start:Left Menu -->
    <div id="left-menu">
      <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
          <li>
            <div class="left-bg"></div>
          </li>
          <li class="time">
            <h1 class="animated fadeInLeft"><?= date('H:i') ?></h1>
            <p class="animated fadeInRight"><?= date('d, D F Y') ?></p>
          </li>
          <?php foreach ($this->menu->menu() as $m) : ?>
            <li class="ripple"><a href="<?= base_url() . $m->link_menu ?>"><span class="icons <?= $m->logo_menu ?>"></span><?= $m->nama_menu ?></a></li>
          <?php endforeach; ?>

        </ul>
      </div>
    </div>
    <!-- end: Left Menu -->


    <!-- start: content -->
    <?= $contents; ?>
    <!-- end: content -->


    <!-- start: right menu -->

    <!-- end: right menu -->
  </div>

</body>
<!-- start: Mobile -->
<?= include 'mobile.php' ?>

<!-- end: Mobile -->
<!-- start: Javascript -->
<script src="<?= base_url('assets/backend/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/backend/') ?>js/bootstrap.min.js"></script>
<!-- plugins -->
<script src="<?= base_url('assets/backend/js/plugins/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/js/plugins/jquery.datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/js/plugins/datatables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/js/plugins/jquery.nicescroll.js'); ?>"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- plugins -->

<!--Global-->
<script src="<?php echo base_url('assets/backend/js/main.js') ?>"></script>
<script>
  var base_url = "<?= base_url() ?>";
  $(function() {
    $('.datepicker').daterangepicker({
      autoApply: true,
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2000,
      maxYear: 2025,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    datatable()
    datatableserver()
  });

  function datatable() {

    if ($('#datatables-example')) {
      $('#datatables-example').dataTable();
    }
  }

  function datatableradius() {
    $('#trad').dataTable();
  }

  function datatableserver(params) {
    if ($('#tListTabayun')) {
      const status = document.getElementById('tListTabayun')
      if (status) {
        const filter = status.dataset.filter
        $('#tListTabayun').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [],
          "ajax": {
            "url": "<?= base_url('TabayunKeluar/resource?status=') ?>" + filter,
            "type": "POST",
            "data": function(data) {
              data.pn_tujuan_text = $('#pn_tujuan_text').val();
              data.nomor_perkara = $('#nomor_perkara').val();
              data.jenis_delegasi_text = $('#jenis_delegasi_text').val();
              data.tgl_sidang = $('#tgl_sidang').val();
            }
          },
          "columnDefs": [{
            "targets": [0],
            "orderable": false,
          }, ],
        });
      }
    }
    if ($('#tTabayunMasuk')) {
      const status = document.getElementById('tTabayunMasuk')
      if (status) {
        const filter = status.dataset.filter
        $('#tTabayunMasuk').DataTable({
          "processing": true,
          "serverSide": true,
          "order": [],
          "ajax": {
            "url": "<?= base_url('TabayunMasuk/resource?status=') ?>" + filter,
            "type": "POST",
            "data": function(data) {
              data.pn_asal_text = $('#pn_tujuan_text').val();
              data.nomor_perkara = $('#nomor_perkara').val();
              data.jenis_delegasi_text = $('#jenis_delegasi_text').val();
              data.tgl_sidang = $('#tgl_sidang').val();
            }
          },
          "columnDefs": [{
            "targets": [0],
            "orderable": false,
          }, ],
        });
      }
    }
  }


  function confirmAlert(params) {
    let option = {
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Yakin!',
      reverseButtons: true,
      ...params
    }
    return Swal.fire(option)
  }

  function notifAlert(params) {
    return Swal.fire({
      title: params.title,
      text: params.text,
      icon: params.icon,
    })
  }
</script>
</body>

</html>