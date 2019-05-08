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

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 style="font-size: 40px">Editar Mesa</h3>



    <form action="#" method="post" class="validate-form">
          <div class="validate-input" data-validate=" Nombre es necesario">
           <label>Nombre</label>
           <input type="text" id="nombre" class="input100" name="nombre"  value="<?php echo $resultado->nombre; ?>">
        </div>


            
            <input type="hidden" id="estado" class="fadeIn third" name="estado" value="<?php echo $resultado->estado; ?>">
            
            <input type="hidden" id="num_mesa" class="fadeIn third" name="num_mesa" value="<?php echo $resultado->num_mesa; ?>">

            <input type="submit" value="GUARDAR" class="fadeIn fourth" name="enviar" style="margin-top:3%">

        </form>
    </div>
 

</div>
       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
   

</body>

</html>
