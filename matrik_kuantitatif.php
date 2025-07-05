<?php
include 'session.php';
include 'koneksi.php';

// Ambil filter dari URL
$filter_waktu = $_GET['filter'] ?? 'semua';
$filter_nama = $_GET['nama'] ?? 'semua';

// Buat kondisi WHERE
$where = [];

if ($filter_waktu == 'hari_ini') {
    $where[] = "DATE(created_at) = CURDATE()";
} elseif ($filter_waktu == 'kemarin') {
    $where[] = "DATE(created_at) = CURDATE() - INTERVAL 1 DAY";
} elseif ($filter_waktu == 'minggu') {
    $where[] = "YEARWEEK(created_at) = YEARWEEK(NOW())";
} elseif ($filter_waktu == 'bulan') {
    $where[] = "MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
}

if ($filter_nama != 'semua') {
    $nama = mysqli_real_escape_string($koneksi, $filter_nama);
    $where[] = "nama_barang = '$nama'";
}

$kondisi = "";
if (!empty($where)) {
    $kondisi = "WHERE " . implode(" AND ", $where);
}

// Ambil data barang
$data = mysqli_query($koneksi, "SELECT nama_barang, terjual FROM barang $kondisi");

// Konversi ke array untuk Chart.js dan juga tabel
$labels = [];
$jumlah = [];
$rows = [];

while ($d = mysqli_fetch_array($data)) {
    $labels[] = $d['nama_barang'];
    $jumlah[] = $d['terjual'];
    $rows[] = $d;
}

// Ambil semua nama barang untuk dropdown
$semua_barang = mysqli_query($koneksi, "SELECT DISTINCT nama_barang FROM barang");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Matrik Kuantitatif</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<!-- Tombol ☰ -->
<div class="menu-toggle">
  <a href="index.php" style="color:white; text-decoration:none;">🔙 Kembali</a>
</div>
<?php include 'sidebar.php'; ?>
<div class="main-content">
    <h1>Matrik Kuantitatif (Barang Terjual)</h1>

    <form method="GET" style="display:flex; gap: 15px; margin-bottom:20px; flex-wrap:wrap;">
        <div>
            <label>Filter Waktu:</label>
            <select name="filter" onchange="this.form.submit()">
                <option value="semua" <?= ($filter_waktu == 'semua') ? 'selected' : '' ?>>Semua</option>
                <option value="hari_ini" <?= ($filter_waktu == 'hari_ini') ? 'selected' : '' ?>>Hari Ini</option>
                <option value="kemarin" <?= ($filter_waktu == 'kemarin') ? 'selected' : '' ?>>Kemarin</option>
                <option value="minggu" <?= ($filter_waktu == 'minggu') ? 'selected' : '' ?>>Minggu Ini</option>
                <option value="bulan" <?= ($filter_waktu == 'bulan') ? 'selected' : '' ?>>Bulan Ini</option>
            </select>
        </div>
        <div>
            <label>Nama Barang:</label>
            <select name="nama" onchange="this.form.submit()">
                <option value="semua" <?= ($filter_nama == 'semua') ? 'selected' : '' ?>>Semua</option>
                <?php while ($b = mysqli_fetch_array($semua_barang)): ?>
                    <option value="<?= $b['nama_barang'] ?>" <?= ($filter_nama == $b['nama_barang']) ? 'selected' : '' ?>>
                        <?= $b['nama_barang'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>

    <!-- Chart -->
    <canvas id="chartBar" style="max-width: 100%; height: 400px;"></canvas>

    <!-- Tabel -->
    <h3>Detail Data Barang Terjual</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah Terjual</th>
        </tr>
        <?php $no = 1; foreach ($rows as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['nama_barang'] ?></td>
            <td><?= $r['terjual'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (count($rows) == 0): ?>
        <tr><td colspan="3" style="text-align:center; color:gray;">Tidak ada data</td></tr>
        <?php endif; ?>
    </table>

    <script>
    const ctx = document.getElementById('chartBar').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Jumlah Terjual',
                data: <?= json_encode($jumlah) ?>,
                backgroundColor: '#3498db',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
    </script>
</div>
</body>
</html>
