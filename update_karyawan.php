<?php
include 'session.php';
include 'koneksi.php';

$id = $_POST['id'];
$username = $_POST['username'];

mysqli_query($koneksi, "UPDATE user SET username='$username' WHERE id='$id'");

header("Location: karyawan.php?pesan=update_karyawan");
?>
