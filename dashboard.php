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
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        Selamat Datang!
                        <span class="text-primary"></span>
                    </h1>
                    <div class="subheading mb-5">
                        Dahlia Bakery
                        <a href="mailto:name@email.com"></a>

                
                    </div>
                    <p class="lead mb-5">Informasi Profil:</p>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nama</h5>
                    <p class="card-text">Dahlia Bakery</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Username</h5>
                    <p class="card-text">dahliabakery</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nomor Telepon</h5>
                    <p class="card-text">081234567890</p>
                </div>
            </div>
                    </div>
                    
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
