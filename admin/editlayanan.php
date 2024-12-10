<?php

include '../koneksi.php';

session_start();

if ($_SESSION['status'] != 'login') {
    session_unset();
    session_destroy();

    header('location:../');
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == 'edit') {
        $tampil = mysqli_query($koneksi, "SELECT * FROM jenis_cucian_221061 WHERE id_jenis_cucian_221061 = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $id = $data['id_jenis_cucian_221061'];
            $jenis_cucian = $data['jenis_cucian_221061'];
            $biaya = $data['biaya_221061'];
            $kuota = $data['kuota_221061'];
            $gambar_lama = $data['gambar_221061'];
        }
    }
}

if (isset($_POST['simpan'])) {
    $gambar_lama = $_POST['gambar_lama'];

    // Check if new image is uploaded
    if ($_FILES['gambar']['name'] != '') {
        // Handle image upload
        $target_dir = 'uploads/';
        $file_name = basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is actual image
        $check = getimagesize($_FILES['gambar']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File bukan gambar.');</script>";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES['gambar']['size'] > 5000000) {
            echo "<script>alert('Maaf, file terlalu besar.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            echo "<script>alert('Maaf, hanya JPG, JPEG & PNG yang diperbolehkan.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Delete old image if exists
            if ($gambar_lama != '' && file_exists($target_dir . $gambar_lama)) {
                unlink($target_dir . $gambar_lama);
            }

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                // Update with new image
                $simpan = mysqli_query(
                    $koneksi,
                    "UPDATE jenis_cucian_221061 SET
                                              jenis_cucian_221061 = '$_POST[nama]',
                                              biaya_221061 = '$_POST[biaya]',
                                              kuota_221061 = '$_POST[kuota]',
                                              gambar_221061 = '$file_name'
                                            WHERE id_jenis_cucian_221061 = '$_GET[id]'",
                );
            } else {
                echo "<script>alert('Maaf, error saat upload.');</script>";
                exit();
            }
        }
    } else {
        // Update without changing image
        $simpan = mysqli_query(
            $koneksi,
            "UPDATE jenis_cucian_221061 SET
                                      jenis_cucian_221061 = '$_POST[nama]',
                                      biaya_221061 = '$_POST[biaya]',
                                      kuota_221061 = '$_POST[kuota]'
                                    WHERE id_jenis_cucian_221061 = '$_GET[id]'",
        );
    }

    if ($simpan) {
        echo "<script>
              alert('Edit data sukses!');
              document.location='layanan.php';
            </script>";
    } else {
        echo "<script>
              alert('Edit data Gagal!');
              document.location='layanan.php';
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
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates,
                                and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
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
                <a class="navbar-brand brand-logo" href="index.php"></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false"
                            aria-controls="forms">
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
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
                            <span class="menu-title">Rating</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <a class="nav-link" href="rating.php">Rating</a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false"
                            aria-controls="charts">
                            <span class="menu-title">Laporan</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                        <div class="collapse" id="laporan">
                            <ul class="nav flex-column sub-menu">
                                <a class="nav-link" href="laporan.php">Lihat Laporan</a>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#waktu" aria-expanded="false"
                            aria-controls="charts">
                            <span class="menu-title">Waktu Pengerjaan</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                        <div class="collapse" id="waktu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="slotwaktu.php">Lihat Waktu Pengerjaan</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tambah_slot.php">Tambah Waktu Pengerjaan</a>
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
                        <h3 class="page-title">Tambah Layanan</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nama Layanan</label>
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                value="<?= $jenis_cucian ?>" placeholder="Nama Layanan" required>
                                            <div id="namaError" class="error-message">Nama harus diisi</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya</label>
                                            <input type="number" class="form-control" name="biaya" id="biaya"
                                                value="<?= $biaya ?>" placeholder="Biaya" required>
                                            <div id="biayaError" class="error-message">Harga tidak valid</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kuota</label>
                                            <input type="number" class="form-control" name="kuota" id="kuota"
                                                value="<?= $kuota ?>" placeholder="Kuota" required>
                                            <div id="kuotaError" class="error-message">Kuota tidak valid</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Upload Gambar</label>
                                            <?php if(isset($gambar_lama) && $gambar_lama != ""): ?>
                                            <div class="mb-2">
                                                <img src="uploads/<?= $gambar_lama ?>" alt="Current Image"
                                                    style="max-width: 200px;">
                                            </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control" name="gambar" id="gambar"
                                                accept="image/*">
                                            <input type="hidden" name="gambar_lama" value="<?= $gambar_lama ?>">
                                            <small class="form-text text-muted">Upload gambar baru jika ingin mengubah
                                                gambar (JPG, JPEG, atau PNG, Max. 5MB)</small>
                                        </div>
                                        <button type="submit" id="submitButton" name="simpan"
                                            class="btn btn-gradient-primary me-2" disabled>Submit</button>
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
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a
                                href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights
                            reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i></span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nama = document.getElementById('nama');
            const harga = document.getElementById('biaya');
            const kuota = document.getElementById('kuota');
            const submitButton = document.getElementById('submitButton');

            // Error message elements
            const namaError = document.getElementById('namaError');
            const biayaError = document.getElementById('biayaError');
            const kuotaError = document.getElementById('kuotaError');

            // Validation functions
            function validateNama() {
                if (nama.value.trim() === '') {
                    namaError.style.display = 'block';
                    return false;
                }
                namaError.style.display = 'none';
                return true;
            }

            function validateBiaya() {
                const biayaValue = parseFloat(biaya.value); // Mengambil nilai harga dari input
                if (isNaN(biayaValue) || biayaValue < 5000) {
                    // Memastikan harga adalah angka dan minimal 10,000
                    biayaError.textContent = 'Biaya harus berupa angka minimal 5,000';
                    biayaError.style.display = 'block';
                    return false;
                }
                biayaError.style.display = 'none';
                return true;
            }

            function validateKuota() {
                const kuotaValue = parseInt(kuota.value.trim(), 10); // Mengonversi nilai ke angka
                if (isNaN(kuotaValue) || kuotaValue < 1) { // Memastikan nilai minimal 1
                    kuotaError.textContent = 'Kuota minimal harus 1';
                    kuotaError.style.display = 'block';
                    return false;
                }
                kuotaError.style.display = 'none';
                return true;
            }

            function checkFormValidity() {
                const isNamaValid = validateNama();
                const isBiayaValid = validateBiaya();
                const isKuotaValid = validateKuota();

                // Enable or disable the submit button based on all validations
                if (isNamaValid && isBiayaValid && isKuotaValid) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }

            }


            // Real-time validation
            nama.addEventListener('input', checkFormValidity);
            biaya.addEventListener('input', checkFormValidity);
            kuota.addEventListener('input', checkFormValidity);

            // Form submission validation
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                checkFormValidity();

                if (!submitButton.disabled) {
                    form.submit();
                }

            });
        });
    </script>

</body>

</html>
