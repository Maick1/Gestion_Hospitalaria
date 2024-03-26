<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
if (isset($_POST['submit'])) {
	$docspecialization = $_POST['Doctorspecialization'];
	$docname = $_POST['docname'];
	$docaddress = $_POST['clinicaddress'];
	$docfees = $_POST['docfees'];
	$doccontactno = $_POST['doccontact'];
	$docemail = $_POST['docemail'];
	$sql = mysqli_query($con, "Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='" . $_SESSION['id'] . "'");
	if ($sql) {
		echo "<script>alert('Detalles del médico actualizados correctamente');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Editar Doctor</title>

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
	<link rel="icon" type="image/png" href="../doctor//assets//images//e.png" />

</head>
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
								<h1 class="mainTitle">Editar detalles del doctor(a)</h1>
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
												<h5 class="panel-title">Editar Doctor(a)</h5>
											</div>
											<div class="panel-body">
												<?php $sql = mysqli_query($con, "select * from doctors where docEmail='" . $_SESSION['dlogin'] . "'");
												while ($data = mysqli_fetch_array($sql)) {
												?>
													<h4><?php echo htmlentities($data['doctorName']); ?>'s Prefil</h4>
													<p><b>Registro de perfil. Fecha: </b><?php echo htmlentities($data['creationDate']); ?></p>
													<?php if ($data['updationDate']) { ?>
														<p><b>Fecha de la última actualización del perfil: </b><?php echo htmlentities($data['updationDate']); ?></p>
													<?php } ?>
													<hr />
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Doctor(a) Especialización
															</label>
															<select name="Doctorspecialization" class="form-control" required="required">
																<option value="<?php echo htmlentities($data['specilization']); ?>">
																	<?php echo htmlentities($data['specilization']); ?></option>
																<?php $ret = mysqli_query($con, "select * from doctorspecilization");
																while ($row = mysqli_fetch_array($ret)) {
																?>
																	<option value="<?php echo htmlentities($row['specilization']); ?>">
																		<?php echo htmlentities($row['specilization']); ?>
																	</option>
																<?php } ?>

															</select>
														</div>

														<div class="form-group">
															<label for="doctorname">
																Doctor(a) Nombre
															</label>
															<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']); ?>">
														</div>


														<div class="form-group">
															<label for="address">
																Dirección de la clínica médica
															</label>
															<textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
														</div>
														<div class="form-group">
															<label for="fess">
																Horarios de consultoría médico
															</label>
															<input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['docFees']); ?>">
														</div>

														<div class="form-group">
															<label for="fess">
																Doctor Contacto:
															</label>
															<input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactno']); ?>">
														</div>

														<div class="form-group">
															<label for="fess">
																Doctor Email
															</label>
															<input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['docEmail']); ?>">
														</div>

													<?php } ?>

													<button type="submit" name="submit" class="btn btn-o btn-primary">
														Actualizar
													</button>
													</form>
											</div>
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