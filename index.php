<?php

include 'koneksi.php';

session_start();


  if(isset($_SESSION['username_admin'])) {
    $isLoggedIn = true;
    $namaAdmin = $_SESSION['nama_admin']; // Ambil nama user dari session
  } else if(isset($_SESSION['username_pelanggan'])) {
    $isLoggedIn = true;
    $namaPelanggan = $_SESSION['nama_pelanggan']; // Ambil nama user dari session
  } 

  else {
      $isLoggedIn = false;
  }


?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Car wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/home/css/slicknav.css">
    <link rel="stylesheet" href="assets/home/css/flaticon.css">
    <link rel="stylesheet" href="assets/home/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/home/css/gijgo.css">
    <link rel="stylesheet" href="assets/home/css/animate.min.css">
    <link rel="stylesheet" href="assets/home/css/animated-headline.css">
    <link rel="stylesheet" href="assets/home/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/home/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/home/css/themify-icons.css">
    <link rel="stylesheet" href="assets/home/css/slick.css">
    <link rel="stylesheet" href="assets/home/css/nice-select.css">
    <link rel="stylesheet" href="assets/home/css/style.css">
</head>

<body class="full-wrapper">
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/home/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/home/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="index.php">Home</a></li>
                                                <li><a href="about.php">About</a></li>
                                                <li><a href="booking.php">Booking</a></li>
                                                <li><a href="contact.php">Contact</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Header-btn -->
                                    <div class="header-right-btn d-none d-lg-block ml-20">
                                    <?php if($isLoggedIn): ?>
                                        <?php if(isset($_SESSION['username_admin'])): ?>
                                            <a href="admin" class="btn header-btn">Dashboard</a>
                                        <?php else: ?>
                                            <a href="pelanggan" class="btn header-btn">Dashboard</a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="login.php" class="btn header-btn">Login</a>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!-- slider Area Start-->
        <div class="container-fluid">
            <div class="slider-area position-relative">
                <div class="slider-active dot-style">
                    <!-- Single Slider -->
                    <div class="single-slider hero-overly slider-height slider-bg1 d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-9 col-lg-11 col-md-11">
                                    <div class="hero__caption">
                                        <h1 data-animation="fadeInUp" data-delay=".2s">Cuci Mobil</h1>
                                        <div class="hero-details">
                                            <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                                <h2>& Detailing</h2>
                                                <h2>& Detailing </h2>
                                            </div>
                                            <P data-animation="fadeInUp" data-delay=".4s">Nikmati layanan cuci mobil dan detailing profesional kami. Dari kebersihan dasar hingga perawatan mendalam, kami hadir untuk menjaga kendaraan Anda tetap bersih dan terawat.</P>
                                            <!-- Hero-btn -->
                                            <div class="hero__btn">
                                                <a href="booking.php" class="btn mb-10"  data-animation="fadeInUp" data-delay=".8s">Booking Sekarang Juga</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <!-- Pricing Card Start -->
        <section class="pricing-card-area fix section-padding30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10">
                        <div class="section-tittle text-center mb-90">
                            <h2>Kami menawarkan layanan terbaik untuk pelanggan kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                                <img src="assets/home/img/icon/price1.svg" alt="">
                                <h4>Cuci Mobil</h4>
                                <p>Mulai dari</p>
                            </div>
                            <div class="card-mid">
                                <h4>Rp 50.000</h4>
                            </div>
                            <div class="card-bottom">
                                <ul>
                                    <li>Cuci Eksterior Lengkap</li>
                                    <li>Membersihkan Interior</li>
                                    <li>Pembersihan Karpet dan Jok</li>
                                    <li>Waxing dan Polishing</li>
                                    <li>Perawatan Roda dan Ban</li>
                                </ul>
                                <a href="booking.php" class="borders-btn">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                                <img src="assets/home/img/icon/price1.svg" alt="">
                                <h4>Detailing</h4>
                                <p>Mulai dari</p>
                            </div>
                            <div class="card-mid">
                                <h4>Rp 100.000</h4>
                            </div>
                            <div class="card-bottom">
                            <ul>
                                <li>Cuci Eksterior Lengkap</li>
                                <li>Membersihkan Interior</li>
                                <li>Pembersihan Karpet dan Jok</li>
                                <li>Waxing dan Polishing</li>
                                <li>Perawatan Roda dan Ban</li>
                            </ul>
                                <a href="booking.php" class="borders-btn">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                                <img src="assets/home/img/icon/price1.svg" alt="">
                                <h4>Cuci & Detailing</h4>
                                <p>Mulai dari</p>
                            </div>
                            <div class="card-mid">
                                <h4>Rp 200.000</h4>
                            </div>
                            <div class="card-bottom">
                            <ul>
                                <li>Cuci Eksterior Lengkap</li>
                                <li>Membersihkan Interior</li>
                                <li>Pembersihan Karpet dan Jok</li>
                                <li>Waxing dan Polishing</li>
                                <li>Perawatan Roda dan Ban</li>
                            </ul>
                                <a href="booking.php" class="borders-btn">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing Card End -->

    </main>
    <footer>
        <div class="footer-wrapper section-bg2"  data-background="assets/home/img/gallery/footer-bg.png">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-35">
                                        <a href="index.php"><img src="assets/home/img/logo/logo2_footer.png" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Kami memberikan layanan cuci mobil dan detailing terbaik, memastikan kualitas pelayanan yang memuaskan untuk pelanggan kami.</p>
                                        </div>
                                        <ul class="mb-40">
                                            <li class="number"><a href="#">(80) 783 367-3904</a></li>
                                            <li class="number2"><a href="#">contact@carwash.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Jam Operasional</h4>
                                    <ul>
                                        <li><a href="#">Senin-Jumat (9.00-19.00)</a></li>
                                        <li><a href="#">Sabtu (12.00-19.00)</a></li>
                                        <li><a href="#">Minggu <span>(Tutup)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Navigasi</h4>
                                    <ul>
                                        <li><a href="#">Beranda</a></li>
                                        <li><a href="#">Tentang</a></li>
                                        <li><a href="#">Layanan</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Kontak</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                 <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer End-->
      </div>
  </footer>
  <!-- Scroll Up -->
  <div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->

<script src="assets/home/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="assets/home/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets/home/js/popper.min.js"></script>
<script src="assets/home/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="assets/home/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="assets/home/js/owl.carousel.min.js"></script>
<script src="assets/home/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="assets/home/js/wow.min.js"></script>
<script src="assets/home/js/animated.headline.js"></script>
<script src="assets/home/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="assets/home/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="assets/home/js/jquery.nice-select.min.js"></script>
<script src="assets/home/js/jquery.sticky.js"></script>
<!-- Progress -->
<script src="assets/home/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="assets/home/js/jquery.counterup.min.js"></script>
<script src="assets/home/js/waypoints.min.js"></script>
<script src="assets/home/js/jquery.countdown.min.js"></script>
<script src="assets/home/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="assets/home/js/contact.js"></script>
<script src="assets/home/js/jquery.form.js"></script>
<script src="assets/home/js/jquery.validate.min.js"></script>
<script src="assets/home/js/mail-script.js"></script>
<script src="assets/home/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="assets/home/js/plugins.js"></script>
<script src="assets/home/js/main.js"></script>

</body>
</html>