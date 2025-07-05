<?php include 'session.php'; include 'koneksi.php'; 
// Tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah'])) {
    $aspek = $_POST['aspek'];
    $deskripsi = $_POST['deskripsi'];
    $nilai = $_POST['nilai'];
    mysqli_query($koneksi, "INSERT INTO kualitatif (aspek, deskripsi, nilai) VALUES ('$aspek', '$deskripsi', '$nilai')");
    header("Location: matrik_kualitatif.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kualitatif WHERE id=$id");
    header("Location: matrik_kualitatif.php");
    exit;
}?>
<!DOCTYPE html>
<html>
<head>

     <title>Matrik Kualitatif</title>
 	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
   
</head>

<body>

<!-- Tombol ☰ -->
<div class="menu-toggle">
  <a href="index.php" style="color:white; text-decoration:none;">🔙 Kembali</a>
</div>

<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h1>Matrik Kualitatif Internal</h1>
<?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_hapus'): ?>
    <div class="popup">✅ Data berhasil dihapus!</div>
<?php endif; ?>

    <!-- Form Tambah -->
    <form method="POST">
        <input type="hidden" name="tambah" value="1">
        <label>Aspek:</label>
        <input type="text" name="aspek" required>
        <label>Deskripsi:</label>
        <input type="text" name="deskripsi" required>
        <label>Nilai:</label>
        <select name="nilai" required>
            <option value="Sangat Baik">Sangat Baik</option>
            <option value="Baik">Baik</option>
            <option value="Cukup">Cukup</option>
            <option value="Kurang">Kurang</option>
        </select>
        <input type="submit" value="Simpan" class="btn">
    </form>

    <!-- Tabel Data -->
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th> <!-- Tambahkan kolom ini -->
            <th>Aspek</th>
            <th>Deskripsi</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM kualitatif");
        while ($d = mysqli_fetch_array($data)) {
        ?>
       <tr>
    <td><?= $no++ ?></td>
    <td><?= date('d-m-Y H:i', strtotime($d['tanggal'])) ?></td> <!-- Format tanggal -->
    <td><?= $d['aspek'] ?></td>
    <td><?= $d['deskripsi'] ?></td>
    <td><?= $d['nilai'] ?></td>
    <td>
    <a href="hapus_matrik.php?id=<?= $d['id'] ?>" class="btn red"
       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
</td>
</tr>

        <?php } ?>
    </table>
</div>


</body>
</html>
