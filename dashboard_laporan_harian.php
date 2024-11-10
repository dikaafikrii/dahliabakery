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
        <style>
            /* CSS untuk menyembunyikan elemen saat dicetak */
            @media print {
                /* Semua elemen form */
                form {
                    display: none;
                }

                /* Tombol cetak */
                #btnPrint {
                    display: none;
                }
                .pesan {
                    display: none;
                }

                span {
                    display: none;
                }

            }

        </style>
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

            <!-- Laporan pemasukan-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">LAPORAN PEMASUKAN HARIAN</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pemasukan</th>
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

                                    // Query untuk mendapatkan data tanggal dan pendapatan
                                    $query = "SELECT tanggal, pendapatan FROM roti ORDER BY tanggal DESC";
                                    $result = $conn->query($query);

                                    // Memeriksa apakah ada data yang ditemukan
                                    if ($result->num_rows > 0) {


                                        // Menampilkan data dalam baris tabel
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $row["tanggal"] . "</td>
                                                    <td>" . $row["pendapatan"] . "</td>
                                                </tr>";
                                        }

                                        echo "</table>";
                                    } else {
                                        echo "Tidak ada data yang ditemukan.";
                                    }

                                    // Mengambil tanggal dari formulir jika tersedia
                                    $tanggal_penjualan = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');

                                    // Mengambil jumlah pemasukan dari formulir
                                    $pendapatan = isset($_POST['pendapatan']) ? $_POST['pendapatan'] : 0;

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

                                    // Cek apakah tanggal penjualan sudah ada dalam tabel
                                    $query_check_date = "SELECT * FROM roti WHERE tanggal = '$tanggal_penjualan'";
                                    $result_check_date = mysqli_query($conn, $query_check_date);

                                    if(mysqli_num_rows($result_check_date) > 0) {
                                        // Jika tanggal sudah ada, update pendapatan untuk tanggal tersebut
                                        $query_update_pendapatan = "UPDATE roti SET pendapatan = '$pendapatan' WHERE tanggal = '$tanggal_penjualan'";
                                        mysqli_query($conn, $query_update_pendapatan);
                                    } else {
                                        echo '<div class="pesan">Tanggal tidak ada!</div>';
                                    }

                                    // Cek apakah ada permintaan untuk menghapus data
                                    if (isset($_POST['hapus_data'])) {
                                        // Mengambil tanggal yang akan dihapus dari formulir
                                        $tanggal_hapus = $_POST['tanggal_hapus'];

                                        // Query untuk menghapus data penjualan berdasarkan tanggal
                                        $query_delete = "DELETE FROM roti WHERE tanggal = '$tanggal_hapus'";
                                        if (mysqli_query($conn, $query_delete)) {
                                            echo "Data penjualan untuk tanggal $tanggal_hapus berhasil dihapus.";
                                        } else {
                                            echo "Gagal menghapus data penjualan.";
                                        }
                                    }


                                    // Menutup koneksi
                                    $conn->close();

                                    ?>
                        </table>
                    </div>
                    <form action="dashboard_laporan_harian.php" method="post">
                        <label for="tanggal" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"><br>
                        Jumlah Pemasukan: <input type="number" class="form-control" name="pendapatan"><br>
                        <input type="submit" class="btn btn-success" value="Update Pemasukan">
                        <button type="button" class="btn btn-primary" id="btnPrint">Print</button>
                    </form>
                    <br>
                    <br>
                    <form action="dashboard_laporan_harian.php" method="post">
                        <label for="tanggal_hapus" class="form-label">Tanggal yang akan dihapus:</label>
                        <input type="date" class="form-control" id="tanggal_hapus" name="tanggal_hapus"><br>
                        <input type="submit" class="btn btn-danger" name="hapus_data" value="Hapus Data">
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

<script>
    document.getElementById("btnPrint").addEventListener("click", function() {
        window.print();
    });
</script>
