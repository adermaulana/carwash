<?php

    include 'koneksi.php';

    session_start();

    if(isset($_SESSION['status']) == 'login'){

        header("location:admin");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        $login = mysqli_query($koneksi, "SELECT * FROM `user_221061`
                                    WHERE `username_221061` = '$username'
                                    AND `password_221061` = '$password'
                                    AND `status_221061` = 1");
        $cek = mysqli_num_rows($login);

        $loginPelanggan = mysqli_query($koneksi, "SELECT * FROM `customer_221061`
                                    WHERE `username_221061` = '$username'
                                    AND `password_221061` = '$password'");
        $cekPelanggan = mysqli_num_rows($loginPelanggan);
    
        if ($cek > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($login);
            // Simpan data ke dalam session
            $_SESSION['id_admin'] = $admin_data['id_user_221061']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_admin'] = $admin_data['name_221061']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:admin');
        } else if ($cekPelanggan > 0) {
          // Ambil data user
          $admin_data = mysqli_fetch_assoc($loginPelanggan);
          // Simpan data ke dalam session
          $_SESSION['id_pelanggan'] = $admin_data['id_customer_221061']; // Pastikan sesuai dengan nama kolom di database
          $_SESSION['nama_pelanggan'] = $admin_data['nama_221061']; // Pastikan sesuai dengan nama kolom di database
          $_SESSION['username_pelanggan'] = $username;
          $_SESSION['alamat_pelanggan'] = $admin_data['alamat_221061'];;
          $_SESSION['telepon_pelanggan'] = $admin_data['no_hp_221061'];;
          $_SESSION['status'] = "login";
          // Redirect ke halaman admin
          header('location:index.php');
      } else {
            echo "<script>
                alert('Login Gagal, Periksa Username dan Password Anda!');
                window.location.href = 'login.php';
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
                <h3 style="margin-top:-40px;" class="text-center">Login</h3>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">Belum punya akun? <a href="registrasi.php" class="text-primary">Registrasi</a>
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