<?php

include 'koneksi.php';

session_start();

if (isset($_SESSION['status']) == 'login') {
    header('location:admin');
}

if (isset($_POST['registrasi'])) {
    $username = $_POST['username'];
    if (strlen($username) < 6) {
        echo "<script>
                alert('Username minimal 6 karakter.');
                document.location='registrasi.php';
            </script>";
        exit();
    }

    $telepon = $_POST['telepon'];
    if (!preg_match('/^(^\+62|62|0)(\d{9,13})$/', $telepon)) {
        echo "<script>
                alert('Nomor telepon tidak valid. (dimulai 08) 10 - 12 Karakter.');
                document.location='registrasi.php';
            </script>";
        exit();
    }

    // Validate password strength
    $password = md5($_POST['password']);
    if (strlen($password) < 8) {
        echo "<script>
                alert('Password minimal 8 karakter.');
                document.location='registrasi.php';
            </script>";
        exit();
    }

    // Check if the username already exists
    $checkUsername = mysqli_query($koneksi, "SELECT * FROM customer_221061 WHERE username_221061='$username'");
    if (mysqli_num_rows($checkUsername) > 0) {
        echo "<script>
                  alert('Username sudah digunakan, pilih Username lain.');
                  document.location='registrasi.php';
              </script>";
        exit(); // Stop further execution
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


    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>


</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <img src="assets/images/carwash.png">
                            </div>
                            <h3 style="margin-top:-40px;" class="text-center">Registrasi</h3>
                            <form class="pt-3" method="POST">
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control form-control-lg"
                                        id="nama" placeholder="Nama" required>
                                    <div id="namaError" class="error-message">Nama harus diisi</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg"
                                        id="username" placeholder="Username" required>
                                    <div id="usernameError" class="error-message">Email tidak valid</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="telepon" class="form-control form-control-lg"
                                        id="telepon" placeholder="Telepon" required>
                                    <div id="teleponError" class="error-message">Nomor telepon tidak valid</div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg" name="alamat" id="alamat" placeholder="Alamat" name="" id=""
                                        rows="4" required></textarea>
                                    <div id="alamatError" class="error-message">Alamat harus diisi</div>
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control form-control-lg"
                                        id="password" placeholder="Password">
                                    <div id="passwordError" class="error-message">Password tidak memenuhi
                                        persyaratan</div>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" name="registrasi"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">REGISTRASI</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Sudah punya akun? <a href="login.php"
                                        class="text-primary">Login</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const nama = document.getElementById('nama');
            const alamat = document.getElementById('alamat');
            const username = document.getElementById('username');
            const telepon = document.getElementById('telepon');
            const password = document.getElementById('password');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const usernameError = document.getElementById('usernameError');
            const teleponError = document.getElementById('teleponError');
            const passwordError = document.getElementById('passwordError');

            // Validation functions
            function validateNama() {
                if (nama.value.trim() === '') {
                    namaError.style.display = 'block';
                    return false;
                }
                namaError.style.display = 'none';
                return true;
            }

            function validateAlamat() {
                if (alamat.value.trim() === '') {
                    alamatError.style.display = 'block';
                    return false;
                }
                alamatError.style.display = 'none';
                return true;
            }

            function validateUsername() {
                if (username.value.length < 6) {
                    usernameError.textContent = 'Username minimal 6 karakter';
                    usernameError.style.display = 'block';
                    return false;
                }

                usernameError.style.display = 'none';
                return true;
            }

            function validateTelepon() {
                const teleponRegex = /^(^\+62|62|0)(\d{9,13})$/;
                if (!teleponRegex.test(telepon.value)) {
                    teleponError.textContent = 'Tidak valid(dimulai dengan format 08, batas 10 - 12 Nomor)';
                    teleponError.style.display = 'block';
                    return false;
                }
                teleponError.style.display = 'none';
                return true;
            }

            function validatePassword() {
                // Password must be at least 8 characters long
                // Must contain at least one uppercase, one lowercase, one number, and one special character
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (password.value.length < 8) {
                    passwordError.textContent = 'Password minimal 8 karakter';
                    passwordError.style.display = 'block';
                    return false;
                }

                passwordError.style.display = 'none';
                return true;
            }

            // Real-time validation
            nama.addEventListener('input', validateNama);
            alamat.addEventListener('input', validateAlamat);
            username.addEventListener('input', validateUsername);
            telepon.addEventListener('input', validateTelepon);
            password.addEventListener('input', validatePassword);

            // Form submission validation
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const isNamaValid = validateNama();
                const isAlamatValid = validateAlamat();
                const isUsernameValid = validateUsername();
                const isTeleponValid = validateTelepon();
                const isPasswordValid = validatePassword();

                if (isNamaValid && isUsernameValid && isTeleponValid && isPasswordValid && isAlamatValid) {
                    form.submit();
                }
            });
        });
    </script>


</body>

</html>
