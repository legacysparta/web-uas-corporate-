<?php include 'session.php'; include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kualitatif WHERE id=$id");
$d = mysqli_fetch_assoc($data);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aspek = $_POST['aspek'];
    $deskripsi = $_POST['deskripsi'];
    $nilai = $_POST['nilai'];
    mysqli_query($koneksi, "INSERT INTO matrik_kualitatif (aspek, deskripsi, nilai, tanggal) VALUES ('$aspek', '$deskripsi', '$nilai', NOW())");

    header("Location: matrik_kualitatif.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Matrik Kualitatif</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main-content">
    <h1>Edit Matrik Kualitatif</h1>
    <form method="POST">
        <label>Aspek:</label>
        <input type="text" name="aspek" value="<?= $d['aspek'] ?>" required>
        <label>Deskripsi:</label>
        <input type="text" name="deskripsi" value="<?= $d['deskripsi'] ?>" required>
        <label>Nilai:</label>
        <select name="nilai" required>
            <option value="Sangat Baik" <?= ($d['nilai'] == 'Sangat Baik') ? 'selected' : '' ?>>Sangat Baik</option>
            <option value="Baik" <?= ($d['nilai'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
            <option value="Cukup" <?= ($d['nilai'] == 'Cukup') ? 'selected' : '' ?>>Cukup</option>
            <option value="Kurang" <?= ($d['nilai'] == 'Kurang') ? 'selected' : '' ?>>Kurang</option>
        </select>
        <input type="submit" value="Update" class="btn">
        <a href="matrik_kualitatif.php" class="btn red">Batal</a>
    </form>
</div>
</body>
</html>
