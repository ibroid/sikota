<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Maliki">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sikota-Login</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/simple-line-icons.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/') ?>css/plugins/icheck/skins/flat/aero.css" />
  <link href="<?= base_url('assets/backend/') ?>css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="<?= base_url('assets/backend/') ?>img/logomi.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">
  <div class="container">
    <form class="form-signin" action="<?= base_url('login/proccess') ?>" method="POST">
      <?= $this->session->flashdata('notif'); ?>
      <div class="panel periodic-login">
        <span class="atomic-number"> 1.0.4</span>
        <div class="panel-body text-center">
          <h4 class="atomic-symbol">SKT</h4>
          <p class="atomic-mass">Login</p>
          <p class="element-name">Pengguna</p>

          <div class="form-group form-animate-text" style="margin-top:40px !important;">
            <input type="text" class="form-text" name="username" required>
            <span class="bar"></span>
            <label>Username</label>
          </div>
          <div class="form-group form-animate-text" style="margin-top:40px !important;">
            <input password-field type="password" class="form-text" name="password" required>
            <span class="bar"></span>
            <label>Password</label>
          </div>
          <label class="pull-left">
            <input type="checkbox" id="icheck" class="icheck pull-left" name="checkbox1" /> Show Password
          </label>
          <button class="btn col-md-12 btn-danger">Log In</button>
        </div>
        <div class="text-center" style="padding:5px;">
        </div>
      </div>
    </form>

  </div>
  <footer>
    <center>
      <p class="text-white">Copyrights &#169; <?= date('Y') ?> MIT Liscense By Zein & Maliki</p>
    </center>
  </footer>

  <!-- end: Content -->
  <!-- start: Javascript -->
  <script src="<?= base_url('assets/backend/') ?>js/jquery.min.js"></script>
  <script src="<?= base_url('assets/backend/') ?>js/jquery.ui.min.js"></script>
  <script src="<?= base_url('assets/backend/') ?>js/bootstrap.min.js"></script>

  <script src="<?= base_url('assets/backend/') ?>js/plugins/moment.min.js"></script>
  <script src="<?= base_url('assets/backend/') ?>js/plugins/icheck.min.js"></script>

  <!-- custom -->
  <script src="<?= base_url('assets/backend/') ?>js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-aero',
        radioClass: 'iradio_flat-aero'
      });


    });
  </script>
  <!-- end: Javascript -->
</body>

</html>