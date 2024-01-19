<?php

require 'functions.php';
if (!empty($_SESSION['id'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $usernameemail = $_POST['usernameemail'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username  = '$usernameemail' OR email = '$usernameemail'");

    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {

        if ($password == $row['password']) {
            $hashed_password = $row['password'];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            header("location: index.php");
        } else {
            echo "<script> 
        alert('Password salah');
    </script>";
        }
    } else {
        echo "<script> 
    alert('Akun tidak ditemukan');
</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Login</title>
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
  
  <div class="heading">Login Admin</div>
  <form class="form" action="" method="post">
    <input
      placeholder="E-mail Atau Username"
      id="usernameemail"
      name="usernameemail"
      type="text"
      class="input"
      required=""
    />
    <input
      placeholder="Password"
      id="password"
      name="password"
      type="password"
      class="input"
      required=""
    />
    <input value="Sign In" type="submit" class="login-button"   name="submit"/>
  </form>
  
  <span class="agreement">Belum punya akun?<a href="registrasi.php">Buat Akun</a></span>
</div>
</body>

</html>