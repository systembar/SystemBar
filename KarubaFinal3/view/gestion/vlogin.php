<?php 
include_once '../../model/conexion.php';
include_once '../../controller/login.php';
$control = new IniciarSesion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
    <link rel="stylesheet" href="../../public/librerias/notify/sweetalert.css">
    <script src="../../public/librerias/notify/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../public/librerias/icon/style.min.css">
    <script src="../../public/js/jquery-3.2.1.min.js"></script>
</head>
<body class="login">
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> <a href="vlogin.php" style="color:black">Iniciar</a> </h2>
    <h2 class="inactive underlineHover"> <a href="../user/registrarLogin.php" style="color:black">Registrar</a></h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../../public/img/logo.jpg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="" method="POST">
      <input type="text" id="usuario" class="fadeIn " name="user" placeholder="Usuario">
      <input type="password" id="pass" class="fadeIn" name="pass" placeholder="Contraseña">

     
      
      <input type="submit" class="fadeIn fourth" value="Iniciar" name="enviar" >
    </form>
     <?php
                   
		if (isset($_POST['enviar'])) {
            
			
			if ($control->iniciar($_POST['user'],md5($_POST['pass']))) {
		?>
    <meta http-equivale="refresh" content="0;url=vlogin.php">
    <?php
			}
		}
		?>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Recuperar contraseña</a>
    </div>

  </div>
</div>
</body>
</html>