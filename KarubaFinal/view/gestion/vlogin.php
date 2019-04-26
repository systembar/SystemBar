<?php 
include_once '../../model/conexion.php';
include_once '../../controller/login.php';
$control = new IniciarSesion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../../public/css/estilos.css">


    <link rel="stylesheet" href="../../public/librerias/notify/sweetalert.css">
    <script src="../../public/librerias/notify/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../public/librerias/icon/style.min.css">
    <script src="../../public/js/jquery-3.2.1.min.js"></script>



</head>

<body class="login">

    <header class="header_login">
        <h1>Bienvenidos a <i>Bar karuba</i></h1>
        <nav>
            <a href="#"><span class="lnr lnr-home"></span> Inicio</a>
            <a href="../../view/gestion/vlogin.php"><span class="lnr lnr-user"></span> Ingresar</a>
            <a href="../../view/user/registrarLogin.php"><span class="lnr lnr-users"></span> Registrar</a>
        </nav>
    </header>



    <div class="login-box">
        <img src="../../public/img/logo.jpg" width="100" height="100">

        <h1>Iniciar Sesión</h1>
        <form action="" method="POST">

            <!-- USERNAME INPUT -->
            <label for="">Usuario</label>
            <input type="text" placeholder="Ingrese Usuario" class="campo" name="user">
            <!-- PASSWORD INPUT -->
            <label for="">Contraseña</label>
            <input type="password" placeholder="Ingrese Contraseña" class="campo" name="pass">
            <input type="submit" value="ENTRAR" name="enviar" id="btn_login">
            <br>
            <a href="#" class="a">Perdiste tu contraseña?</a>
            <a href="../user/registrarLogin.php" class="b">No tienes cuenta?</a>
        </form>
    </div>
    <?php
                   
		if (isset($_POST['enviar'])) {
            
			
			if ($control->iniciar($_POST['user'],md5($_POST['pass']))) {
		?>
    <meta http-equivale="refresh" content="0;url=vlogin.php">
    <?php
			}
		}
		?>
    <!-- Footer -->


    <script src="../../public/js/script.js"></script>



</body>
<?php
require_once '../template/footer.php';
 ?>
<!-- Footer -->

</html>
