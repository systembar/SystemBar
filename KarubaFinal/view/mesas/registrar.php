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

?>

<div class="formulario">

    <h1 style="font-family: fantasy; font-size: 40px">Registrar Mesa</h1>
    <form action="#" method="post">

        
        <label>Nombre</label>
        <input type="text" placeholder="Ingresar documento" class="campo" name="nombre">
        <input type="hidden" placeholder="Ingresar nombre" class="campo" name="estado">
        

        <input type="submit" value="REGISTRAR" id="btn_formulario" name="enviar">

    </form>
    <?php 
			if (isset($_POST['enviar'])) {
                if(empty($_POST['nombre'])){
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
                
						 $control->insertar($mesa);
				
				
echo'<script type="text/javascript">
              swal({
  title: "REGISTRO",
  text: "Realizado con exito!",
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

    <script src="../../public/js/jquery-3.2.1.min.js"></script>
    <script src="../../public/js/script.js"></script>
   


</body>
<?php
require_once '../template/footer.php';
 ?>
<!-- Footer -->
</html>
