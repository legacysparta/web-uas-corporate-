<?php
include 'session.php';
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- ? agar emoji tidak error -->
    <title>Log Aktivitas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

<!-- Tombol ? toggle sidebar -->
<div class="menu-toggle" onclick="toggleSidebar()">&#9776;</div>


<?php include 'sidebar.php'; ?>

<div class="main-content">
    <h1>Log Aktivitas pejualan barang</h1>

    <!-- Tombol di luar area PDF -->
    <button onclick="downloadPDF()" class="btn">Download PDF</button>

    <!-- Bagian yang ingin diubah jadi PDF -->
    <div id="area-pdf">
        <table>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $log = mysqli_query($koneksi, "SELECT * FROM log ORDER BY waktu DESC");
            while ($l = mysqli_fetch_array($log)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $l['waktu'] ?></td>
                <td><?= $l['username'] ?></td>
                <td><?= $l['aksi'] ?></td>
            </tr>
            <?php } ?>
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
        filename:     'log-aktivitas.pdf',
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
