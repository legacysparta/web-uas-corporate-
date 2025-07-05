<?php include 'session.php'; include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>

    <title>Daftar Barang</title>
 	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
   
</head>

<body>

<!-- Tombol ☰ -->
<div class="menu-toggle" onclick="toggleSidebar()">☰</div>
<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h1>Daftar Barang</h1>
    <a href="tambah_barang.php" class="btn">+ Tambah Barang</a>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="popup">
            <?php
            if ($_GET['pesan'] == 'terjual') {
                $jumlah = $_GET['jumlah'] ?? 1;
                echo "✅ Stok dikurangi sebanyak $jumlah unit.";
            }
            if ($_GET['pesan'] == 'gagal_terjual') echo "⚠️ Jumlah melebihi stok tersedia!";
            ?>
        </div>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Terjual</th>
            <th>Harga</th>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <th style="width: 180px;">Aksi</th>
            <?php endif; ?>
            <th style="width: 220px;">Terjual (Qty)</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_barang'] ?></td>
            <td><?= $d['jenis_barang'] ?></td>
            <td>
                <?= ($d['stok'] == 0) ? '<span style="color:red; font-weight:bold;">Habis</span>' : $d['stok'] ?>
            </td>
            <td><?= $d['terjual'] ?></td>
            <td>Rp <?= number_format($d['harga']) ?></td>

            <?php if ($_SESSION['role'] == 'admin'): ?>
            <td style="width: 180px;">
                <a href="edit_barang.php?id=<?= $d['id'] ?>" class="btn">Edit</a>
                <a href="hapus_barang.php?id=<?= $d['id'] ?>" class="btn red"
                   onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
            </td>
            <?php endif; ?>

            <td style="width: 220px;">
                <form action="kurangi_stok.php" method="POST" style="display:flex; gap:8px; align-items:center;">
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    <input type="number" name="jumlah" min="1" max="<?= $d['stok'] ?>" placeholder="Qty"
                           style="width: 70px;" required <?= ($d['stok'] == 0) ? 'disabled' : '' ?>>
                    <button type="submit" class="btn" style="background-color:#f39c12;"
                            <?= ($d['stok'] == 0) ? 'disabled' : '' ?>>OK</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
</script>

</body>
</html>
