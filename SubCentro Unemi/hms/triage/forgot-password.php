<?php
session_start();
error_reporting(0);
include("include/config.php");

// Checking Details for reset password
if (isset($_POST['submit'])) {
    $triageUsername = $_POST['contactno'];
    $query = mysqli_query($con, "SELECT id FROM triage WHERE triageUsername='$triageUsername'");
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $_SESSION['cnumber'] = $triageUsername;
        header('location:reset-password.php');
    } else {
        echo "<script>alert('Detalles no válidos. Por favor intenta con detalles válidos');</script>";
        echo "<script>window.location.href ='forgot-password.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Recuperación de contraseña</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="icon" type="image/png" href="../doctor//assets//images//pas.png" />
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<style>
	body.login {
		background: linear-gradient(to right, #2ecc71, #3498db, #8e44ad);
		/* Degradado de verde a lila a celeste */
		background-image: url('../doctor//assets//images//fon.png');
		/* Ruta de tu imagen de fondo */
		background-size: cover;
		/* Ajusta el tamaño de la imagen para cubrir completamente el fondo */
		background-position: center;
		/* Centra la imagen */
		background-repeat: no-repeat;
		background-size: 150% 160%;



		justify-content: center;
	}
</style>


<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<br>
				<br>


				<a href="../../index.html">
					<center>
						<h2>SubCentro Unemi | Recuperar contraseña </h2>
					</center>
				</a>
			</div>
			<br>
			<div class="box-login">
				<form class="form-login" method="post">
					<fieldset>
						<legend>
							Recuperación de contraseña Enfermera
						</legend>
						<p>
							Por favor ingrese su Usuario 
						</p>

						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="text" class="form-control" name="contactno" placeholder="Usuario Registrado">
								<i class="fa fa-lock"></i>
							</span>
						</div>


						<div class="form-actions">

							<button type="submit" class="btn btn-primary pull-right" name="submit">
								Reiniciar <i class="fa fa-arrow-circle-right"></i>
							</button>
							<button type="button" class="btn btn-default btn-danger pull-left" onclick="window.location.href='../../index.html';">
								Cancelar
							</button>

						</div>
						<div class="new-account">
						
							<a href="index.php">
								Acceder
							</a>
						</div>
					</fieldset>
				</form>
				<div class="copyright">
					&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Unemi</span>. <span>Todos los derechos reservados</span>
				</div>


			</div>

		</div>
	</div>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

	<script src="assets/js/main.js"></script>

	<script src="assets/js/login.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>