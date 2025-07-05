<?php
include 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .home-content {
            background-image: url('img/speaker.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            text-align: center;
            padding-top: 100px;
        }

        .home-content h1 {
            font-size: 36px;
            background: rgba(0,0,0,0.5);
            display: inline-block;
            padding: 20px 40px;
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .home-content h1 {
                font-size: 24px;
                padding: 15px 25px;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol titik tiga -->
    <div class="menu-toggle" onclick="toggleSidebar()">☰</div>

    <?php include 'sidebar.php'; ?>

    <div class="main-content home-content">
       <h1>Selamat Datang di Sistem Informasi CRM Penjualan Speaker</h1>
       <h2>
        Selamat datang, 
        <?php
            if ($_SESSION['role'] == 'admin') {
                echo "admin!";
            } else {
                echo "karyawan " . htmlspecialchars($_SESSION['username']) . "!";
            }
        ?>
       </h2>

       <p style="background: rgba(0,0,0,0.4); display:inline-block; padding: 15px 30px; margin-top: 20px; border-radius: 8px; font-size: 16px; max-width: 700px;">
            Aplikasi ini dirancang untuk membantu toko elektronik dalam mengelola data stok barang, memantau jumlah barang terjual, mencatat data karyawan, dan menyusun laporan penjualan secara efisien. 
            Dengan tampilan yang modern dan sistem yang ringan, Anda dapat dengan mudah menambah, mengedit, atau menghapus data barang serta memantau aktivitas penjualan setiap hari.<br><br>
            Diharapkan dengan sistem ini, pengelolaan bisnis menjadi lebih tertata, cepat, dan akurat. Terima kasih telah menggunakan sistem ini!
        </p>
    </div>

    <!-- Script Toggle Sidebar -->
    <script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }
    </script>

</body>
</html>
