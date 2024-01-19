<?php
require 'functions.php';
if (isset($_GET["id"])) {
    $sid = $_GET["id"];
    $dataobat = query("SELECT * FROM obat WHERE id = $sid")[0];
}

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href='index.php'
              </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan');
            document.location.href='index.php'
          </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: grid;
            place-items: center;
            background: grey;
            height: 100vh;
        }
        .container {
  max-width: 350px;
  background: #f8f9fd;
  background: linear-gradient(
    0deg,
    rgb(255, 255, 255) 0%,
    rgb(244, 247, 251) 100%
  );
  border-radius: 40px;
  padding: 25px 35px;
  border: 5px solid rgb(255, 255, 255);
  box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
  margin: 20px;
}

.heading {
  text-align: center;
  font-weight: 900;
  font-size: 30px;
  color: rgb(16, 137, 211);
}

.form {
  margin-top: 20px;
}

.form .input {
  width: 90%;
  background: white;
  border: none;
  padding: 15px 20px;
  border-radius: 20px;
  margin-top: 15px;
  box-shadow: #cff0ff 0px 10px 10px -5px;
  border-inline: 2px solid transparent;
}

.form .input::-moz-placeholder {
  color: rgb(170, 170, 170);
}

.form .input::placeholder {
  color: rgb(170, 170, 170);
}

.form .input:focus {
  outline: none;
  border-inline: 2px solid #12b1d1;
}

.form .forgot-password {
  display: block;
  margin-top: 10px;
  margin-left: 10px;
}

.form .forgot-password a {
  font-size: 11px;
  color: #0099ff;
  text-decoration: none;
}

.form .login-button {
  display: block;
  width: 100%;
  font-weight: bold;
  background: linear-gradient(
    45deg,
    rgb(16, 137, 211) 0%,
    rgb(18, 177, 209) 100%
  );
  color: white;
  padding-block: 15px;
  margin: 20px auto;
  border-radius: 20px;
  box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
  border: none;
  transition: all 0.2s ease-in-out;
}

.form .login-button:hover {
  transform: scale(1.03);
  box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
}

.form .login-button:active {
  transform: scale(0.95);
  box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
}



.agreement {
  display: block;
  text-align: center;
  margin-top: 15px;
}

.agreement a {
  text-decoration: none;
  color: #0099ff;
  font-size: 20px;
}

</style>

</head>

<body>
    
<div class="container">
  
  <div class="heading">Tambah Data Obat</div>
  <form class="form" action="" method="POST" enctype="multipart/form-data" autocomplite="false">
  <input type="hidden" name="id" required >

  <input type="text" name="nama_obat" placeholder="Nama Obat" class="input"id="" required>

  <input type="text" name="harga" placeholder="Harga" class="input"id="" required>

  <input type="text" name="stok" placeholder="Stok" class="input"id="" required>

  <input type="file" name="gambar" placeholder="Gambar" class="input"id="" required>
 
  <input type="text" name="detail" placeholder="Detail" class="input"id="" required>
   
    <button value="Tambah Data" type="submit" class="login-button"   name="submit">Tambah Data</button>
    <button value="Kembali" type="submit" class="login-button"   name="submit"><a href="index.php" style="text-decoration: none; color: white;">Kembali</a></button>
    
  </form>
  
</div>
</body>

</html>