<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        header("Location: home.php?pesan=login_berhasil");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($_GET['register']) && $_GET['register'] == 'success') {
        echo "<p style='color:green;'>Akun berhasil dibuat. Silakan login!</p>";
    }
    ?>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
