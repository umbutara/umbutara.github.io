<?php
session_start();

if (!isset($_SESSION['login'])) {
   header('Location: login.php');
   exit();
}
require 'koneksi.php';

session_start();

if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}

// Periksa apakah parameter nama_obat ada di URL
if (isset($_GET['nama_obat'])) {
    // Ambil nama_obat dari URL
    $namaObat = htmlspecialchars($_GET['nama_obat']);

    // Query untuk mendapatkan detail produk berdasarkan nama_obat
    $queryPro = mysqli_query($conn, "SELECT * FROM obat WHERE nama_obat = '$namaObat'");

    // Periksa apakah query berhasil
    if (!$queryPro) {
        echo '<script>alert("Gagal melakukan query: ' . mysqli_error($conn) . '");</script>';
    } else {
        // Periksa apakah ada hasil yang diberikan
        $produk = mysqli_fetch_array($queryPro);

        if ($produk) {
            // Check if the product is already in the cart
            $checkCart = mysqli_query($conn, "SELECT * FROM cart WHERE nama_obat = '$produk[nama_obat]'");
            $existingItem = mysqli_fetch_assoc($checkCart);

            if ($existingItem) {
                // Update qty and total_harga if the item already exists in the cart
                $newQty = $existingItem['qty'] + 1;
                $newTotalHarga = $existingItem['harga'] * $newQty;

                $updateCart = mysqli_query($conn, "UPDATE cart SET qty = $newQty, total_harga = $newTotalHarga WHERE id = $existingItem[id]");

                if ($updateCart) {
                    // Redirect to keranjang.php after successful update
                    header('location: keranjang.php');
                    exit(); // Stop further execution
                } else {
                    echo '<script>alert("Gagal update keranjang: ' . mysqli_error($conn) . '");</script>';
                }
            } else {
                // Insert new item if it doesn't exist in the cart
                $insertToCart = mysqli_query($conn, "INSERT INTO cart (nama_obat, harga, qty, total_harga) VALUES ('$produk[nama_obat]', '$produk[harga]', 1, '$produk[harga]')");

                if ($insertToCart) {
                    // Redirect to keranjang.php after successful insertion
                    header('location: keranjang.php');
                    exit(); // Stop further execution
                } else {
                    echo '<script>alert("Gagal menambahkan barang ke keranjang: ' . mysqli_error($conn) . '");</script>';
                }
            }
        } else {
            echo '<script>alert("Produk tidak ditemukan.");</script>';
        }
    }
} else {
  // Stop further execution
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Vison || Detail</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php
require 'navbar.php';

// Query untuk mendapatkan semua item dari tabel cart
$queryCart = mysqli_query($conn, "SELECT * FROM cart");

// Periksa apakah query berhasil
if ($queryCart && mysqli_num_rows($queryCart) > 0) {
    $no = 1;
    $totalBelanja = 0; // Inisialisasi total belanja

    // Tampilkan tabel keranjang
    ?>
    <div class="container-fluid py-5 mt-5">
        <div class="container">
            <h2>Keranjang Belanja</h2>
            <div class="table-responsive">
                <table class="table table-success table-striped">
                    <!-- Struktur tabel -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($cartItem = mysqli_fetch_assoc($queryCart)) {
                            // Tampilkan data dari tabel cart
                            echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td>' . $cartItem['nama_obat'] . '</td>';
                            echo '<td>Rp.' . number_format($cartItem['harga'] ) . '.000</td>';
                            echo '<td>' . $cartItem['qty'] . '</td>';
                            echo '<td>Rp.' . number_format($cartItem['harga'] * $cartItem['qty']) . '.000</td>';
                           
                           
                            echo '<td><a href="hapus.php?id=' . $cartItem['id'] . '" class="btn btn-danger btn-sm">Hapus</a></td>';
                                
                            

                            // Akumulasi total belanja
                            $totalBelanja += ($cartItem['harga'] * $cartItem['qty']);
                            $no++;

                            
                        }
                        ?>
                    </tbody>
                </table>
                
                <!-- Tampilkan total belanja di atas formulir pembayaran -->
                <h4>Total Belanja: Rp. <?php echo number_format($totalBelanja) ?>.000</h4>

                <!-- Form untuk pembayaran -->
                <form action="generate_pdf.php" method="post">
                    <input type="hidden" name="total_belanja" value="<?php echo $totalBelanja; ?>">
                    <label for="jumlah_bayar">Jumlah Bayar (Rp):</label>
                    <input type="number" name="jumlah_bayar" required>
                    <br>
                    <button type="submit" class="btn btn-primary mt-3">Bayar</button>
                </form>
            </div>
        </div>
    </div>
    <?php
} else {
    // Tampilkan pesan jika keranjang kosong
    echo '<div class="container-fluid py-5 mt-5">';
    echo '<div class="container">';
    echo '<div class="alert alert-warning" role="alert">';
    echo '<h5 class="alert-heading">Keranjang Belanja Kosong!</h5>';
    echo '<p>Silakan tambahkan produk ke keranjang belanja Anda.</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>