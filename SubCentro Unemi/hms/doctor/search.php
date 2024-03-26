<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Buscar Paciente</title>

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
	<link rel="icon" type="image/png" href="../doctor//assets//images//b.png" />

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
								<h1 class="mainTitle">Buscar Triage de Paciente</h1>
							</div>

						</div>
					</section>
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<form role="form" method="post" name="search">

									<div class="form-group">
										<label for="doctorname">
											Buscar por nombre/número de móvil:
										</label>
										<br>
										<br>

										<input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
									</div>

									<br>
									<button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
										Buscar
									</button>
								</form>
								<?php
								if (isset($_POST['search'])) {

									$sdata = $_POST['searchdata'];
								?>
									<h4 align="center">Resultado encontrado "<?php echo $sdata; ?>" keyword </h4>

									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Nombre del Paciente</th>
												<th>Número de Contacto del Paciente</th>
												<th>Género del Paciente</th>
												<th>Fecha de Creación</th>
												<th>Fecha de Actualización</th>
												<th>Acción</th>
											</tr>

										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
											$num = mysqli_num_rows($sql);
											if ($num > 0) {
												$cnt = 1;
												while ($row = mysqli_fetch_array($sql)) {
											?>
													<tr>
														<td class="center"><?php echo $cnt; ?>.</td>
														<td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
														<td><?php echo $row['PatientContno']; ?></td>
														<td><?php echo $row['PatientGender']; ?></td>
														<td><?php echo $row['CreationDate']; ?></td>
														<td><?php echo $row['UpdationDate']; ?>
														</td>
														<td>

															<a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"><i class="fa fa-eye"></i></a>

														</td>
													</tr>
												<?php
													$cnt = $cnt + 1;
												}
											} else { ?>
												<tr>
													<td colspan="8"> No se encontró ningún registro en esta búsqueda</td>

												</tr>

										<?php }
										} ?>
										</tbody>
									</table>
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