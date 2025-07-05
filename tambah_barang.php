<?php include 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

    <div class="main-content">
        <h1>Tambah Barang Baru</h1>
        <form action="simpan_barang.php" method="POST">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
            <label>Jenis Barang:</label>
            <input type="text" name="jenis_barang" required>
            <label>Jumlah Stok:</label>
            <input type="number" name="stok" required>
            <label>Harga (Rp):</label>
            <input type="number" name="harga" required>
            <input type="submit" class="btn" value="Simpan Barang">
            <a href="index.php" class="btn full-width" style="background-color: #c0392b;">Batal</a>

        </form>
    </div>
</body>
</html>
