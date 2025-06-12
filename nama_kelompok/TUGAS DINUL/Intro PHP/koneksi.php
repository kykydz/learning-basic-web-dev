<?php
$host = "localhost";
$user = "root";
$password = ""; // kosong jika Laragon default
$database = "cat adoption";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
