<?php 
require_once '../../controller/producto_controller.php';
require_once '../../model/model_producto.php';
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






$producto = new Producto();
$control = new Producto_Controller();


?>

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 style="font-size: 40px">Registrar Producto</h3>



    <form action="#" method="post" class="validate-form">
        
        <div class="validate-input" data-validate="Nombre Es necesario">
        <input type="text" id="nombre" class="input100" name="nombre" placeholder="Nombre">
        </div>
        <div class="validate-input" data-validate="Precio Es necesario">
        <input type="text" id="precio" class="input100" name="precio" placeholder="Precio">
        </div>

        <input type="submit" value="REGISTRAR" class="fadeIn fourth" name="enviar">

    </form>
    
</div>

<?php 
			if (isset($_POST['enviar'])) {

				$producto->__SET('nombre',$_POST['nombre']);
				$producto->__SET('precio',$_POST['precio']);
				$producto->__SET('estado',1);
                
                    $control->insertar($producto);
			
				
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

				
                

			} ?>

       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
   


</body>

<!-- Footer -->
</html>
