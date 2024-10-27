<?php


include '../koneksi.php';


// Ambil ID pemesanan dari URL
$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_pemesanan) {
    // Query untuk mengubah status pemesanan menjadi 'dikonfirmasi'
    $query = "UPDATE pendaftaran_221061 SET status_221061 = 'Ditolak ' WHERE id_pendaftaran_221061 = '$id_pemesanan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
        alert('Sukses Dibatalkan!');
        document.location='booking.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Dibatalkan!');
        document.location='booking.php';
        </script>";
    }
} else {
    // Jika tidak ada ID yang diterima, arahkan kembali
    header("Location: pemesanan.php?pesan=gagal");
}