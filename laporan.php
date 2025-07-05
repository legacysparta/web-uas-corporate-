<?php include 'session.php'; include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

    <title>Laporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

<!-- Tombol ? untuk toggle sidebar -->
<div class="menu-toggle" onclick="toggleSidebar()">&#9776;</div>


<?php include 'sidebar.php'; ?>

<!-- Tombol Download DI LUAR #area-pdf -->
<div class="main-content">
    <h1>Laporan Stok Barang</h1>
    <button onclick="downloadPDF()" class="btn">Download PDF</button>

    <div id="area-pdf">
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Nilai Total</th>
            </tr>
            <?php
            $total = 0;
            $data = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($d = mysqli_fetch_array($data)) {
                $nilai = $d['stok'] * $d['harga'];
                $total += $nilai;
            ?>
            <tr>
                <td><?= $d['nama_barang'] ?></td>
                <td><?= $d['stok'] ?> Unit</td>
                <td>Rp <?= number_format($nilai) ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="2">Total Nilai Stok</th>
                <th>Rp <?= number_format($total) ?></th>
            </tr>
        </table>
    </div>
</div>

<!-- Script HTML2PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById('area-pdf');
    const opt = {
        margin:       0.3,
        filename:     'laporan.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
</script>

<!-- Script Toggle Sidebar -->
<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
</script>

</body>
</html>
