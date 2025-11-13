<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Data contoh
$kode_barang = ["B001", "B002", "B003", "B004", "B005"];
$nama_barang = ["Sabun", "Sampo", "Pasta Gigi", "Tisu", "Detergen"];
$harga_barang = [8000, 15000, 12000, 10000, 20000];

$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

// Tentukan jumlah beli acak untuk tiap barang
for ($i = 0; $i < count($nama_barang); $i++) {
    $jumlah[$i] = rand(1, 5);
    $total[$i] = $harga_barang[$i] * $jumlah[$i];
    $grandtotal += $total[$i];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | SKY MART</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #89f7fe, #66a6ff);
        color: #fff;
        margin: 0;
        padding: 0;
    }

    /* ==== LOGO DI TENGAH ATAS ==== */
  .logo-center {
    font-size: 2em;
    font-weight: bold;
    color: #fff;
    letter-spacing: 1px;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.logo-center span {
    color: #007bff;
}


    /* ==== DASHBOARD ==== */
    .dashboard {
        margin-top: 120px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        width: 85%;
        max-width: 950px;
        padding: 30px;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    /* ==== HEADER DI ATAS TABEL ==== */
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logout-btn {
        background: linear-gradient(135deg, #ff5f6d, #ffc371);
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }

    .logout-btn:hover {
        transform: scale(1.05);
    }

    .user-info {
        text-align: left;
    }

    .user-info h3 {
        margin: 0;
        font-size: 1em;
        font-weight: 600;
    }

    .user-info p {
        margin: 3px 0 0 0;
        font-size: 0.9em;
        opacity: 0.9;
    }

    h2 {
        color: #fff;
        text-align: center;
        margin-top: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        text-align: center;
    }

    th {
        background: rgba(255,255,255,0.25);
    }

    tr:hover {
        background: rgba(255,255,255,0.1);
    }

    .footer {
        margin-top: 25px;
        font-size: 14px;
        opacity: 0.8;
        text-align: center;
    }
</style>
</head>
<body>

<!-- Logo tengah atas -->
<div class="logo-center">
<span>SKY MART</span>
</div>

<!-- Konten utama -->
<div class="dashboard">

    <!-- Logo tengah di dalam dashboard -->
    <div class="logo-center" style="position: static; transform: none; justify-content: center; margin-bottom: 20px;">
        <span>SKY MART</span>
    </div>

    <!-- Bar atas daftar barang -->
    <div class="table-header">
        <div class="user-info">
            <h3>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h3>
            <p>Role: <?= htmlspecialchars($_SESSION['role']); ?></p>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <h2>Daftar Barang</h2>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah Beli</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($kode_barang); $i++): ?>
            <tr>
                <td><?= $kode_barang[$i]; ?></td>
                <td><?= $nama_barang[$i]; ?></td>
                <td>Rp <?= number_format($harga_barang[$i], 0, ',', '.'); ?></td>
                 <td><?= $jumlah[$i]; ?></td>
                <td>Rp <?= number_format($total[$i], 0, ',', '.'); ?></td>
            </tr>
            <?php endfor; ?>
             <tr>
            <td colspan="4" style="text-align:right;font-weight:bold;">Grand Total</td>
            <td style="font-weight:bold;">Rp<?= number_format($grandtotal, 0, ',', '.'); ?></td>
        </tr>
        <?php
    // Hitung diskon
    if ($grandtotal <= 50000) {
        $diskon_persen = 5;
    } elseif ($grandtotal <= 100000) {
        $diskon_persen = 10;
    } else {
        $diskon_persen = 20;
    }

    $nilai_diskon = ($grandtotal * $diskon_persen) / 100;
    $total_setelah_diskon = $grandtotal - $nilai_diskon;

    // Simulasi uang bayar dan kembalian
    $uang_bayar = $total_setelah_diskon + rand(10000, 50000); // pelanggan bayar lebih
    $kembalian = $uang_bayar - $total_setelah_diskon;
    ?>

    <!-- Diskon -->
    <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;">Diskon (<?= $diskon_persen ?>%)</td>
        <td style="font-weight:bold;">- Rp<?= number_format($nilai_diskon, 0, ',', '.'); ?></td>
    </tr>

    <!-- Total Pembayaran -->
    <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;">Total Pembayaran</td>
        <td style="font-weight:bold;">Rp<?= number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
    </tr>

    <!-- Uang Bayar -->
    <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;">Uang Bayar</td>
        <td style="font-weight:bold;">Rp<?= number_format($uang_bayar, 0, ',', '.'); ?></td>
    </tr>

    <!-- Kembalian -->
    <tr>
        <td colspan="4" style="text-align:right;font-weight:bold;">Kembalian</td>
        <td style="font-weight:bold;">Rp<?= number_format($kembalian, 0, ',', '.'); ?></td>
    </tr>
</tbody>
    </table>
    <div class="footer">
        © <?= date("Y"); ?> SKY MART • Dashboard Modern
    </div>
</div>

</body>
</html>
