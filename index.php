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
    
        if ($cek > 0) {
            // Ambil data user
            $admin_data = mysqli_fetch_assoc($login);
            // Simpan data ke dalam session
            $_SESSION['id_admin'] = $admin_data['id_221061']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['nama_admin'] = $admin_data['name_221061']; // Pastikan sesuai dengan nama kolom di database
            $_SESSION['username_admin'] = $username;
            $_SESSION['status'] = "login";
            // Redirect ke halaman admin
            header('location:admin');
        } else {
            echo "<script>
                alert('Login Gagal, Periksa Username dan Password Anda!');
                window.location.href = 'index.php';
                 </script>";
        }
    }
    

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="assets/login/css/style.css">

    <title>Login #4</title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('assets/login/images/bg_1.jpg');"></div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
              <h3>Login to <strong>Colorlib</strong></h3>
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form  method="post">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" placeholder="username" name="username" id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" placeholder="Your Password" name="password" id="password">
                </div>


                <input type="submit" name="login" value="Log In" class="btn btn-block btn-primary">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="assets/login/js/jquery-3.3.1.min.js"></script>
    <script src="assets/login/js/popper.min.js"></script>
    <script src="assets/login/js/bootstrap.min.js"></script>
    <script src="assets/login/js/main.js"></script>
  </body>
</html>