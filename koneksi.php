<?php

    $conn = mysqli_connect("localhost","root","","db_apotik");

    if (mysqli_connect_errno()) {
        echo("Tidak bisa konek ke database". mysqli_connect_error());
        exit(1);
    }


    function registrasi($data){
        global $conn;

        $username = strtolower(stripcslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $email = mysqli_real_escape_string($conn, $data["email"]);

        $result= mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' OR email = '$email' ");


        if (mysqli_fetch_row($result)) {
            echo"
            <script> 
                alert('Username atau password sudah ada');
            </script>
            ";
            return false;
        }

        if($password !== $password2){
            echo"
            <script> 
                alert('Password tidak sesuai');
            </script>
            ";
            return false;
        } 

        $password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn,"INSERT INTO users VALUES('', '$username', '$password', '$email')");


        return mysqli_affected_rows($conn);


    }
?>