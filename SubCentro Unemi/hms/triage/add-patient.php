<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
	$docid = $_SESSION['id'];
	$patname = $_POST['patname'];
	$patcontact = $_POST['patcontact'];
	$patemail = $_POST['patemail'];
	$gender = $_POST['gender'];
	$pataddress = $_POST['pataddress'];
	$patage = $_POST['patage'];
	$medhis = $_POST['medhis'];
	$sql = mysqli_query($con, "insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
	if ($sql) {
		echo "<script>alert('Información del paciente agregada exitosamente'); window.location.href = 'add-patient.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title> Agregar Paciente</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	<link rel="icon" type="image/png" href="../doctor//assets//images//an.png" />



	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#patemail").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

	<style>
		/* Estilos para el pie de página */
		footer {
			background-color: #3E4B5C;
			/* Color de fondo negro */
			color: #fff;
			/* Color de texto blanco */
			padding: 2px 15px;
			/* Ajusta el espaciado interno según tus preferencias */
			text-align: center;
			/* Centra el texto */
			font-size: 11px;
			/* Ajusta el tamaño de la fuente según tus preferencias */
		}

		.footer-inner {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
	</style>
</head>

<body>
	<div id="app">
		<?php include('include/sidebar.php'); ?>
		<div class="app-content">
			<?php include('include/header.php'); ?>

			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Agregar paciente</h1>
							</div>

						</div>
					</section>
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<div class="row margin-top-30">
									<div class="col-lg-8 col-md-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h5 class="panel-title">Agregar Paciente</h5>
											</div>
											<div class="panel-body">
												<form role="form" name="" method="post">

													<div class="form-group">
														<label for="doctorname">Nombre del Paciente: </label>

														<input type="text" name="patname" class="form-control" placeholder="Nombre del Paciente" required="true">
													</div>
													<div class="form-group">
														<label for="fess">Número de Contacto del Paciente: </label>

														<input type="text" name="patcontact" class="form-control" placeholder="Número de contacto del paciente" required="true" maxlength="10" pattern="[0-9]+">
													</div>
													<div class="form-group">
														<label for="fess">Correo Electrónico del Paciente: </label>

														<input type="email" id="patemail" name="patemail" class="form-control" placeholder="Correo del paciente" required="true" onBlur="userAvailability()">
														<span id="user-availability-status1" style="font-size:12px;"></span>
													</div>
													<div class="form-group">
														<label class="block">
															Género:
														</label>
														<div class="clip-radio radio-primary">
															<input type="radio" id="rg-female" name="gender" value="female">
															<label for="rg-female">
																Femenino
															</label>
															<input type="radio" id="rg-male" name="gender" value="male">
															<label for="rg-male">
																Masculino
															</label>
														</div>
													</div>
													<div class="form-group">
														<label for="address">Dirección del Paciente: </label>

														<textarea name="pataddress" class="form-control" placeholder="Ingrese la direccioón del paciente" required="true"></textarea>
													</div>
													<div class="form-group">
														<label for="fess">Edad del Paciente: </label>
														<input type="text" name="patage" class="form-control" placeholder="Edad del Paciente" required="true">
													</div>
													<div class="form-group">
														<label for="fess">
															Historial Médico:
														</label>
														<textarea type="text" name="medhis" class="form-control" placeholder="Ingrese el historial médico del paciente (si corresponde)" required="true"></textarea>
													</div>

													<button type="button" class="btn btn-default btn-danger pull-left" style="margin-right: 50px;" onclick="location.href='dashboard.php';">
														Cancelar
													</button>

													<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
														Agregar
													</button>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="panel panel-white">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer>
			<div class="footer-inner">
				<div class="pull-left">
					&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Unemi</span>. <span>Reservados todos los derechos</span>
				</div>
				<div class="pull-right">
					<span class="go-top"><i class="ti-angle-up"></i></span>
				</div>
			</div>
		</footer>
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->
		<?php include('include/setting.php'); ?>

		<!-- end: SETTINGS -->
	</div>
	<!-- start: MAIN JAVASCRIPTS -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<!-- end: MAIN JAVASCRIPTS -->
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
	<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="vendor/autosize/autosize.min.js"></script>
	<script src="vendor/selectFx/classie.js"></script>
	<script src="vendor/selectFx/selectFx.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<!-- start: CLIP-TWO JAVASCRIPTS -->
	<script src="assets/js/main.js"></script>
	<!-- start: JavaScript Event Handlers for this page -->
	<script src="assets/js/form-elements.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
		});
	</script>
	<!-- end: JavaScript Event Handlers for this page -->
	<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>