<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM kualitatif WHERE id = '$id'");
    header("Location: matrik_kualitatif.php?pesan=sukses_hapus");
    exit;
} else {
    header("Location: matrik_kualitatif.php");
    exit;
}
?>
