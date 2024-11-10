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

// ID roti yang akan dijual
if(isset($_POST['id_roti']) && isset($_POST['jumlah_terjual'])) {
    $id_roti = $_POST['id_roti'];
    $jumlah_terjual = $_POST['jumlah_terjual'];

    // Ambil harga dan stok roti dari database
    $query = "SELECT harga_roti, stok_roti FROM daftar_roti WHERE id = $id_roti";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $harga = $row['harga_roti'];
    $stok = $row['stok_roti'];

    // Kurangi stok roti
    $stok_baru = $stok - $jumlah_terjual;
    if ($stok_baru < 0) {
        echo "Stok roti tidak mencukupi!";
        exit();
    }

    // Hitung pendapatan
    $pendapatan = $harga * $jumlah_terjual;

    // Update stok roti di database
    $query_update = "UPDATE daftar_roti SET stok_roti = $stok_baru WHERE id = $id_roti";
    mysqli_query($conn, $query_update);

    // Mendapatkan tanggal sekarang
    $tanggal_penjualan = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');

    // Cek apakah tanggal penjualan sudah ada dalam tabel
    $query_check_date = "SELECT * FROM roti WHERE tanggal = '$tanggal_penjualan'";
    $result_check_date = mysqli_query($conn, $query_check_date);

    if(mysqli_num_rows($result_check_date) > 0) {
        // Jika tanggal sudah ada, update pendapatan untuk tanggal tersebut
        $query_update_pendapatan = "UPDATE roti SET pendapatan = pendapatan + $pendapatan WHERE tanggal = '$tanggal_penjualan'";
        mysqli_query($conn, $query_update_pendapatan);
    } else {
        // Jika tanggal belum ada, tambahkan entri baru untuk tanggal tersebut
        $query_insert_pendapatan = "INSERT INTO roti (tanggal, pendapatan) VALUES ('$tanggal_penjualan', $pendapatan)";
        mysqli_query($conn, $query_insert_pendapatan);
    }

    // Tampilkan pendapatan
    echo "Pendapatan dari penjualan roti: $pendapatan";
} else {
    echo "ID roti atau jumlah terjual tidak ditemukan dalam permintaan POST.";
}

// Menutup koneksi
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpeg" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/dashboard.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Selamat Datang!</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpeg" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dashboard.php">PROFIL</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dashboard_input.php">INPUT DATA</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dashboard_laporan_harian.php">LAPORAN PENJUALAN HARIAN</a></li>
                
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dashboard_stok_roti.php">LAPORAN STOK ROTI</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger">
                            <form action="" method="post">
                            <button type="submit" class="btn btn-primary" name="logout">Logout</button>
                            </form>
                    </a></li>
                </ul>
                </ul>
            </div>
        </nav>

            <!-- Input data-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">Input Data</h2>
        <form action="dashboard_input.php" method="post"> 
            <div class="mb-3">
                <label for="nama" class="form-label">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">ID:</label>
                <input type="number" class="form-control" id="id_roti" name="id_roti">
            </div>

            <div class="mb-3">

            <label for="username" class="form-label">Jenis Roti:</label>
            <select name="cars" class="form-control" id="cars">
                <option value="roti_tawar">Roti Tawar</option>
                <option value="roti_sobek">Roti Sobek</option>
                <option value="tart_mini">Tart Mini</option>
                <option value="bolu_cake">Bolu & Cake</option>
                <option value="roti_kecil">Roti Kecil</option>
                <option value="selai_mini">Selai Mini</option>
            </select>

            </div>

            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah_terjual" name="jumlah_terjual">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
            <hr class="m-0" />

           
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
