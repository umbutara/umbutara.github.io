<?php
    require 'koneksi.php';
    $queryProduk = mysqli_query($conn,'SELECT id, nama_obat, harga, stok, gambar, detail FROM obat ');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Vision || produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php
        require 'navbar.php';
    ?>
    <div class="container-fluid banner-produk d-flex align-items-center ">
        <div class="container">
            <h2 class="text-white text-center">Obat-Obatan</h2>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
      <div class="container text-center">
        <h3>Jenis-Jenis Obat</h3>
          <div class="row mt-5">
              <?php while($data = mysqli_fetch_array($queryProduk)) {?>
              <div class="col-md-3 mb-3">
                <div class="card" >
                    <div class="image-box">
                    <img src="images/<?php echo $data['gambar']?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                      <h4 class="card-title"><?php echo $data['nama_obat']?></h4>
                      <div class="d-flex justify-content-between ">
                      <p class="card-text text-harga ">Rp. <?php echo $data['harga'] . ".000"?></p>
                      <p class="card-text text-harga">Stok:  <?php echo $data['stok']?></p>
                      </div>
                      <p class="card-text text-truncate"><?php echo $data['detail']?></p>
                      
                      <a href="detail_produk.php?nama_obat=<?php
                         echo $data['nama_obat'];
                      ?>" class="btn btn-info">Lihat Detail</a>
                    </div>
                  </div>

              </div>
              <?php } ?>
          </div>
      </div>
    </div>
    <!-- Produk end -->
 <!-- Footer -->
 <?php
        require'footers.php';
    ?>
    <!-- Footer End -->



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script> 
</body>
</html>