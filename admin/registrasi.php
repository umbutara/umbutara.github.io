<?php
require 'functions.php';

if (!empty($_SESSION['id'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['password2']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $duplikat = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' OR email = '$email'");

    if (mysqli_num_rows($duplikat) > 0) {
        echo "<script> 
            alert('Akun telah tersedia!');
        </script>";
    } else {
        if ($password == $confirmpassword) {
            // Menggunakan password_hash untuk mengamankan kata sandi

            $query1 = "INSERT INTO admin VALUES ('', '$username', '$password', '$email')";


            mysqli_query($conn, $query1);
            echo  "<script> 
            alert('Akun berhasil dibuat!');
             </script>";
        } else {
            echo  "<script> 
            alert('Gagal membuat akun. Error: " . mysqli_error($conn) . "');
        </script>";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || login</title>
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
  
  <div class="heading">Register Admin</div>
  <form class="form" action="registrasi.php" method="post">
  <input placeholder="Masuka Username" type="text" name="username" id="username" class="input">

    <input
      placeholder="Password"
      id="password"
      name="password"
      type="password"
      class="input"
      required=""
    />
    <input   placeholder="Konfirmasi Password" type="password" name="password2" id="password2" class="input">
    <input placeholder="Email"type="email" name="email" id="email" class="input">


    <input value="Sign In" type="submit" class="login-button"   name="submit"/>
  </form>
  
  <span class="agreement">Sudah punya akun?<a href="login.php">Login</a></span>
</div>
    <!-- <h1>Halaman Registrasi</h1>
    <form action="registrasi.php" method="POST">
        <ul>
            <li>
                <label for="username">username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">konfirmasi password</label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <label for="email">email</label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <button type="submit" name="submit">Register</button>
            </li>
            <a href="login.php">Login</a>
        </ul>
    </form> -->
</body>

</html>