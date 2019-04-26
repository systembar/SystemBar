<?php 
require_once '../../controller/mesa_controller.php';
require_once '../../model/model_mesa.php';
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




$mesa = new Mesa();
$control = new Mesa_Controller();
$resultado=$control->buscar($_GET['id']);

?>

<div class="wrapper">
    <div class="formulario" >
           <h1 style="font-family: fantasy; font-size: 40px">Modificar Mesa</h1>

        <form action="#" method="post">
           <label>Nombre</label>
           <input type="text" class="campo" name="nombre" value="<?php echo $resultado->nombre; ?>">
            
            <input type="hidden" class="campo" name="estado" value="<?php echo $resultado->estado; ?>">
            <input type="hidden" class="campo" name="num_mesa" value="<?php echo $resultado->num_mesa; ?>">

            <input type="submit" value="GUARDAR" id="btn_formulario" name="enviar" style="margin-top:3%">

        </form>
    </div>
 <?php 
			if (isset($_POST['enviar'])) {
                if(empty($_POST['nombre']) || empty($_POST['estado'])){
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
				$mesa->__SET('nombre',$_POST['nombre']);
                $mesa->__SET('estado',$_POST['estado']);
                $mesa->__SET('num_mesa',$_POST['num_mesa']);
				
                    $control->actualizar($mesa);

				
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
