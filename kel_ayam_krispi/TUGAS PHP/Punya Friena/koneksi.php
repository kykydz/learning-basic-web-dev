<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'tugas');

$conn = mysqli_connect(host, user, pass, db);

if (!$conn) {
    die("Tidak bisa terkoneksi ke database");
}
// Inisialisasi variabel op
$op = "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
}

$kategori = "";
$keterangan = "";
$jumlah = "";
$tipe = "";
$pemasukan = "";
$pengeluaran = "";
$sukses = "";
$error = "";


if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tipe = $_POST['tipe'];
    if ($tipe == "pemasukan") {
        $pemasukan = $jumlah;
        $pengeluaran = 0;
    } else {
        $pengeluaran = $jumlah;
        $pemasukan = 0;
    }

    if ($kategori && $keterangan && $tipe && $jumlah) {
        $sqli = "INSERT INTO tabel_keuangan(kategori, pemasukan, pengeluaran, 
        keterangan) VALUES('$kategori','$pemasukan','$pengeluaran', 
        '$keterangan')";

        $q1 = mysqli_query($conn, $sqli);
        if ($q1) {
            $sukses = "Berhasil memasukkan data baru";
        } else {
            $error = "Gagal memasukkan data";
        }
    } else {
        $error = "Silahkan masukkan semua data!";
    }
}

if ($op == 'edit') {
    $id_transaksi = $_GET['id'];
    $sql1 = "SELECT * FROM tabel_keuangan where id = '$id_transaksi'";
    $q1 = mysqli_query($conn, $sql1); // Mejalankan query
    $r1 = mysqli_fetch_array($q1); // Memasukkan hasil query ke array r1
    $kategori = $r1['kategori'];
    $keterangan = $r1['keterangan'];

    if($r1['pemasukan']==0){
        $jumlah = $r1['pengeluaran'];
        $tipe = "pengeluaran";
    }

    else{
        $jumlah = $r1['pemasukan'];
        $tipe = "pemasukan";
    }
}

if($op == 'delete'){
    $id_transaksi = $_GET['id'];
    $sql1 = "DELETE FROM tabel_keuangan where id = '$id_transaksi'";
    $q1 = mysqli_query($conn, $sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error = "Gagal melakukan delete data";
    }
}
