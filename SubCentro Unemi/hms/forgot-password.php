<?php
session_start();
error_reporting(0);
include("include/config.php");

// Comprobando detalles para restablecer la contraseña
//Consulto en la tbala Users
if (isset($_POST['submit'])) {
    $nombre = $_POST['fullname'];
    $email = $_POST['email'];
    $consulta = mysqli_query($con, "select id from users where fullName='$nombre' and email='$email'");
    $filas = mysqli_num_rows($consulta);
    if ($filas > 0) {
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
    } else {
        echo "<script>alert('Detalles inválidos. Por favor, intente con detalles válidos');</script>";
        echo "<script>window.location.href ='forgot-password.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Recuperación de Contraseña de Paciente</title>

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
    <link rel="icon" type="image/png" href="../images/pas.png" />

</head>
<style>
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
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <br>
                <br>

                <a href="../index.html">
                    <center>
                        <h2> SubCentro Unemi | Recuperar Contraseña </h2>
                    </center>
                </a>
            </div>
            <br>
            <br>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <legend>
                            Recuperación de Contraseña de Paciente
                        </legend>
                        <p>
                            Por favor, ingrese su correo electrónico y contraseña para recuperar su contraseña.<br />
                        </p>

                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="fullname" placeholder="Nombre Completo Registrado">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="Correo Electrónico Registrado">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit">
                                Restablecer <i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-danger pull-left" onclick="location.href='./user-login.php';">
                                Cancelar
                            </button>
                        </div>

                        <div class="new-account">
                            ¿Ya tiene una cuenta?
                            <a href="user-login.php">
                                Iniciar Sesión
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