<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tugas"; // pastikan DB 'tugas' sudah dibuat di phpMyAdmin

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
