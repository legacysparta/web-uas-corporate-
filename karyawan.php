<?php include 'session.php'; include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

<!-- Tombol titik tiga -->
<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h1><br><br><br>Daftar Karyawan (Akun Login)</h1>

    <?php if ($_SESSION['role'] == 'admin'): ?>
        <a href="register.php" class="btn">+ Tambah Akun</a>
    <?php endif; ?>

    <?php if (isset($_GET['pesan'])): ?>
    <div class="popup">
        <?php
        if ($_GET['pesan'] == 'update_karyawan') echo "✅ Karyawan berhasil diupdate!";
        if ($_GET['pesan'] == 'hapus_karyawan') echo "✅ Karyawan berhasil dihapus!";
        if ($_GET['pesan'] == 'gagal_admin') echo "⚠️ Akun 'admin' tidak boleh dihapus!";
        ?>
    </div>
    <?php endif; ?>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM user");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['username'] ?></td>

            <?php if ($_SESSION['role'] == 'admin'): ?>
            <td>
                <a href="edit_karyawan.php?id=<?= $d['id'] ?>" class="btn">Edit</a>
                <a href="hapus_karyawan.php?id=<?= $d['id'] ?>" class="btn red"
                   onclick="return confirm('Yakin ingin menghapus akun karyawan ini?')">Hapus</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- Script Toggle Sidebar -->
<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
</script>

</body>
</html>
