<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $newDate = $_POST['newDate'];
    $newTime = $_POST['newTime'];
    $appointmentId = $_POST['appointmentId'];

    // Validar los datos (puedes agregar más validaciones según tus requisitos)
    if (empty($newDate) || empty($newTime) || empty($appointmentId)) {
        $_SESSION['error'] = "Por favor, complete todos los campos.";
        header('location:edit-appointment.php?id=' . $appointmentId);
        exit();
    }

    // Actualizar la información en la base de datos
    $query = "UPDATE appointment SET appointmentDate=?, appointmentTime=? WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssi", $newDate, $newTime, $appointmentId);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        $_SESSION['msg'] = "Información de la cita actualizada con éxito.";
        header('location:appointment-history.php');
        exit();
    } else {
        $_SESSION['error'] = "Error al actualizar la información de la cita.";
        header('location:edit-appointment.php?id=' . $appointmentId);
        exit();
    }
} else {
    // Obtener el ID de la cita de la URL
    $appointmentId = $_GET['id'];

    // Obtener la información de la cita de la base de datos
    $query = "SELECT * FROM appointment WHERE id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        Historial de citas</title>

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
    <link rel="stylesheet" href="assets/css/themes/theme-3.css" id="skin_color" />
    <link rel="icon" type="image/png" href="../images/rea.png" />
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">


            <?php include('include/header.php'); ?>

            <br>
            <br>


            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Reagendar Fecha y Hora de Cita</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Usuario </span>
                                </li>
                                <li class="active">
                                    <span>Reagendar Cita</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="AppointmentDate">Nueva Fecha:</label>
                            <input class="form-control datepicker" name="newDate" required="required" data-date-format="yyyy-mm-dd" value="<?php echo $appointment['appointmentDate']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Appointmenttime">Nueva Hora:</label>
                            <input class="form-control" name="newTime" id="timepicker1" required="required" value="<?php echo $appointment['appointmentTime']; ?>"> <!-- Puedes añadir un formato específico aquí si es necesario -->
                        </div>

                        <!-- Campo oculto para pasar el ID de la cita -->
                        <input type="hidden" name="appointmentId" value="<?php echo $appointmentId; ?>" />

                        <br>
                        <!-- Botón de envío del formulario -->
                        <input type="submit" name="submit" class="btn btn-o btn-primary" value="Guardar Cambios" style="margin-right: 10px;">


                        <a class="btn btn-danger" href="javascript:history.go(-1)">Cancelar</a>

                    </form>


                </div>
            </div>
        </div>
        <!-- start: FOOTER -->
        <?php include('include/footer.php'); ?>
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

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });
    </script>
    <script type="text/javascript">
        $('#timepicker1').timepicker();
    </script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>


</body>
</body>

</html>