<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if (isset($_POST['simpan'])) {
  // Ambil data dari form
  $id_customer = $_POST['id_customer_221061'];
  $id_jenis_cucian = $_POST['id_jenis_cucian_221061'];
  $rating = $_POST['rating'];
  $deskripsi = $_POST['deskripsi'];

  // Cek apakah rating sudah ada
  $cek = mysqli_query($koneksi, "SELECT * FROM rating_221061 WHERE id_customer_221061 = '$id_customer' AND id_jenis_cucian_221061 = '$id_jenis_cucian'");
  
  if (mysqli_num_rows($cek) > 0) {
      // Jika sudah ada, lakukan update
      $update = mysqli_query($koneksi, "UPDATE rating_221061 SET rating_221061 = '$rating', deskripsi_221061 = '$deskripsi' WHERE id_customer_221061 = '$id_customer' AND id_jenis_cucian_221061 = '$id_jenis_cucian'");
      
      if ($update) {
          echo "<script>
                  alert('Update data sukses!');
                  document.location='rating.php';
              </script>";
      } else {
          echo "<script>
                  alert('Update data Gagal!');
                  document.location='rating.php';
              </script>";
      }
  } else {
      // Jika belum ada, lakukan insert
      $simpan = mysqli_query($koneksi, "INSERT INTO rating_221061 (id_customer_221061, id_jenis_cucian_221061, rating_221061, deskripsi_221061) VALUES ('$id_customer', '$id_jenis_cucian', '$rating', '$deskripsi')");
      
      if ($simpan) {
          echo "<script>
                  alert('Simpan data sukses!');
                  document.location='rating.php';
              </script>";
      } else {
          echo "<script>
                  alert('Simpan data Gagal!');
                  document.location='rating.php';
              </script>";
      }
  }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    
    <style>
      .rating {
          direction: rtl;
          display: flex;
          justify-content: center;
      }

      .rating input {
          display: none; /* Sembunyikan input radio */
      }

      .rating label {
          font-size: 40px;
          color: lightgray;
          cursor: pointer;
      }

      .rating input:checked ~ label {
          color: gold; /* Warna bintang saat dipilih */
      }

      .rating label:hover,
      .rating label:hover ~ label {
          color: gold; /* Warna bintang saat hover */
      }
    </style>

  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white mr-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="index.php"><img src="" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="../assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?= $_SESSION['nama_pelanggan'] ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="logout.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?= $_SESSION['nama_pelanggan'] ?></span>
                  <span class="text-secondary text-small"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../booking.php">
                <span class="menu-title">Pesan Layanan</span>
                <i class="mdi mdi-account-group menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Booking</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="booking.php">Lihat Booking</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Pembayaran</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pembayaran.php">Pembayaran</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Rating</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="rating.php">Lihat Rating</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="tambahrating.php">Tambah Rating</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Tambah Rating</h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" method="POST">
                      <input type="hidden" name="id_customer_221061" value="<?= $_SESSION['id_pelanggan'] ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Layanan</label>
                        <select name="id_jenis_cucian_221061" id="layanan" class="form-select" required>
                          <option  disabled selected>Pilih Layanan</option>
                          <?php
                                $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_cucian_221061");
                                while($data = mysqli_fetch_array($tampil)):
                            ?>
                          <option value="<?= $data['id_jenis_cucian_221061'] ?>" data-harga="<?= $data['biaya_221061'] ?>"><?= $data['jenis_cucian_221061'] ?></option>
                          <?php
                            endwhile; 
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Rating</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" class="star">★</label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" class="star">★</label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" class="star">★</label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" class="star">★</label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" class="star">★</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi</label>
                        <textarea class="form-control" id="exampleTextarea1" name="deskripsi" rows="4"></textarea>
                      </div>
                      <button type="submit" name="simpan" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>