<?php


include '../koneksi.php';


// Ambil ID pemesanan dari URL
$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_pemesanan) {
    // Query untuk mengubah status pemesanan menjadi 'Ditolak'
    $query = "UPDATE pendaftaran_221061 SET status_221061 = 'Dalam Pengerjaan' WHERE id_pendaftaran_221061 = '$id_pemesanan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {

        // Mengubah status pada tabel transaksi menjadi 'Ditolak'
        mysqli_query($koneksi, "UPDATE transaksi_221061 SET status_221061 = 'Lunas' WHERE id_pendaftaran_221061 = '$id_pemesanan'");

        echo "<script>
            alert('Dalam Pengerjaan!');
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