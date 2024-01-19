<?php

require 'functions.php';


$obat = mysqli_query($conn, 'SELECT * FROM obat');
$jumlah = mysqli_num_rows($obat);
$users = mysqli_query($conn, 'SELECT * FROM users');

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");

    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Apotik Kimia Farma || Admin</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/hero-bg.jpg" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    

</head>

<body>
    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">
            <div class="profile">
                <img src="../assets/img/images.jpg" alt="" class="img-fluid rounded-circle" />
                <h1 class="text-light">Administrator <a href="logout.php" ><i class='bx bx-log-out-circle' style="font-size: 30px"></i></a></h1>               
                
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li>
                        <a href="#home" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Daftar Obat</span></a>
                    </li>
                    <li>
                        <a href="#about" class="nav-link scrollto"><i class='bx bxs-bar-chart-alt-2'></i> <span>Ketersediaan</span></a>
                    </li>
                    
                    
                    
                    <li>
                        <a href="#contact" class="nav-link scrollto"><i class='bx bxs-user-detail' ></i> <span>Data pengguna</span></a>
                    </li>
                </ul>
            </nav>
            <!-- .nav-menu -->
        </div>
    </header>
    <!-- End Header -->

   

    <main id="main" style="margin-left:23%;">
        
        <!-- ======= About Section ======= -->
        <section  id="home" class="about">
            <div class="container">
                <div class="section-title">
                    <h2>Daftar Obat</h2>
                    
                    <a href="tambahdata.php" class="btn btn-success">Tambah Data Obat <i class='bx bx-plus' style="font-size: 20px;"></i></a>

                </div>

                <div class="row">
                    <div class="table-nowrap  " >
                        <table class="table table-wrap overflow-scroll ">
                            <thead class="table-success p-2">
                                <tr >
                                    <th>NO</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th align="center">Aksi</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tambah = 1;
                                ?>
                                <?php foreach ($obat as $row) : ?>
                                <tr text-align="center">
                                
                                <th  ><?php echo $tambah; ?></th>
                                <td><?php echo $row["nama_obat"]; ?></td>
                                <td><?php echo $row["harga"] . ".000"; ?></td>
                                <td><?php echo $row["stok"]; ?></td>
                                <td align="center"><button class="btn btn-info p-text"> <a href="update.php?id=<?php echo $row["id"] ?>" style="color:white; font-size: 18px;">Edit<i class='bx bx-edit'></i></a> </button>
                                <button class="btn btn-danger"><a href="hapus.php?id=<?php echo $row["id"] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?');" style="color:white; font-size: 18px;">Hapus<i class='bx bx-trash'></i></a></button>
                                    
                                </td>
                                
                                
                                </tr>
                                <?php
                                    $tambah++;
                                ?>
                                <?php endforeach  ?>
                            <tbody>
                        </table>
                        </div>
                    </div>
             </div>
        </section>
        <section  id="about" class="about">
            <div class="container">
                <div class="section-title">
                    <h2>Ketersediaan </h2>
                    <div class="shadow-sm p-3 mb-5  rounded  bg-warning-subtle text-emphasis-warning " style="width: 50%;">Jumlah Ketersediaan: <?php echo $jumlah; ?></div>
                    

                </div>

                <div class="row-success">
                    
                    </div>
                    
                   
                    
                   
            </div>
            </div>
        </section>
        
        

       

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Data Pengunjung</h2>
                    <div class="table-nowrap  " >
                        <table class="table table-wrap overflow-scroll ">
                            <thead class="table-success p-2">
                                <tr >
                                    <th>NO</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    
                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tambah = 1;
                                ?>
                                <?php foreach ($users as $user) : ?>
                                <tr text-align="center">
                                
                                <th  ><?php echo $tambah; ?></th>
                                <td><?php echo $user["username"]; ?></td>
                                <td><?php echo $user["email"]; ?></td>
                                
                                </td>
                                
                                
                                </tr>
                                <?php
                                    $tambah++;
                                ?>
                                <?php endforeach  ?>
                            <tbody>
                        </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>K-Vision</span></strong>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
                Designed by <a href="https://bootstrapmade.com/">Kelompok 1 Pengembangan WEB Kelas C</a>
            </div>
        </div>
    </footer>
    <!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/typed.js/typed.umd.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>