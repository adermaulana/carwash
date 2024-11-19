<?php

include 'koneksi.php';

session_start();


  if(isset($_SESSION['username_admin'])) {
    $isLoggedIn = true;
    $namaAdmin = $_SESSION['nama_admin']; // Ambil nama user dari session
  } else if(isset($_SESSION['username_pelanggan'])) {
    $isLoggedIn = true;
    $namaPelanggan = $_SESSION['nama_pelanggan'];
    $teleponPelanggan = $_SESSION['telepon_pelanggan'];
    $alamatPelanggan = $_SESSION['alamat_pelanggan'];
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
    <title>Car Wash - Booking</title>
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

    <style>

        .card-top img {
        width: 100%;
        height: 300px; /* Ukuran tetap untuk semua gambar */
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
        }

    </style>

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
                                                <li><a href="layanan.php">Layanan</a></li>
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
        <!--? Hero Start -->
        <div class="container-fluid">
            <div class="slider-area2">
                <div class="slider-height2 hero-overly d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap hero-cap2">
                                    <h2>Layanan Kami</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--?  Contact Area start  -->
        <section class="pricing-card-area fix section-padding30">
            <div class="container">

                <div class="row">
                    <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_cucian_221061");

                        // Array berisi kalimat-kalimat random untuk card-bottom
                        $random_texts = [
                            [
                                "Cuci body mobil dengan sabun khusus.",
                                "Pembersihan kaca dan cermin.",
                                "Pembersihan velg dan ban.",
                                "Pengeringan dengan lap microfiber untuk menghindari goresan.",
                                "Pengilapan ringan pada body mobil."
                            ],
                            [
                                "Membersihkan bagian dalam mobil.",
                                "Pembersihan lantai dan jok mobil.",
                                "Penghilangan bau tidak sedap.",
                                "Desinfeksi dengan alat khusus.",
                                "Poles dashboard dan stir mobil."
                            ],
                            [
                                "Pembersihan eksterior dengan cairan khusus.",
                                "Perawatan kaca spion dan lampu.",
                                "Pembersihan sela-sela body.",
                                "Penghilangan noda yang membandel.",
                                "Pengeringan cepat dengan lap khusus."
                            ],
                        ];

                        while ($data = mysqli_fetch_array($tampil)):
                            // Pilih teks acak dari array $random_texts
                            $chosen_texts = $random_texts[array_rand($random_texts)];
                    ?>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10">
                        <div class="single-card text-center mb-30">
                            <div class="card-top">
                            <img src="admin/uploads/<?= $data['gambar_221061'] ?>" alt="" >
                                <h4><?= $data['jenis_cucian_221061'] ?></h4>
                            </div>
                            <div class="card-mid">
                                <h4>Rp <?= number_format($data['biaya_221061'], 0, ',', '.') ?></h4>
                            </div>
                            <div class="card-bottom">
                                <ul>
                                    <?php foreach ($chosen_texts as $text): ?>
                                        <li><?= $text ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="booking.php?layanan_id=<?= $data['id_jenis_cucian_221061'] ?>" class="borders-btn">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile; 
                    ?>
                </div>

            </div>
        </section>
        <!-- Contact Area End -->
        <!-- Map -->
        <div class="maps-area maps-area2">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <img src="assets/img/gallery/map.png" alt="" class="w-100">
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <img src="assets/img/gallery/map-left.png" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
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

<script>
    document.querySelector(".form-contact").addEventListener("submit", function(event) {
        // Mengambil elemen form
        const name = document.getElementById("name").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const address = document.getElementById("address").value.trim();
        const layanan = document.getElementById("layanan").value;
        const hargaDisplay = document.getElementById("harga").value.trim();

        // Validasi setiap input, jika kosong tampilkan alert dan batalkan submit
        if (name === "") {
            alert("Nama tidak boleh kosong.");
            event.preventDefault();
            return;
        }
        if (phone === "") {
            alert("Nomor telepon tidak boleh kosong.");
            event.preventDefault();
            return;
        }
        if (address === "") {
            alert("Alamat tidak boleh kosong.");
            event.preventDefault();
            return;
        }
        if (layanan === null || layanan === "Pilih Layanan") {
            alert("Silakan pilih jenis layanan.");
            event.preventDefault();
            return;
        }
        if (hargaDisplay === "") {
            alert("Harga tidak boleh kosong.");
            event.preventDefault();
            return;
        }
    });
</script>


<script>
    $(document).ready(function() {
        let isQuotaAvailable = true; // Variabel untuk melacak status kuota

        $('#layanan').change(function() {
            const selectedOption = $(this).find('option:selected');
            const availableQuota = selectedOption.data('kuota'); // Sesuaikan nama data sesuai dengan HTML

            // Mengupdate pesan kuota
            const quotaMessage = $('#quotaMessage');

            // Mengecek apakah kuota tersedia
            if (availableQuota > 0) {
                quotaMessage.text(`Kuota tersedia: ${availableQuota}`).css('color', 'green');
                isQuotaAvailable = true; // Set kuota tersedia
            } else {
                quotaMessage.text('Maaf, kuota tidak tersedia untuk jenis layanan ini.').css('color', 'red');
                isQuotaAvailable = false; // Set kuota tidak tersedia
            }
        });

        // Menangani event tombol kirim
        $('.button-contactForm').click(function(event) {
            if (!isQuotaAvailable) {
                event.preventDefault(); // Mencegah form submit
                alert('Kuota tidak tersedia. Silakan pilih layanan lain.');
            }
        });
    });
</script>

<script type="text/javascript">

    function formatRupiah(angka) {
      var number_string = angka.toString().replace(/[^,\d]/g, ''),
          split = number_string.split(','),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // Tambahkan titik jika angka lebih dari ribuan
      if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }

      return rupiah; // hasilnya tanpa simbol Rp
    }



    $('#layanan').on('change', function(){
    // ambil data dari elemen option yang dipilih
    const harga = $('#layanan option:selected').data('harga');

    // tampilkan data ke element
    $('[name=hargaDisplay]').val(`Rp ${formatRupiah(harga)}`);
    $('[name=total_biaya_221061]').val(`${harga}`);

  

    });

    </script>


</body>
</html>