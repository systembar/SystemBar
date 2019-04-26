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

<div class="wrapper">
    <div class="formulario" >
           <h1 style="font-family: fantasy; font-size: 40px">Modificar Usuario</h1>

        <form action="#" method="post">
           <label>Tipo Documento</label><br>
                        <select name="tipo_documento">
                            <?php foreach ($control2->ListarDatos() as $r):?>
                            <option value="<?php echo $r->__GET('id_tipoDocumento'); ?>">
                                <?php echo $r->__GET('nombre'); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
            <label>Cedula:</label>
            <input type="number" class="campo" name="cedula" value="<?php echo $resultado->cedula; ?>">
            <label>Nombre:</label>
            <input type="text" class="campo" name="nombre" value="<?php echo $resultado->nombre; ?>">
            <label>Apellido:</label>
            <input type="text" class="campo" name="apellido" value="<?php echo $resultado->apellido; ?>">
            <label>Telefono:</label>
            <input type="number" class="campo" name="telefono" value="<?php echo $resultado->telefono; ?>"> 
            <label>Celular:</label>
            <input type="number" class="campo" name="celular" value="<?php echo $resultado->celular; ?>">
            <label>Correo:</label>
             <input type="email" class="campo" name="correo" value="<?php echo $resultado->correo; ?>">
            <label>Tipo Usuario</label><br>
        <select name="tipo_usuario">
                            <?php foreach ($control3->ListarDatos() as $r):?>
                            <option value="<?php echo $r->__GET('id_tipoUsuario'); ?>">
                                <?php echo $r->__GET('nombre'); ?>
                            </option>
                            <?php endforeach; ?>
        </select><br><br>
            <label>Usuario:</label>
            <input type="text" class="campo" name="usuario" value="<?php echo $resultado->usuario; ?>"> <br>
            <label>Contraseña:</label>
            <input type="password" class="campo" name="pass" value="<?php echo $resultado->pass; ?>">

            <input type="submit" value="GUARDAR" id="btn_formulario" name="enviar" style="margin-top:3%">

        </form>
    </div>
 <?php 
			if (isset($_POST['enviar'])) {
                if(empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telefono']) || empty($_POST['celular']) || empty($_POST['correo']) || empty($_POST['tipo_usuario']) || empty($_POST['tipo_documento']) || empty($_POST['usuario']) || empty($_POST['pass'])){
echo'<script type="text/javascript">
              swal({
  title: "Error en los campos",
  text: "Por favor llenar todos los campos!",
  type: "warning",
  confirmButtonColor: "#f76100",
  confirmButtonText: "ok!",
  closeOnConfirm: false
});
            </script>';
                        }else{
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
				
                    $control->actualizar($usuario);

				
echo'<script type="text/javascript">
              swal({
  title: "DATOS",
  text: "Modificados con exito!",
  type: "success",
  confirmButtonColor: "#3bea2f",
  confirmButtonText: "OK!"
},
function(){
  window.location.href="listar.php";
});
            </script>';

				
                }

			} ?>

</div>
<script type="../../bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="../../bootstrap-3.3.7/js/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../public/js/script.js"></script>
<?php
require_once '../template/footer.php';
 ?>
</body>

</html>
