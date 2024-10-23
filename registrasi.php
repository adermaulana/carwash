<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

    if (isset($_POST['registrasi'])) {
      $password = md5($_POST['password']);
      $username = $_POST['username'];

      // Check if the username already exists
      $checkUsername = mysqli_query($koneksi, "SELECT * FROM customer_221061 WHERE username_221061='$username'");
      if (mysqli_num_rows($checkUsername) > 0) {
          echo "<script>
                  alert('Username sudah digunakan, pilih Username lain.');
                  document.location='registrasi.php';
              </script>";
          exit; // Stop further execution
      }

      // If the username is not taken, proceed with the registration
      $simpan = mysqli_query($koneksi, "INSERT INTO customer_221061 (nama_221061, alamat_221061, username_221061,no_hp_221061, password_221061) VALUES ('$_POST[nama]','$_POST[alamat]','$_POST[username]','$_POST[telepon]','$password')");

      if ($simpan) {
          echo "<script>
                  alert('Berhasil Registrasi!');
                  document.location='index.php';
              </script>";
      } else {
          echo "<script>
                  alert('Gagal!');
                  document.location='registrasi.php';
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
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div  class="brand-logo text-center">
                  <img src="assets/images/carwash.png">
                </div>
                <h3 style="margin-top:-40px;" class="text-center">Registrasi</h3>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="text" name="nama" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="text" name="telepon" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Telepon">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control form-control-lg" name="alamat" placeholder="Alamat" name="" id="" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" name="registrasi" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">REGISTRASI</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Sudah punya akun? <a href="login.php" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
  </body>
</html>