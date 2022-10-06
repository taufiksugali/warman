<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>STORI | Landing Page</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/logo/stori.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/logo/stori.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/logo/stori.ico">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/logo/stori.ico">
    <link rel="manifest" href="<?= base_url(); ?>/landing_theme/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url(); ?>/landing_theme/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?= base_url(); ?>/landing_theme/assets/css/theme.css" rel="stylesheet" />

  </head>


  <body style="background-image:url(<?= base_url(); ?>/theme/dist/assets/media/bg/bg-3.jpg);background-position:right bottom;">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top" >
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block navbar-klean" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="index.html"> <img class="me-3 d-inline-block" style="max-height: 40px; max-width: 100px;" src="<?= base_url(); ?>/logo/stori-2.jpg" alt="" /></a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto pt-2 pt-lg-0 font-base">
              <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link fw-medium active" aria-current="page" href="<?= base_url(); ?>">Tentang Kami</a></li>
              <!-- <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#service">Service</a></li>
              <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#feature">Features</a></li>
              <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#testimonial">Testimonial</a></li>
              <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#contact">Contact</a></li> -->
            </ul>
            <form class="ps-lg-5">
              <!-- <a href="<?= base_url('login'); ?>" class="btn btn-link text-primary fw-bold order-1 order-lg-0">Sign in</a> -->
              <a href="<?= base_url('register'); ?>" class="btn btn-light shadow-klean order-0" ><span class="text-gradient fw-bold">Join Now</span></a>
            </form>
          </div>
        </div>
      </nav>
      <section id="home">
        <!-- <div class="bg-holder" style="background-image:url(<?= base_url(); ?>/theme/dist/assets/media/bg/bg-3.jpg);background-position:right bottom;">
        </div> -->
        <!--/.bg-holder-->

        <div class="bg-holder" style="background-image:url(<?= base_url(); ?>/theme/dist/assets/media/bg/ikon_web_stori-01.png);background-position:right;background-size:contain;margin-top:50px">
        </div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7 col-lg-6 py-6 text-sm-start text-center">
              <h1 class="fw-bold display-4 fs-4 fs-lg-6 fs-xxl-7 text-gradient">STORI</h1>
              <h1 class="text-700">Create your <span class="fw-bold">owntrepreneur journey</span></h1>
              <p class="mb-5 fs-0"></p>
              <a class="btn hover-top btn-glow btn-klean" href="<?= base_url('login'); ?>">Akses dashboard seller</a>&nbsp;&nbsp;
              <a href = "https://play.google.com/store/apps/details?id=com.stori.storienterprise"> 
                <img src="<?= base_url(); ?>/logo/google-play-logo.png" alt="Tutorials Point" style="max-height:50px"/> 
              </a>
            </div>
          </div>
        </div>
        <!-- <div class="bg-holder" style="background-image:url(<?= base_url(); ?>/logo/google-play-logo.png);background-position:left bottom;background-size:contain;max-height:50px">
        </div> -->
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <!-- <section class="pb-lg-0 pt-md-8 py-0">

        <div class="container">
          <div class="row align-items-center justify-content-xl-between py-5 border-klean">
            <div class="col-auto col-md-4 col-lg-auto my-3 text-xl-start"><img src="<?= base_url(); ?>/landing_theme/assets/img/gallery/google.png" height="40" alt="brands" /></div>
            <div class="col-auto col-md-4 col-lg-auto my-3 text-xl-start"><img src="<?= base_url(); ?>/landing_theme/assets/img/gallery/netflix.png" height="40" alt="brands" /></div>
            <div class="col-auto col-md-4 col-lg-auto my-3 text-xl-start"><img src="<?= base_url(); ?>/landing_theme/assets/img/gallery/microsoft.png" height="40" alt="brands" /></div>
            <div class="col-auto col-md-4 col-lg-auto my-3 text-xl-start"><img src="<?= base_url(); ?>/landing_theme/assets/img/gallery/theme-wagon.png" height="40" alt="brands" /></div>
            <div class="col-auto col-md-4 col-lg-auto my-3 text-xl-start"><img src="<?= base_url(); ?>/landing_theme/assets/img/gallery/mailbluster.png" height="40" alt="brands" /></div>
          </div>
        </div> -->
        <!-- end of .container-->

        <!-- </section> -->
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?= base_url(); ?>/landing_theme/vendors/@popperjs/popper.min.js"></script>
    <script src="<?= base_url(); ?>/landing_theme/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/landing_theme/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url(); ?>/landing_theme/vendors/feather-icons/feather.min.js"></script>
    <script>
      feather.replace();
    </script>
    <script src="<?= base_url(); ?>/landing_theme/assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
  </body>

</html>