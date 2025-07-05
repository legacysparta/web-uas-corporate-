<?php
include 'session.php';
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
  <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Edit Data Barang</h2>
    <form action="update_barang.php" method="POST">
        <input type="hidden" name="id" value="<?= $d['id'] ?>">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?= $d['nama_barang'] ?>" required>
        <label>Jenis Barang:</label>
        <input type="text" name="jenis_barang" value="<?= $d['jenis_barang'] ?>" required>
        <label>Stok:</label>
        <input type="number" name="stok" value="<?= $d['stok'] ?>" required>
        <label>Harga (Rp):</label>
        <input type="number" name="harga" value="<?= $d['harga'] ?>" required>
        <input type="submit" value="Update">
        <a href="index.php" class="btn full-width" style="background-color: #c0392b;">Batal</a>
    </form>
</body>
</html>
