<?php
include 'session.php';
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
      <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Edit Username Karyawan</h2>
    <form method="POST" action="update_karyawan.php">
        <input type="hidden" name="id" value="<?= $d['id'] ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?= $d['username'] ?>" required>
        <input type="submit" class="btn" value="Update Akun">
        <a href="karyawan.php" class="btn red full-width">Batal</a>
    </form>

</body>
</html>
