<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}

if (isset($_POST['simpan'])) {
  // Query untuk menyimpan data ke tabel pendaftaran_221061
  $simpan = mysqli_query($koneksi, "INSERT INTO pendaftaran_221061 (id_customer_221061, id_jenis_cucian_221061, tgl_pendaftaran_221061, total_biaya_221061, status_221061) VALUES ('{$_POST['id_customer_221061']}', '{$_POST['id_jenis_cucian_221061']}', '{$_POST['tgl_pendaftaran_221061']}', '{$_POST['total_biaya_221061']}', '{$_POST['status_221061']}')");

  if ($simpan) {
      // Ambil ID pendaftaran yang baru saja dimasukkan
      $id_pendaftaran = mysqli_insert_id($koneksi);

      // Generate nilai untuk no_nota_221061
      $no_nota = "NOTA-" . date("Ymd") . "-" . $id_pendaftaran; // Contoh format: NOTA-20241027-1

      // Data untuk tabel transaksi
      $tanggal_transaksi = date("Y-m-d"); // atau gunakan tanggal yang sesuai kebutuhan
      $status_transaksi = "Pending"; // contoh status awal
      $bukti_pembayaran = ""; // kosongkan jika belum ada bukti
      $id_admin = $_SESSION['id_admin']; // ganti dengan ID admin yang sesuai atau sesuai kebutuhan

      // Query untuk memasukkan data ke tabel transaksi_221061
      $transaksi = mysqli_query($koneksi, "INSERT INTO transaksi_221061 (id_pendaftaran_221061, no_nota_221061, tanggal_221061, status_221061, bukti_pembayaran_221061, id_user_221061) VALUES ('$id_pendaftaran', '$no_nota', '$tanggal_transaksi', '$status_transaksi', '$bukti_pembayaran', '$id_admin')");

      if ($transaksi) {
          echo "<script>
                  alert('Simpan data sukses!');
                  document.location='booking.php';
                </script>";
      } else {
          echo "<script>
                  alert('Simpan data gagal di tabel transaksi!');
                  document.location='booking.php';
                </script>";
      }
  } else {
      echo "<script>
              alert('Simpan data gagal di tabel pendaftaran!');
              document.location='booking.php';
            </script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
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
                  <p class="mb-1 text-black"><?= $_SESSION['nama_admin'] ?></p>
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
                  <span class="font-weight-bold mb-2"><?= $_SESSION['nama_admin'] ?></span>
                  <span class="text-secondary text-small"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
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
                  <li class="nav-item">
                    <a class="nav-link" href="tambahbooking.php">Tambah Booking</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Layanan</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="layanan.php">Lihat Layanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="tambahlayanan.php">Tambah Layanan</a>
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
                  <a class="nav-link" href="rating.php">Rating</a>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Tambah Booking</h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pelanggan</label>
                        <select name="id_customer_221061"  class="js-example-basic-single" style="width:100%" required>
                        <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM customer_221061");
                                while($data = mysqli_fetch_array($tampil)):
                            ?>
                          <option value="<?= $data['id_customer_221061'] ?>"><?= $data['nama_221061'] ?></option>
                          <?php
                            endwhile; 
                        ?>
                        </select>
                      </div>
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
                        <label for="exampleInputUsername1">Tanggal Booking</label>
                        <input type="date" class="form-control" name="tgl_pendaftaran_221061" id="tgl_pendaftaran_221061" placeholder="Tanggal Booking" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Biaya</label>
                        <input type="hidden" name="total_biaya_221061">
                        <input type="text" class="form-control" name="displayBiaya" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="status_221061" class="form-select" required>
                          <option disabled selected>Pilih</option>
                          <option value="Pending">Pending</option>
                          <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
                          <option value="Selesai">Selesai</option>
                        </select>
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
    <script src="../assets/vendors/select2/select2.min.js"></script>
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
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
    <script src="../assets/js/select2.js"></script>
    <script src="../assets/js/typeahead.js"></script>
    <!-- End custom js for this page -->

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
    $('[name=displayBiaya]').val(`Rp ${formatRupiah(harga)}`);
    $('[name=total_biaya_221061]').val(`${harga}`);

  

    });

    </script>


  </body>
</html>