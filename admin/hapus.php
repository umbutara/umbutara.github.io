<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_apotik"); // Ganti "nama_database" dengan nama database yang sesuai

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']); // Mencegah SQL Injection
    $query = "DELETE FROM obat WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            document.location.href = 'index.php';
        </script>";
    }
}

mysqli_close($koneksi);
