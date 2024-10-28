<?php


include '../koneksi.php';


// Ambil ID pemesanan dari URL
$id_pemesanan = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_pemesanan) {
    // Query untuk mengubah status pemesanan menjadi 'Ditolak'
    $query = "UPDATE pendaftaran_221061 SET status_221061 = 'Selesai' WHERE id_pendaftaran_221061 = '$id_pemesanan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Mengambil data id_jenis_cucian_221061 dari tabel pendaftaran
        $dataPendaftaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_jenis_cucian_221061 FROM pendaftaran_221061 WHERE id_pendaftaran_221061 = '$id_pemesanan'"));
        $id_jenis_cucian = $dataPendaftaran['id_jenis_cucian_221061'];

        // Menambahkan kuota pada jenis cucian terkait
        mysqli_query($koneksi, "UPDATE jenis_cucian_221061 SET kuota_221061 = kuota_221061 + 1 WHERE id_jenis_cucian_221061 = '$id_jenis_cucian'");

        // Mengubah status pada tabel transaksi menjadi 'Ditolak'
        mysqli_query($koneksi, "UPDATE transaksi_221061 SET status_221061 = 'Lunas' WHERE id_pendaftaran_221061 = '$id_pemesanan'");

        echo "<script>
            alert('Selesai Pengerjaan!');
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