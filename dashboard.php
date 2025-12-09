<?php
session_start();

// ===============================================================
// CEK LOGIN
// ===============================================================
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ===============================================================
// 1. KERANJANG BELANJA (MANUAL)
// ===============================================================

// buat keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// tombol tambah barang
if (isset($_POST['tambah'])) {
    $kode   = $_POST['kode'];
    $nama   = $_POST['nama'];
    $harga  = (int)$_POST['harga'];
    $jumlah = (int)$_POST['jumlah'];

    $total = $harga * $jumlah;

    $_SESSION['keranjang'][] = [
        'kode'   => $kode,
        'nama'   => $nama,
        'harga'  => $harga,
        'jumlah' => $jumlah,
        'total'  => $total
    ];
}

// tombol reset keranjang
if (isset($_POST['reset'])) {
    $_SESSION['keranjang'] = [];
}

// hitung total keranjang
$totalBelanja = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $totalBelanja += $item['total'];
}

// atur diskon
if ($totalBelanja <= 50000) {
    $diskonPersen = 5;
} elseif ($totalBelanja <= 100000) {
    $diskonPersen = 10;
} else {
    $diskonPersen = 20;
}

$diskon = ($totalBelanja * $diskonPersen) / 100;
$totalBayar = $totalBelanja - $diskon;

$dataBarang = [
    "BRG001" => ["nama" => "Sabun Mandi", "harga" => 15000],
    "BRG002" => ["nama" => "Sikat Gigi", "harga" => 12000],
    "BRG003" => ["nama" => "Pasta Gigi", "harga" => 20000],
    "BRG004" => ["nama" => "Shampoo", "harga" => 25000],
    "BRG005" => ["nama" => "Handuk", "harga" => 30000],
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard | SKY MART</title>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #89f7fe, #66a6ff);
        color: #fff;
        margin: 0;
        padding: 0;
    }

    /* LOGO TENGAH */
    .logo-center {
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }
    .logo-center span { color: #007bff; }

    /* DASHBOARD */
    .dashboard {
        margin-top: 70px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        width: 85%;
        max-width: 950px;
        padding: 30px;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        background: rgba(255,255,255,0.15);
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.3);
    }

    tr:hover {
        background: rgba(255,255,255,0.1);
    }

    /* FORM INPUT */
    .input-box {
        background: white;
        padding: 30px;
        border-radius: 10px;
        margin-top: 25px;
        color: black;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background: white;
    font-size: 15px;
}

    button {
        padding: 10px 45px;
        border: none;
        border-radius: 6px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        margin-top: 15px;
    }

    .btn-blue { background: #1e90ff; }
    .btn-red { background: #dc3545; }

    .footer {
        margin-top: 30px;
        text-align: center;
        opacity: 0.8;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logout-btn {
        background: linear-gradient(135deg, #ff5f6d, #ffc371);
        padding: 8px 18px;
        border-radius: 8px;
        text-decoration: none;
        color: white;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="logo-center"><span>SKY MART</span></div>

<div class="dashboard">

    <!-- HEADER USER -->
    <div class="table-header">
        <div>
            <h3>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?></h3>
            <p>Role: <?= htmlspecialchars($_SESSION['role']); ?></p>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- FORM INPUT MANUAL -->
    <div class="input-box">
        <h3>Input Barang</h3>

        <form method="POST">
            <label>Kode Barang</label>
            <select id="kode" name="kode" required>
                <option value="" disabled selected>Pilih Kode Barang</option>
                <?php foreach ($dataBarang as $kode => $b): ?>
                    <option value="<?= $kode ?>"><?= $kode ?> - <?= $b['nama'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Nama Barang</label>
            <input id="nama" type="text" name="nama" required readonly>

            <label>Harga Barang</label>
            <input id="harga" type="number" name="harga" required readonly>

            <label>Jumlah</label>
            <input type="number" name="jumlah" required>

            <button class="btn-blue" name="tambah">Tambahkan</button>
            <button class="btn-red" name="reset">Kosongkan Keranjang</button>
        </form>
    </div>

    <!-- TABEL KERANJANG -->
    <h3>Keranjang Belanja</h3>

    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>

        <?php foreach ($_SESSION['keranjang'] as $item): ?>
        <tr>
            <td><?= $item['kode'] ?></td>
            <td><?= $item['nama'] ?></td>
            <td>Rp <?= number_format($item['harga'],0,',','.') ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td>Rp <?= number_format($item['total'],0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>

        <!-- TOTAL BELANJA -->
        <tr style="background:rgba(255,255,255,0.2);font-weight:bold;">
            <td colspan="4">Total Belanja</td>
            <td>Rp <?= number_format($totalBelanja,0,',','.') ?></td>
        </tr>

        <!-- DISKON -->
        <tr style="background:rgba(255,255,255,0.2);font-weight:bold;">
            <td colspan="4">Diskon (<?= $diskonPersen ?>%)</td>
            <td>Rp <?= number_format($diskon,0,',','.') ?></td>
        </tr>

        <!-- TOTAL BAYAR -->
        <tr style="background:rgba(255,255,255,0.2);font-weight:bold;">
            <td colspan="4">Total Bayar</td>
            <td>Rp <?= number_format($totalBayar,0,',','.') ?></td>
        </tr>
    </table>
    <div class="footer">© <?= date("Y"); ?> SKY MART • Dashboard Modern</div>
<script>
    const barangData = <?= json_encode($dataBarang); ?>;

    const kodeSelect = document.getElementById("kode");
    const namaInput = document.getElementById("nama");
    const hargaInput = document.getElementById("harga");

    kodeSelect.addEventListener("change", function () {
        let kode = this.value;

        if (barangData[kode]) {
            namaInput.value = barangData[kode].nama;
            hargaInput.value = barangData[kode].harga;
        } else {
            namaInput.value = "";
            hargaInput.value = "";
        }
    });
</script>
</div>
</body>
</html>
