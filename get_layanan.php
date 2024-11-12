<?php
include 'koneksi.php';

if(isset($_POST['id_layanan'])) {
    $id_layanan = $_POST['id_layanan'];
    
    $query = mysqli_query($koneksi, "SELECT * FROM jenis_cucian_221061 WHERE id_jenis_cucian_221061 = '$id_layanan'");
    $data = mysqli_fetch_assoc($query);
    
    echo json_encode($data);
} else {
    echo json_encode(null);
}
?>