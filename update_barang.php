<?php
include 'session.php';
include 'koneksi.php';

$id     = $_POST['id'];
$nama   = $_POST['nama_barang'];
$jenis  = $_POST['jenis_barang'];
$stok   = $_POST['stok'];
$harga  = $_POST['harga'];

mysqli_query($koneksi, "UPDATE barang SET 
    nama_barang='$nama',
    jenis_barang='$jenis',
    stok='$stok',
    harga='$harga' 
    WHERE id='$id'");

header("Location: index.php?pesan=sukses_update");

?>
