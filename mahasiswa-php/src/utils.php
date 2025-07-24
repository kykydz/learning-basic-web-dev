<?php
// utils.php

// Fungsi untuk memvalidasi email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Fungsi untuk memvalidasi nomor telepon
function validatePhoneNumber($phone) {
    return preg_match('/^[0-9]{10,15}$/', $phone);
}

// Fungsi untuk menghapus spasi di awal dan akhir string
function trimString($string) {
    return trim($string);
}

// Fungsi untuk menggenerate ID unik
function generateUniqueId() {
    return uniqid('mahasiswa_', true);
}
?>