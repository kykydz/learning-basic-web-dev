<?php
include 'koneksi.php'; // Hubungkan ke database

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Validasi agar ID tidak kosong
if (!empty($id)) {
    $sql = "DELETE FROM adoption WHERE id_adop = $id";
    if ($conn->query($sql) === TRUE) {
        // Setelah berhasil hapus, redirect kembali ke tampil
        header("Location: tampil_adoption.php");
        exit;
    } else {
        echo "❌ Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "❗ ID tidak ditemukan.";
}

$conn->close();
?>
