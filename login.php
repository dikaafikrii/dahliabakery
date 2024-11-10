<?php
session_start();
$error = '';

// Cek jika pengguna sudah login, maka alihkan ke halaman dashboard
if(isset($_SESSION['username'])){
  header("location: dashboard.php");
}

// Proses form login
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Koneksi ke database (ganti dengan informasi koneksi sesuai dengan database Anda)
  $db = new mysqli('localhost', 'root', '123', 'dahliabakery');

  // Query untuk mencari pengguna berdasarkan username dan password
  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $db->query($query);

  // Jika hasil query menghasilkan satu baris, maka login berhasil
  if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    header("location: dashboard.php");
  } else {
    $error = "Username or password is incorrect";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Dahlia Bakery</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.jpeg" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.jpeg" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						LOGIN
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>
					<div class="container-login100-form-btn">
						<p ><a href="index.php">Kembali</a></p>
					</div>
					<div class="text-center p-t-136">
				
					</div>
					<p class="error"><?php echo $error; ?></p>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>


</html>