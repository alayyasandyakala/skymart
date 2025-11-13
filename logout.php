<?php
session_start();

//HApus Semua Session
session_unset();
session_destroy();

//Kembali Ke Halaman Login
header("Location: index.php");
exit;
