<?php
ob_start(); // Mulai output buffering

// Hancurkan sesi
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// Arahkan ke halaman login
header("location: login.php");

ob_end_flush(); // Akhiri output buffering
?>
