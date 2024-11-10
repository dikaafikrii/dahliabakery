<?php
session_start();

// Periksa jika pengguna sudah login
if(!isset($_SESSION['username'])){
  // Jika belum login, alihkan ke halaman login
  header("location: login.php");
  exit();
}

// Proses logout
if(isset($_POST['logout'])) {
  // Hapus semua data sesi
  session_destroy();
  // Alihkan kembali ke halaman login
  header("location: login.php");
  exit();
}

// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "dahliabakery";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$jumlahTerjual = $_POST['jumlah_terjual'];
$jenisRoti = $_POST['jenis_roti'];
$hargaRoti = $_POST['harga_roti'];
$total = $_POST['total'];

// Query SQL untuk menambahkan data
$sql = "INSERT INTO penjualan_roti (jumlah_terjual, jenis_roti) VALUES ('$jumlahTerjual', '$jenisRoti')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Update Data</h2>
    <form action="dashboard2.php" method="post">
        Jumlah Terjual: <input type="number" name="jumlah_terjual"><br>
        Jenis Roti: <input type="text" name="jenis_roti"><br>
        <input type="submit" value="Update Data">
    </form>


          <form action="" method="post">
            <button type="submit" name="logout">Logout</button>
          </form>

</body>
</html>