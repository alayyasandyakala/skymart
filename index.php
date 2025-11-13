<?php
session_start();
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'Karala' && $password === '1234') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'CEO';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah, silahkan coba lagi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>POLGAN MART</title>
    <style>
        /* =======================================================
           CSS – Desain Modern dengan Gradasi & Glassmorphism
        ======================================================= */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .login-container, .dashboard-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            color: black;
            text-align: center;
        }

        .login-container {
            width: 400px;
        }

        .dashboard-container {
            width: 85%;
            max-width: 950px;
        }

        h2 {
            text-align: center;
            color: black;
            letter-spacing: 1px;
        }

        input[type="text"], input[type="password"], input[type="number"] {
            width: 80%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background: rgba(255,255,255,0.2);
            color: black;
            transition: 0.3s;
        }

        input::placeholder {
            color: #eee;
        }

        input:focus {
            background: rgba(255,255,255,0.35);
        }

        button {
            background: linear-gradient(135deg, #56ccf2, #2f80ed);
            color: black;
            padding: 12px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
            margin-top: 5px;
        }

        button:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #2f80ed, #56ccf2);
        }

        .error {
            color: #ff4d4d;
            margin-top: 10px;
            font-weight: bold;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255,255,255,0.2);
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff5f6d, #ffc371);
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            text-align: center;
        }

        th {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        tr:hover {
            background: rgba(255,255,255,0.1);
        }

        tfoot td {
            background: rgba(0,0,0,0.2);
            font-weight: bold;
        }

        .payment-section {
            text-align: center;
            margin-top: 20px;
        }

        .result-box {
            background: rgba(46, 204, 113, 0.3);
            border: 1px solid rgba(39,174,96,0.6);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            text-align: center;
        }

        .user-info span {
            font-weight: bold;
            color: black;
        }

        .fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
     <div class="login-container fade-in">
    <h2>LOGIN SKY MART</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
         <button type="submit" name="Cancel">Cancel</button>
           <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
    </form>
</div>
    </body>
    </html>
