<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | POLGAN MART</title>
<style>
    /* 🌸 Desain Modern Dashboard POLGAN MART */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #e4ebf5);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
    }

    .dashboard {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 380px;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .dashboard:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    h2 {
        color: #222;
        font-weight: 600;
        margin-bottom: 10px;
    }

    p {
        margin: 8px 0;
        font-size: 15px;
    }

    .role-box {
        display: inline-block;
        background: #eaf8ff;
        color: #007bff;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 20px;
        margin-top: 5px;
    }

    a.logout-btn {
        display: inline-block;
        margin-top: 25px;
        background: linear-gradient(135deg, #ff6b6b, #d9534f);
        color: white;
        text-decoration: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease-in-out;
    }

    a.logout-btn:hover {
        background: linear-gradient(135deg, #ff4b4b, #c9302c);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(255, 107, 107, 0.3);
    }

    .footer {
        margin-top: 30px;
        font-size: 13px;
        color: #888;
    }

    .emoji {
        font-size: 35px;
        margin-bottom: 10px;
        animation: float 2s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
</style>
</head>
<body>

<div class="dashboard">
    <div class="emoji">👋</div>
    <h2>Selamat Datang, <span style="color:#007bff;"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</h2>
    <p>Anda login sebagai:</p>
    <div class="role-box"><?php echo htmlspecialchars($_SESSION['role']); ?></div>

    <br>
    <a href="logout.php" class="logout-btn">Logout</a>

    <div class="footer">
        © <?php echo date("Y"); ?> SKY MART • Dashboard Modern
    </div>
</div>

</body>
</html>
