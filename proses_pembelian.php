<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil total harga dari formulir
    $totalHarga = $_POST['total_harga'];

    // Lakukan proses pembelian sesuai kebutuhan Anda

    // Contoh: Menampilkan pesan sukses
    echo '<script>alert("Pembelian berhasil. Total yang harus dibayar: Rp.' . number_format($totalHarga) . '.000");</script>';
    echo '<script>window.location.href = "index.php";</script>';
} else {
    // Jika bukan metode POST, kembalikan ke halaman sebelumnya
    header('location: keranjang.php');
    exit();
}
?>
