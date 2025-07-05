<?php
$host = "localhost";
$user = "nurwahid";
$pass = "gakeroh123";
$db = "nurwahid_scm_db";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
