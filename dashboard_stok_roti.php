<?php
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

            <!-- LaporanStokRoti-->
            <section class="resume-section" id="interests">
                <div class="resume-section-content">
                    <h2 class="mb-5">LAPORAN STOK ROTI</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jenis Roti</th>
                                <th>Harga Roti</th>
                                <th>Stok Roti</th>
                            </tr>
                            <?php
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

                            // Query SQL untuk mengambil data
                            $sql = "SELECT id, jenis_roti, harga_roti, stok_roti FROM daftar_roti";
                            $result = $conn->query($sql);

                            // Memeriksa apakah query berhasil dieksekusi
                            if ($result->num_rows > 0) {
                                // Menampilkan data dalam bentuk baris tabel HTML
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["jenis_roti"]."</td>";
                                    echo "<td>".$row["harga_roti"]."</td>";
                                    echo "<td>".$row["stok_roti"]."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Tidak ada data yang ditemukan</td></tr>";
                            }

                            // Mendapatkan data dari form
                            if(isset($_POST['id'])) {
                                $id = $_POST['id'];
                                $stok = $_POST['stok_roti'];
                            
                            // Query SQL untuk melakukan update stok roti
                            $sql = "UPDATE daftar_roti SET stok_roti='$stok' WHERE id=$id";
                            }

                            if ($conn->query($sql) == TRUE) {
                                echo "Stok roti berhasil diperbarui";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            // Menutup koneksi
                            $conn->close();
                            ?>
   
                        </table>

                        <form action="dashboard_stok_roti.php" method="post">
                            <label for="id" class="form-label">ID Roti:</label>
                            <input type="number" class="form-control" name="id"><br>
                            Stok Baru: <input type="number" class="form-control" name="stok_roti"><br>
                            <input type="submit" class="btn btn-primary" value="Update Stok Roti">
                        </form>
            </section>
            <hr class="m-0" />
            
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
