<?php
include 'session.php';
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data user berdasarkan ID
    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $user = mysqli_fetch_assoc($cek);

    // Jika user ditemukan dan username = 'admin', tolak hapus
    if ($user && $user['username'] === 'admin') {
        header("Location: karyawan.php?pesan=gagal_admin");
        exit;
    }

    // Lanjutkan hapus jika bukan admin
    mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header("Location: karyawan.php?pesan=hapus_karyawan");
} else {
    header("Location: karyawan.php");
}
?>
