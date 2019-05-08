<?php 
require_once '../../controller/td_controller.php';
require_once '../../controller/tu_controller.php';
require_once '../../controller/user_controller.php';
require_once '../../model/model_user.php';
require_once '../../model/model_td.php';

$usuario = new Usuario();
$control = new User_Controller();
$control2 = new td_Controller();
$control3 = new tu_Controller();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../public/css/estilos.css">
    <link rel="stylesheet" href="../../public/librerias/icon/style.min.css">
    <link rel="stylesheet" href="../../public/librerias/notify/sweetalert.css">

    <script src="../../public/librerias/notify/sweetalert.min.js"></script>
    

</head>

<body class="login">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="inactive underlineHover"> <a href="../gestion/vlogin.php" style="color:black">Iniciar</a> </h2>
            <h2 class="active"> <a href="../user/registrarLogin.php" style="color:black">Registrar</a></h2>

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../../public/img/logo.jpg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form class="validate-form" action="" method="post" >

                <select name="tipo_documento" class="select">
                    <option>Tipo Documento</option>
                    <?php foreach ($control2->ListarDatos() as $r):?>
                    <option value="<?php echo $r->__GET('id_tipoDocumento'); ?>">
                        <?php echo $r->__GET('nombre'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <div class="validate-input" data-validate="Cedula Es necesaria">
                    <input type="text" id="cedula" class="input100" name="cedula" placeholder="Cedula">
                </div>
                <div class="validate-input" data-validate="Nombre Es necesario">
                    <input type="text" id="nombre" class="input100" name="nombre" placeholder="Nombre">
                </div>
                <div class="validate-input" data-validate="Apellido Es necesario">
                    <input type="text" id="apellido" class="input100" name="apellido" placeholder="Apellido">
                </div>
                <div class="validate-input" data-validate="Telefono Es necesario">
                    <input type="text" id="telefono" class="input100" name="telefono" placeholder="Telefono">
                </div>
                <div class="validate-input" data-validate="Celular Es necesario">
                    <input type="text" id="celular" class="input100" name="celular" placeholder="Celular">
                </div>
                <div class="validate-input" data-validate="Correo Es necesario">
                    <input type="text" id="correo" class="input100" name="correo" placeholder="Correo">
                </div>

                <select name="tipo_usuario" class="select">
                    <?php foreach ($control3->ListarDatos() as $r):?>
                    <option value="<?php echo $r->__GET('id_tipoUsuario'); ?>">
                        <?php echo $r->__GET('nombre'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <div class="validate-input" data-validate="Usuario Es necesario">
                    <input type="text" id="usuario" class="input100" name="usuario" placeholder="Usuario">
                </div>
                <div class="validate-input" data-validate="Contraseña Es necesaria">
                    <input type="text" id="pass" class="input100" name="pass" placeholder="Contraseña">
                </div>



                <input type="submit" class="fadeIn fourth" value="Registrar" name="enviar">
            </form>

            


        </div>
    </div>
       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
</body>

</html>
