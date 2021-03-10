<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Website Title -->
	<title>Kontrol - Delegasi</title>

	<!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
	<link href="<?php echo base_url('assets/halaman_publik/web/css/bootstrap.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/halaman_publik/web/css/fontawesome-all.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/halaman_publik/web/css/swiper.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/halaman_publik/web/css/magnific-popup.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/halaman_publik/web/css/styles.css') ?>" rel="stylesheet">



	<!-- Favicon  -->
	<link rel="icon" href="<?php echo base_url('assets/halaman_publik/web/images/favicon.png') ?>">
</head>

<body data-spy="scroll" data-target=".fixed-top">

	<!-- Preloader -->
	<div class="spinner-wrapper">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	<!-- end of preloader -->


	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
		<!-- Text Logo - Use this if you don't have a graphic logo -->
		<!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

		<!-- Image Logo -->
		<!--<a class="navbar-brand logo-image" href="#"><img src="<?php echo base_url('assets/halaman_publik/web/images/logo.svg') ?>" alt="alternative"></a>-->

		<!-- Mobile Menu Toggle Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-awesome fas fa-bars"></span>
			<span class="navbar-toggler-awesome fas fa-times"></span>
		</button>
		<!-- end of mobile menu toggle button -->

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link page-scroll" href="#services">Statistik</a>
				</li>
				<li class="nav-item">
					<a class="nav-link page-scroll" href="#pricing">Radius</a>
				</li>

				<!-- Dropdown Menu -->
				<!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle page-scroll" href="#about" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo base_url('assets/halaman_publik/web/terms-conditions.html') ?>"><span class="item-text">Terms Conditions</span></a>
                        <div class="dropdown-items-divide-hr"></div>
                        <a class="dropdown-item" href="<?php echo base_url('assets/halaman_publik/web/privacy-policy.html') ?> "><span class="item-text">Privacy Policy</span></a>
                    </div>
                </li>-->
				<!-- end of dropdown menu -->

				<li class="nav-item">
					<a class="nav-link page-scroll" href="#contact">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link page-scroll" href="login">LOGIN</a>
				</li>
			</ul>
			<span class="nav-item social-icons">
				<span class="fa-stack">
					<a href="#your-link">
						<i class="fas fa-circle fa-stack-2x facebook"></i>
						<i class="fab fa-facebook-f fa-stack-1x"></i>
					</a>
				</span>
				<span class="fa-stack">
					<a href="#your-link">
						<i class="fas fa-circle fa-stack-2x twitter"></i>
						<i class="fab fa-twitter fa-stack-1x"></i>
					</a>
				</span>
			</span>
		</div>
	</nav> <!-- end of navbar -->
	<!-- end of navigation -->


	<!-- Header -->
	<header id="header" class="header">
		<div class="header-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="text-container">
							<h1><span class="turquoise">Kontrol Delegasi & </span>&nbsp; e-Register Surat</h1>
							<p class="p-large">Aplikasi Bantu Kontrol Delegasi & Register Digital Persuratan Di Lingkungan Pengadilan Tinggi Agama DKI Jakarta</p>
							<a class="btn-solid-lg page-scroll" href="login">Login</a>

						</div> <!-- end of text-container -->
					</div> <!-- end of col -->
					<div class="col-lg-6">
						<div class="image-container">
							<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/header-teamwork.svg') ?>" alt="alternative">
						</div> <!-- end of image-container -->
					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of container -->
		</div> <!-- end of header-content -->
	</header> <!-- end of header -->
	<!-- end of header -->


	<!-- Customers -->
	<div class="slider-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h5>Digunakan Oleh</h5>
					<?php $logo  = ['403.jpg', '404.jpg', '405.jpg', '406.jpg', '407.jpg'] ?>
					<!-- Image Slider -->
					<div class="slider-container">
						<div class="swiper-container image-slider">
							<div class="swiper-wrapper">
								<?php foreach ($logo as $d) { ?>
									<div class="swiper-slide">
										<div class="image-container">
											<img class="img-responsive" src="<?php echo base_url('assets/logo/') . $d ?>" width="100" height="120" alt="alternative">
										</div>
									</div>
								<?php } ?>

							</div> <!-- end of swiper-wrapper -->
						</div> <!-- end of swiper container -->
					</div> <!-- end of slider-container -->
					<!-- end of image slider -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of slider-1 -->
	<!-- end of customers -->


	<!-- Services -->
	<div id="services" class="cards-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>Pencatatan Secara Otomatis </h2>
					<p class="p-heading p-large">Hitungan Jumlah Surat Umum Dan Delegasi Tercatat Secara Otomatis Dan Realtime Pada Register Digital Surat Umum dan Delegasi</p>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-lg-12">

					<!-- Card -->
					<div class="card">
						<img class="card-image" src="<?php echo base_url('assets/halaman_publik/web/images/services-icon-2.svg" alt="alternative') ?>">
						<div class="card-body">
							<h4 class="card-title"><?= $total_delegasi_keluar['total_del_keluar'] ?></h4>
							<p>Hingga Saat Ini, Tercatat Sebanyak <?= $total_delegasi_keluar['total_del_keluar'] ?> Bantuan Delegasi Dari <?= ucwords(strtolower($identity['NamaPN']))  ?> ke Pengadilan Agama Lain</p>
						</div>
					</div>
					<!-- end of card -->

					<!-- Card -->
					<div class="card">
						<img class="card-image" src="<?php echo base_url('assets/halaman_publik/web/images/services-icon-3.svg" alt="alternative') ?>">
						<div class="card-body">
							<h4 class="card-title"><?= $total_delegasi_masuk['total_del_masuk'] ?></h4>
							<p>Hingga Saat Ini, Tercatat Sebanyak <?= $total_delegasi_masuk['total_del_masuk'] ?> Bantuan Delegasi Ke <?= ucwords(strtolower($identity['NamaPN']))  ?> Dari Pengadilan Agama Lain</p>
						</div>
					</div>
					<!-- end of card -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of cards-1 -->
	<!-- end of services -->


	<!-- Details 1 -->

	<!-- end of details 1 -->


	<!-- Details 2 -->
	<!-- end of basic-2 -->
	<!-- end of details 2 -->

	<!-- Details Lightboxes -->
	<!-- Details Lightbox 1 -->
	<div id="details-lightbox-1" class="lightbox-basic zoom-anim-dialog mfp-hide">
		<div class="container">
			<div class="row">
				<button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
				<div class="col-lg-8">
					<div class="image-container">
						<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/details-lightbox-1.svg') ?>" alt="alternative">
					</div> <!-- end of image-container -->
				</div> <!-- end of col -->
				<div class="col-lg-4">
					<h3>Design And Plan</h3>
					<hr>
					<h5>Core feature</h5>
					<p>The emailing module basically will speed up your email marketing operations while offering more subscriber control.</p>
					<p>Do you need to build lists for your email campaigns? It just got easier with Evolo.</p>
					<ul class="list-unstyled li-space-lg">
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">List building framework</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Easy database browsing</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">User administration</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Automate user signup</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Quick formatting tools</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Fast email checking</div>
						</li>
					</ul>
					<a class="btn-solid-reg mfp-close page-scroll" href="#request">REQUEST</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of lightbox-basic -->
	<!-- end of details lightbox 1 -->

	<!-- Details Lightbox 2 -->
	<div id="details-lightbox-2" class="lightbox-basic zoom-anim-dialog mfp-hide">
		<div class="container">
			<div class="row">
				<button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
				<div class="col-lg-8">
					<div class="image-container">
						<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/details-lightbox-2.svg') ?>" alt="alternative">
					</div> <!-- end of image-container -->
				</div> <!-- end of col -->
				<div class="col-lg-4">
					<h3>Search To Optimize</h3>
					<hr>
					<h5>Core feature</h5>
					<p>The emailing module basically will speed up your email marketing operations while offering more subscriber control.</p>
					<p>Do you need to build lists for your email campaigns? It just got easier with Evolo.</p>
					<ul class="list-unstyled li-space-lg">
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">List building framework</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Easy database browsing</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">User administration</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Automate user signup</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Quick formatting tools</div>
						</li>
						<li class="media">
							<i class="fas fa-check"></i>
							<div class="media-body">Fast email checking</div>
						</li>
					</ul>
					<a class="btn-solid-reg mfp-close page-scroll" href="#request">REQUEST</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of lightbox-basic -->
	<!-- end of details lightbox 2 -->
	<!-- end of details lightboxes -->


	<!-- Pricing -->
	<div id="pricing" class="cards-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>List Radius <?= ucwords(strtolower($identity['NamaPN']))  ?></h2>
					<p class="p-heading p-large">Berkenaan Dengan Biaya Panggilan Di <?= ucwords(strtolower($identity['NamaPN']))  ?>, Berikut Adalah Tabel Radius Secara Lengkap </p>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-lg-12">



					<div class="table-responsive table table-hover">
						<table class="table table-bordered" id="table-radius">
							<thead class="thead-dark">
								<tr>
									<th>Kelurahan</th>
									<th>Kecamatan</th>
									<th>Kab/Kota</th>
									<th>Provinsi</th>
									<th>Biaya</th>
								</tr>
							</thead>
							<tbody id="patch-radius">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="pricing" class="cards-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

					<!-- Card-->
					<div class="card">
						<div class="card-body">
							<div class="card-title">Radius 1</div>
							<hr class="cell-divide-hr">
							<div class="price">
								<span class="currency"></span><span class="value">125.000</span>
								<div class="frequency">Biaya Panggilan</div>
							</div>
							<hr class="cell-divide-hr">
							<ul class="list-unstyled li-space-lg">
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamatan Cilincing </div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamatan Kelapa Gading</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamatan Koja</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamatan Pademangan</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamatan Tanjung Priok</div>
								</li>
							</ul>

							<div class="button-wrapper">
								<a class="btn-solid-reg page-scroll" href="#request">REQUEST</a>
							</div>
						</div>
					</div> <!-- end of card -->
					<!-- end of card -->

					<!-- Card-->
					<div class="card">
						<div class="card-body">
							<div class="card-title">Radius 2</div>

							<hr class="cell-divide-hr">
							<div class="price">
								<span class="currency"></span><span class="value">175.000</span>
								<div class="frequency">Biaya Panggilan</div>
							</div>
							<hr class="cell-divide-hr">
							<ul class="list-unstyled li-space-lg">
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Kecamata Penjaringan</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Seluruh Kelurahan Di Kecamatan Penjaringan Termasuk Radius 2 Dan Untuk Biaya Panggilannya Adalah Sejumlah Rp.175.000</div>
								</li>
							</ul>
							<div class="button-wrapper">
								<a class="btn-solid-reg page-scroll" href="#request">REQUEST</a>
							</div>
						</div>
					</div> <!-- end of card -->
					<!-- end of card -->

					<!-- Card-->
					<div class="card">
						<div class="label">
							<p class="best-value">Kepulauan</p>
						</div>
						<div class="card-body">
							<div class="card-title">Radius 3</div>
							<hr class="cell-divide-hr">
							<div class="price">
								<span class="currency"></span><span class="value">700.000</span>
								<div class="frequency">Kecuali Pulau Sebira Rp.900.000</div>
							</div>
							<hr class="cell-divide-hr">
							<ul class="list-unstyled li-space-lg">
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Pulau Bidadari/Anyer/Untung</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Pulau Tidung/Pramuka/Karya</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Pulau Pari/Panggang/Kotok</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Pulau Putri/Pelangi/Sepa</div>
								</li>
								<li class="media">
									<i class="fas fa-check"></i>
									<div class="media-body">Pulau Kelapa/Harapan</div>
								</li>
							</ul>
							<div class="button-wrapper">
								<a class="btn-solid-reg page-scroll" href="#request">REQUEST</a>
							</div>
						</div>
					</div> <!-- end of card -->
					<!-- end of card -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of cards-2 -->
	<!-- end of pricing -->


	<!-- Request -->
	<!-- end of form-1 -->
	<!-- end of request -->


	<!-- Video -->
	<div class="basic-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>Check Out The Video Profil</h2>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-lg-12">
					<!-- Video Preview -->
					<div class="image-container">
						<div class="video-wrapper">
							<a class="popup-youtube" href="https://www.youtube.com/watch?v=YFUMRMZ8HC8&t=71s" data-effect="fadeIn">
								<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/video-frame.svg') ?>" alt="alternative">
								<span class="video-play-button">
									<span></span>
								</span>
							</a>
						</div> <!-- end of video-wrapper -->
					</div> <!-- end of image-container -->
					<!-- end of video preview -->

					<p>Vidio Profil <?= ucwords(strtolower($identity['NamaPN']))  ?></p>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of basic-3 -->
	<!-- end of video -->


	<!-- Testimonials -->

	<!-- end of testimonials -->


	<!-- About -->
	<div id="about" class="basic-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>About The Team</h2>
					<p class="p-heading p-large">Team Delegasi <?= ucwords(strtolower($identity['NamaPN']))  ?> </p>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-lg-12">

					<!-- Team Member -->
					<div class="team-member">
						<div class="image-wrapper">
							<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/team-member-2.svg') ?>" alt="alternative">
						</div> <!-- end of image-wrapper -->
						<p class="p-large"><strong>Abdul Haris Hermansyah, S.E</strong></p>
						<p class="job-title">Kordinator Delegasi Keluar <?= ucwords(strtolower($identity['NamaPN']))  ?> Ke PA Lain</p>
						<span class="social-icons">
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x facebook"></i>
									<i class="fab fa-facebook-f fa-stack-1x"></i>
								</a>
							</span>
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x twitter"></i>
									<i class="fab fa-twitter fa-stack-1x"></i>
								</a>
							</span>
						</span> <!-- end of social-icons -->
					</div> <!-- end of team-member -->
					<!-- end of team member -->

					<!-- Team Member -->
					<div class="team-member">
						<div class="image-wrapper">
							<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/team-member-2.svg') ?>" alt="alternative">
						</div> <!-- end of image wrapper -->
						<p class="p-large"><strong>Abdul Salam, A.Md</strong></p>
						<p class="job-title">Delegasi Keluar <?= ucwords(strtolower($identity['NamaPN']))  ?> Ke PA Lain</p>
						<span class="social-icons">
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x facebook"></i>
									<i class="fab fa-facebook-f fa-stack-1x"></i>
								</a>
							</span>
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x twitter"></i>
									<i class="fab fa-twitter fa-stack-1x"></i>
								</a>
							</span>
						</span> <!-- end of social-icons -->
					</div> <!-- end of team-member -->
					<div class="team-member">
						<div class="image-wrapper">
							<img class="img-fluid" src="<?php echo base_url('assets/halaman_publik/web/images/team-member-2.svg') ?>" alt="alternative">
						</div> <!-- end of image wrapper -->
						<p class="p-large"><strong>Beriawan Febriz, S.H</strong></p>
						<p class="job-title">Kordinator Delegasi Masuk <?= ucwords(strtolower($identity['NamaPN']))  ?> Ke PA Lain</p>
						<span class="social-icons">
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x facebook"></i>
									<i class="fab fa-facebook-f fa-stack-1x"></i>
								</a>
							</span>
							<span class="fa-stack">
								<a href="#your-link">
									<i class="fas fa-circle fa-stack-2x twitter"></i>
									<i class="fab fa-twitter fa-stack-1x"></i>
								</a>
							</span>
						</span> <!-- end of social-icons -->
					</div> <!-- end of team-member -->
					<!-- end of team member -->

					<!-- Team Member -->

					<!-- end of team member -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of basic-4 -->
	<!-- end of about -->


	<!-- Contact -->
	<div id="contact" class="form-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>Contact Information</h2>
					<ul class="list-unstyled li-space-lg">
						<li class="address">Pengelola Surat Dan Delegasi <?= ucwords(strtolower($identity['NamaPN']))  ?></li>
						<li><i class="fas fa-map-marker-alt"></i>Jl. Raya Plumpang Semper No.5, RT.007 RW.002, Kelurahan Tugu Selatan, Kecamatan Koja, Jarta Utara, Daerah Khusus Ibukota Jakarta 14260</li>
						<li><i class="fas fa-phone"></i><a class="turquoise" href="tel:003024630820">021 - 43934701</a></li>
						<li><i class="fas fa-envelope"></i><a class="turquoise" href="mailto:office@evolo.com">tabayun.paju@gmail.co</a></li>
					</ul>
				</div> <!-- end of col -->
			</div> <!-- end of row -->
			<div class="row">
				<div class="col-lg-6">
					<div class="map-responsive">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31735.32808945744!2d106.92068488932198!3d-6.1419838471138615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1ffe9359ed3d%3A0x34cd66db920dd513!2sPengadilan%20Agama%20Jakarta%20Utara!5e0!3m2!1sid!2sid!4v1606209006945!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">allowfullscreen></iframe>
					</div>
				</div> <!-- end of col -->
				<div class="col-lg-6">

					<!-- Contact Form -->
					<form id="contactForm" data-toggle="validator" data-focus="false">
						<div class="form-group">
							<input type="text" class="form-control-input" id="cname" required>
							<label class="label-control" for="cname">Name</label>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control-input" id="cemail" required>
							<label class="label-control" for="cemail">Email</label>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<textarea class="form-control-textarea" id="cmessage" required></textarea>
							<label class="label-control" for="cmessage">Your message</label>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<button type="submit" class="form-control-submit-button">KIRIM PESAN</button>
						</div>
						<div class="form-message">
							<div id="cmsgSubmit" class="h3 text-center hidden"></div>
						</div>
					</form>
					<!-- end of contact form -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of form-2 -->
	<!-- end of contact -->


	<!-- Footer -->

	<!-- end of footer -->


	<!-- Copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="p-small">Copyright © 2020 <a href="http://pa-jakartautara.go.id">paju</a> - All rights reserved</p>
				</div> <!-- end of col -->
			</div> <!-- enf of row -->
		</div> <!-- end of container -->
	</div> <!-- end of copyright -->
	<!-- end of copyright -->


	<!-- Scripts -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/jquery.min.js') ?>"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->

	<script src="<?php echo base_url('assets/halaman_publik/web/js/popper.min.js') ?>"></script> <!-- Popper tooltip library for Bootstrap -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/bootstrap.min.js') ?>"></script> <!-- Bootstrap framework -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/jquery.easing.min.js') ?>"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/swiper.min.js') ?>"></script> <!-- Swiper for image and text sliders -->
	<script src="<?= base_url('assets/backend/') ?>js/plugins/jquery.datatables.min.js"></script>
	<script src="<?= base_url('assets/backend/') ?>js/plugins/datatables.bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/halaman_publik/web/js/jquery.magnific-popup.js') ?>"></script> <!-- Magnific Popup for lightboxes -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/validator.min.js') ?>"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
	<script src="<?php echo base_url('assets/halaman_publik/web/js/scripts.js') ?>"></script> <!-- Custom scripts -->


	<script>
		$(document).ready(async function() {
			$('#tabel-mimiti').DataTable()
			const connect = await fetch("http://komdanas.mahkamahagung.go.id/jsons/radius04.json").then(
				response => response.json()
			)
			let nodetr = '';
			connect.filter(async (element) => {
				if (element.satker_code == "<?= $identity['kode_satker'] ?>") {
					console.log(element)
					nodetr += `<tr>
											<td>${element.kel}</td>
											<td>${element.kec}</td>
											<td>${element.kabkota}</td>
											<td>${element.prop_name}</td>
											<td>${element.nilai}</td>
										</tr>`;
				}
			})
			$('#patch-radius').html(nodetr)
		});
	</script>


</body>

</html>