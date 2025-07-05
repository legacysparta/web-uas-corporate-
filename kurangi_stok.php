<?php
include 'session.php';
include 'koneksi.php';

$id = $_POST['id'];
$jumlah = intval($_POST['jumlah']);

// Ambil stok saat ini
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if ($d && $d['stok'] >= $jumlah) {
    $sisa = $d['stok'] - $jumlah;
    $terjual_baru = $d['terjual'] + $jumlah;

    mysqli_query($koneksi, "UPDATE barang 
                            SET stok='$sisa', terjual='$terjual_baru' 
                            WHERE id='$id'");

    // ✅ Ambil nama barang untuk dicatat ke log
    $nama_barang = $d['nama_barang'];

    // ✅ Catat log aktivitas
    $log_user = $_SESSION['username'];
    $log_aksi = mysqli_real_escape_string($koneksi, "$log_user mengurangi stok '$nama_barang' sebanyak $jumlah unit.");

    mysqli_query($koneksi, "INSERT INTO log (username, aksi) VALUES ('$log_user', '$log_aksi')");

    // Redirect setelah log tercatat
    header("Location: index.php");
} else {
    header("Location: index.php");
}
?>
