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

<div class="formulario" id="mover">

    <h1 style="font-family: fantasy; font-size: 40px">Registrar Usuarios</h1>
    <form action="#" method="post">

        <label>Tipo Documento</label><br>
        <select name="tipo_documento">
            <?php foreach ($control2->ListarDatos() as $r):?>
            <option value="<?php echo $r->__GET('id_tipoDocumento'); ?>">
                <?php echo $r->__GET('nombre'); ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Documento <span style="color:red;">*</span></label>
        <input type="number" placeholder="Ingresar documento" class="campo" name="cedula">
        <label>Nombre</label>
        <input type="text" placeholder="Ingresar nombre" class="campo" name="nombre">
        <label>Apellido</label>
        <input type="text" placeholder="Ingresar apellido" class="campo" name="apellido">
        <label>Teléfono</label>
        <input type="number" placeholder="Ingresar teléfono" class="campo" name="telefono" maxlength="7">
        <label>Celular</label>
        <input type="number" placeholder="Ingresar celular" class="campo" name="celular">
        <label>Correo</label>
        <input type="email" placeholder="Ingresar correo" class="campo" name="correo">
        <label>Tipo Usuario</label><br>
        <select name="tipo_usuario">
            <?php foreach ($control3->ListarDatos() as $r):?>
            <option value="<?php echo $r->__GET('id_tipoUsuario'); ?>">
                <?php echo $r->__GET('nombre'); ?>
            </option>
            <?php endforeach; ?>
        </select><br><br>
        <label>Usuario</label>
        <input type="text" placeholder="Ingresar usuario" class="campo" name="usuario">
        <label>Contraseña</label>
        <input type="password" placeholder="Ingresar contraseña" class="campo" name="pass">

        <input type="submit" value="REGISTRAR" id="btn_formulario" name="enviar">

    </form>
    <?php 
			if  (isset($_POST['enviar'])) {
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
                    $id=$_POST['cedula'];
                    $validacion=$control->validar($id);
                    echo $validacion;
                    if ($validacion<1){
                   
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
                
                
 }  else {
                        
  echo'<script type="text/javascript">
              swal({
  title: "Usuario existente",
  text: "por favor digite un usuario que no este registrado!",
  type: "warning",
  confirmButtonColor: "#f76100",
  confirmButtonText: "ok!",
  closeOnConfirm: false
});
            </script>';
						     
						 }

				
                }

			} ?>
</div>





<script src="../../public/js/jquery-3.2.1.min.js"></script>
<script src="../../public/js/script.js"></script>



</body>
<?php
require_once '../template/footer.php';
 ?>
<!-- Footer -->

</html>
