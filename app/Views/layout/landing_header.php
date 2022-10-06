<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>STORI | <?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>/logo/stori.ico" rel="icon">
  <link href="<?= base_url(); ?>/logo/stori.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- vendors CSS Files -->
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/ninestar_theme/assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>/ninestar_theme/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Ninestars - v4.7.0
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-image:url(<?= base_url(); ?>/theme/dist/assets/media/bg/bg-3.jpg);background-position:right bottom;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
	      <a class="navbar-brand" href="<?= base_url(); ?>"> <img class="me-3 d-inline-block" style="max-height: 40px; max-width: 100px;" src="<?= base_url(); ?>/logo/stori-2.jpg" alt="" /></a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="<?= base_url(); ?>">Beranda</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
          <li class="dropdown"><a><span>Tentang Kami</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!-- <li><a href="#">Galeri</a></li> -->
              <!-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> -->
              <li><a href="<?= base_url('about-us'); ?>">Tentang STORI</a></li>
              <li><a href="<?= base_url('visi-misi'); ?>">Visi Misi</a></li>
              <!-- <li><a href="#">Drop Down 4</a></li> -->
            </ul>
          </li>
          <!-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
          <li><a class="getstarted scrollto" href="<?= base_url('register'); ?>">Gabung Sekarang</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->