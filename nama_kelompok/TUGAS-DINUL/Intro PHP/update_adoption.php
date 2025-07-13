<?php
include 'koneksi.php';

$id     = $_POST['id_adop'];
$nama   = $_POST['nama_adopter'];
$jenis  = $_POST['jenis_hewan'];
$tanggal= $_POST['tanggal'];
$notes  = $_POST['notes'];

$sql = "UPDATE adoption SET 
            nama_adopter = '$nama',
            jenis_hewan  = '$jenis',
            tanggal      = '$tanggal',
            notes        = '$notes'
        WHERE id_adop = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: tampil_adoption.php");
    exit;
} else {
    echo "Gagal update data: " . $conn->error;
}

$conn->close();
?>
