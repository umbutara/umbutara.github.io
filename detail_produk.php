<?php
    session_start();

    if (!isset($_SESSION['login'])) {
       header('Location: login.php');
       exit();
    }

    require 'koneksi.php';

    $namaObat = htmlspecialchars($_GET['nama_obat']);
    $queryPro = mysqli_query($conn, "SELECT * FROM obat WHERE  nama_obat = '$namaObat'");
    $produk = mysqli_fetch_array($queryPro);
   
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
        require'navbar.php';
    ?>


    <div class="container-fluid py-5 mt-5" > 
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                <img src="images/<?php echo $produk['gambar'];?>" class="card-img-top" alt="...">
                </div>
                <div class="col-md-6 offsed-md-1">
                    <h1><?php echo $produk['nama_obat'];?></h1>
                    <p class="fs-5">
                    <?php echo $produk['detail'];?>
                    </p>
                    <p class="fs-3 text-harga">
                        Rp. 
                    <?php echo $produk['harga'] . '.000';?>

                    </p>
                    <p class="fs-4 ">
                        Stok: <?php echo $produk['stok'];?>
                    </p>
                    <a href="keranjang.php?nama_obat=<?php
                         echo $produk['nama_obat'];
                      ?>" class="btn btn-outline-warning">Tambah Ke keranjang</a>

                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php
        require'footers.php';
    ?>
    <!-- Footer End -->



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>    
</body>
</html>