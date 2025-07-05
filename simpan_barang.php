<?php
include 'session.php';
include 'koneksi.php';

$nama   = $_POST['nama_barang'];
$jenis  = $_POST['jenis_barang'];
$stok   = $_POST['stok'];
$harga  = $_POST['harga'];

mysqli_query($koneksi, "INSERT INTO barang (nama_barang, jenis_barang, stok, harga)
                        VALUES ('$nama', '$jenis', '$stok', '$harga')");

header("Location: index.php?pesan=sukses_tambah");


?>
