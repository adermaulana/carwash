<?php
include '../koneksi.php'; // pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi_221061 = $_POST['id_transaksi_221061'];

    // Memastikan folder untuk menyimpan foto ada
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder jika belum ada
    }

    $target_file = $target_dir . basename($_FILES["bukti_pembayaran_221061"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file gambar sebenarnya adalah gambar
    $check = getimagesize($_FILES["bukti_pembayaran_221061"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File bukan gambar.'); window.history.back();</script>";
        exit();
    }

    // Memeriksa ukuran file (misal, maksimal 2MB)
    if ($_FILES["bukti_pembayaran_221061"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran file terlalu besar.'); window.history.back();</script>";
        exit();
    }

    // Memeriksa format file
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "<script>alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.'); window.history.back();</script>";
        exit();
    }

    // Jika semuanya baik, coba untuk mengunggah file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["bukti_pembayaran_221061"]["tmp_name"], $target_file)) {
            // Update database dengan nama file yang diupload
            $nama_file = basename($_FILES["bukti_pembayaran_221061"]["name"]);
            $sql = "UPDATE transaksi_221061 SET bukti_pembayaran_221061='$nama_file' WHERE id_transaksi_221061='$id_transaksi_221061'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo "<script>alert('File " . htmlspecialchars($nama_file) . " berhasil diunggah dan data berhasil diperbarui.'); window.location.href='pembayaran.php';</script>";
            } else {
                echo "<script>alert('Kesalahan saat memperbarui database: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.'); window.history.back();</script>";
        }
    }
}
?>
