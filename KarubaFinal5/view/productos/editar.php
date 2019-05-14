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
$resultado=$control->buscar($_GET['id']);

?>

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 style="font-size: 40px">Editar Producto</h3>



    <form action="#" method="post" class="validate-form">
        
            <label>Nombre</label>
        <div class="validate-input" data-validate="Nombre Es necesario">
           <input type="text" id="nombre" class="input100" name="nombre" value="<?php echo $resultado->nombre; ?>">
        </div>
         <div class="validate-input" data-validate="Precio Es necesario">
            <label>Precio</label>
            <input type="text" id="precio" class="input100" name="precio" value="<?php echo $resultado->precio; ?>">
        </div>
    
            <input type="hidden" class="campo" name="foto" value="<?php echo $resultado->foto; ?>">
     
            <input type="hidden" class="campo" name="estado" value="<?php echo $resultado->estado; ?>">
            

            <input type="submit" value="GUARDAR" class="registrar" name="enviar" style="margin-top:3%">

        </form>
    </div>


</div>
       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
   

</body>

</html>
