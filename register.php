<?php
session_start();
include 'koneksi.php';

// Batasi hanya admin yang bisa akses halaman ini
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Secara default, akun baru akan jadi 'karyawan'
    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        mysqli_query($koneksi, "INSERT INTO user (username, password, role) VALUES ('$username', '$password', 'karyawan')");
        header("Location: karyawan.php?pesan=berhasil_tambah");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Akun Baru</title>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

    <h1>Tambah Akun Karyawan</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" class="btn" value="Simpan Akun">
        <a href="karyawan.php" class="btn full-width" style="background-color: #c0392b;">Batal</a>
    </form>

</body>
</html>
