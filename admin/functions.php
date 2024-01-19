<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "db_apotik");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $conn;
    $namaobat = $data['nama_obat'];
    $harga = $data['harga'];
    $stok = $data['stok'];
   
    $deskripsi = $data['detail'];
    
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO obat
                VALUES
                ('', '$namaobat', '$harga', '$stok', '$gambar', '$deskripsi')
    
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    if($error == 4){
        echo "
        <script>
         alert('Upload Gambar dulu!');
        </script>
        ";

        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
        <script>
         alert('Upload Gambar dulu!');
        </script>
        ";
        return false;

    }

    if($ukuranFile > 2000000){
        echo "
        <script>
         alert('Ukuran Gambar terlalu besar');
        </script>
        ";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../images/' . $namaFileBaru);

    return $namaFileBaru;


}


function ubah($data)
{
    global $conn;
    
    $id = $data["id"];
    $namaobat = htmlspecialchars($data["nama_obat"]);
    $hargaobat = htmlspecialchars($data["harga"]);
    $stokobat = htmlspecialchars($data["stok"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);
    if($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else{
        $gambar = upload();
    }


    $detail = isset($data["detail"]) ? htmlspecialchars($data["detail"]) : '';
    
    $query2 = "UPDATE obat SET
        nama_obat = ?, 
        harga = ?, 
        stok = ?, 
        gambar = ?,
        detail = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query2);
    
    if (!$stmt) {
        die('Error in mysqli_prepare: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $namaobat, $hargaobat, $stokobat, $gambar, $detail, $id);//Dalam hal ini, "sssssi" berarti bahwa enam parameter diikat dengan urutan tipe data: string, string, string, string, string, dan integer. Ini membantu mencegah serangan SQL injection.
    mysqli_stmt_execute($stmt);//Fungsi ini digunakan untuk mengeksekusi prepared statement setelah parameter diikat.

    $affected_rows = mysqli_stmt_affected_rows($stmt);//Fungsi ini mengembalikan jumlah baris yang terpengaruh oleh eksekusi prepared statement.

    mysqli_stmt_close($stmt);//Fungsi ini mengembalikan jumlah baris yang terpengaruh sebagai hasil eksekusi fungsi ubah()

    return $affected_rows;
}
