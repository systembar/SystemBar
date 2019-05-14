<?php 
require_once '../../controller/td_controller.php';
require_once '../../controller/tu_controller.php';
require_once '../../controller/user_controller.php';
require_once '../../model/model_user.php';
require_once '../../model/model_td.php';
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




$usuario = new Usuario();
$control = new User_Controller();
$control2 = new td_Controller();
$control3 = new tu_Controller();

?>

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 class="t">Registrar Usuario</h3>


    <!-- Login Form -->
    <form action="#" method="post" class="validate-form">
     <select name="tipo_documento" class="select">
                    <?php foreach ($control2->ListarDatos() as $r):?>
                    <option value="<?php echo $r->__GET('id_tipoDocumento'); ?>">
                        <?php echo $r->__GET('nombre'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <div class="validate-input" data-validate="Cedula Es necesaria">
                    <input type="text" id="cedula"  class="input100" name="cedula" placeholder="Cedula">
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
                <div class="validate-input" data-validate="Corrreo vacio o incorrcto">
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

     
      
      <input type="submit" class="registrar" value="Registrar" name="enviar">
    </form>
   
    <?php 
			if (isset($_POST['enviar'])) {
                
                    $pass=md5($_POST['pass']);
				$usuario->__SET('cedula',$_POST['cedula']);
				$usuario->__SET('nombre',$_POST['nombre']);
                $usuario->__SET('apellido',$_POST['apellido']);
				$usuario->__SET('telefono',$_POST['telefono']);
                $usuario->__SET('celular',$_POST['celular']);
                $usuario->__SET('correo',$_POST['correo']);
                $usuario->__SET('tipo_usuario',$_POST['tipo_usuario']);
                $usuario->__SET('tipo_documento',$_POST['tipo_documento']);
				$usuario->__SET('usuario',$_POST['usuario']);
				$usuario->__SET('pass',$pass);
                $usuario->__SET('estado','0');
                    $control->insertar($usuario);
				


				
                

			} ?>
        


  </div>
</div>




<script src="../../public/js/jquery-3.2.1.min.js"></script>
<script src="../../public/js/Validate.js"></script>



<!-- Footer -->
</body>
</html>
