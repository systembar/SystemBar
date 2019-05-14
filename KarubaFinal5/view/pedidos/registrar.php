<?php 
require_once '../../controller/pedido_controller.php';
require_once '../../controller/user_controller.php';
require_once '../../model/model_pedido.php';
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




$pedido = new Pedido();
$control = new Pedido_Controler();
$control2 = new User_Controller();

?>

<div class="wrapper">

    <div class="formulario">
        <form action="#" method="post">

            <label>Numero Mesa</label>
            <input type="text" class="campo" name="num_mesa" placeholder="Ingrese numero de mesa">

            <label>Responsable</label>
            <input type="text" class="campo" name="responsable" placeholder="Ingrese responsable">

            <input type="submit" value="ENTRAR" id="btn_formulario" name="enviar" style="margin-top:3%">


        </form>

    </div>

    <?php 
       
			if (isset($_POST['enviar'])) {
            
				$pedido->__SET('num_mesa',$_POST['num_mesa']);
				$pedido->__SET('responsable',$_POST['responsable']);
               
				
				if ($control->insertar($pedido)) {
					echo "datos  ingresados con exito";
			?>
    <meta http-equiv="refresh" content="0; url=agregarP.php?id=2">
    <?php 
				}
			} ?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../../public/js/script.js"></script>
</body>

</html>
