<?php
session_start();
session_unset();   // hapus semua variabel session
session_destroy(); // hapus session
header("Location: login.php"); // kembali ke login
exit;
?>
