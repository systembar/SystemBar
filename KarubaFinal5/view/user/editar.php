<?php 
require_once '../../controller/td_controller.php';
require_once '../../controller/tu_controller.php';
require_once '../../controller/user_controller.php';
require_once '../../model/model_user.php';
session_start();
//error_reporting(0);
$session= $_SESSION['usuario'];

$varsesion = $session->cedula;
$vartipo =  $session->tipo_usuario;


if ($varsesion == null || $varsesion = '' ){
    echo 'Usted no tiene autorizacion';
    header("Location:../gestion/vlogin.php");
}


if($vartipo==1){
    require_once '../template/header.php';

}else if($vartipo == 2 || $vartipo == 3){
     require_once '../template/header2.php';
}
require_once '../../controller/td_controller.php';
require_once '../../controller/tu_controller.php';
require_once '../../controller/user_controller.php';
require_once '../../model/model_user.php';


$usuario = new Usuario();
$control = new User_Controller();
$control2 = new td_Controller();
$control3 = new tu_Controller();
$resultado=$control->buscar($_GET['id']);
?>

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 style="font-size: 40px">Editar Usuario</h3>


    <!-- Login Form -->
    <form action="#" method="post" class="validate-form">
           <select name="tipo_documento" class="select" style="margin-top:5%">
                           <option>Tipo Documento</option>
                            <?php foreach ($control2->ListarDatos() as $r):?>
                            <option value="<?php echo $r->__GET('id_tipoDocumento'); ?>">
                                <?php echo $r->__GET('nombre'); ?>
                            </option>
                            <?php endforeach; ?>
        </select>
           
           <div class="validate-input" data-validate="Cedula Es necesaria">
            <input type="text" id="cedula" class="input100" name="cedula" value="<?php echo $resultado->cedula; ?>">
        </div>
          <div class="validate-input" data-validate="Nombre Es necesario">
             <input type="text" id="nombre" class="input100" name="nombre" value="<?php echo $resultado->nombre; ?>">
        </div>
        <div class="validate-input" data-validate="Apellido Es necesario">
           <input type="text" id="apellido" class="input100" name="apellido" value="<?php echo $resultado->apellido; ?>">
        </div>
        <div class="validate-input" data-validate="Telefono Es necesario">
            <input type="text" id="telefono" class="input100" name="telefono" value="<?php echo $resultado->telefono; ?>"> 
        </div>
        <div class="validate-input" data-validate="Celular Es necesario">
             <input type="text" id="celular" class="input100" name="celular" value="<?php echo $resultado->celular; ?>">
        </div>
         <div class="validate-input" data-validate="Correo Es necesario">
              <input type="text" id="correo" class="input100" name="correo" value="<?php echo $resultado->correo; ?>">
        </div>
            
        <select name="tipo_usuario" class="select">
            <?php foreach ($control3->ListarDatos() as $r):?>
            <option value="<?php echo $r->__GET('id_tipoUsuario'); ?>">
                <?php echo $r->__GET('nombre'); ?>
            </option>
            <?php endforeach; ?>
        </select>
            <div class="validate-input" data-validate="Usuario Es necesario">
            <input type="text" id="usuario" class="input100" name="usuario" value="<?php echo $resultado->usuario; ?>">
        </div>
        <div class="validate-input" data-validate="Contraseña Es necesaria">
           <input type="password" id="pass" class="input100" name="pass" value="<?php echo $resultado->pass; ?>">
        </div>

            <input type="submit" value="GUARDAR" class="registrar" name="enviar" style="margin-top:3%">

        </form>
    </div>


</div>
       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
   

</body>

</html>
