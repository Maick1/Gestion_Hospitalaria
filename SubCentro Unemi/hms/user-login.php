<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
	$ret = mysqli_query($con, "SELECT * FROM users WHERE email='" . $_POST['username'] . "' and password='" . md5($_POST['password']) . "'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$extra = "dashboard.php"; //
		$_SESSION['login'] = $_POST['username'];
		$_SESSION['id'] = $num['id'];
		$host = $_SERVER['HTTP_HOST'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;

		// Para iniciar sesión si el usuario inicia sesión correctamente
		$log = mysqli_query($con, "INSERT INTO userlog(uid, username, userip, status) VALUES ('" . $_SESSION['id'] . "', '" . $_SESSION['login'] . "', '$uip', '$status')");
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		// Para iniciar el registro si el inicio de sesión del usuario no se realizó correctamente
		$_SESSION['login'] = $_POST['username'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		mysqli_query($con, "INSERT INTO userlog(username, userip, status) VALUES ('" . $_SESSION['login'] . "', '$uip', '$status')");
		$_SESSION['errmsg'] = "Usuario o contraseña incorrectos";
		$extra = "user-login.php";
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login Paciente</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	<link rel="icon" type="image/png" href="../images/paciente.png" />

</head>
<style>
	/* Agrega este estilo al final de tu archivo CSS */
	.centered-image {
		text-align: center;
		/* Puedes ajustar este valor según sea necesario */
	}

	.centered-image img {
		max-width: 100px;
		height: 100px;
		display: inline-block;
	}


	body.login {
		background: linear-gradient(to right, #2ecc71, #3498db, #8e44ad);
		/* Degradado de verde a lila a celeste */
		background-image: url('../images/fon.png');
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
	<br>
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">

				<a href="../index.html">
					<center>
						<h2>SubCentro Unemi| Login Paciente</h2>
					</center>
				</a>
			</div>
			<div class="centered-image">
				<img src="../images//lopaci.png" alt="Descripción de la imagen">
			</div>

			<div class="box-login">
				<form class="form-login" method="post">
					<fieldset>
						<legend>
							Iniciar sesión en su cuenta
						</legend>
						<p>
							Por favor ingrese su nombre de usuario y contraseña para iniciar sesión<br />
							<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg'] = ""; ?></span>
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="Correo">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="Contraseña">
								<i class="fa fa-lock"></i>
								<br>
							</span><a href="forgot-password.php">
								¿Olvidaste la contraseña?
							</a>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary pull-right" name="submit">
								Ingresar <i class="fa fa-arrow-circle-right"></i>
							</button>
							<button type="button" class="btn btn-default btn-danger pull-left" onclick="location.href='../index.html';">
								Cancelar
							</button>


						</div>
						<div class="new-account">
							¿Aún no tienes una cuenta?
							<a href="registration.php">
								Crea una cuenta
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
	<script src="vendor/jquery-validation/localization/messages_es.js"></script>

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