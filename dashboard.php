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
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2em;
        font-weight: bold;
        color: #fff;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 10;
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

    <!-- Bar atas daftar barang (sudah ditukar posisi) -->
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
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($kode_barang); $i++): ?>
            <tr>
                <td><?= $kode_barang[$i]; ?></td>
                <td><?= $nama_barang[$i]; ?></td>
                <td>Rp <?= number_format($harga_barang[$i], 0, ',', '.'); ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="footer">
        © <?= date("Y"); ?> SKY MART • Dashboard Modern
    </div>
</div>

</body>
</html>
