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

}else if($vartipo == 2 ){
     require_once '../template/header2.php';
}else if($vartipo == 3){
         require_once '../template/header3.php';

}



$mesa = new Mesa();
$control = new Mesa_Controller();

?>

<div class="wrapper fadeInDown">
  <div class="form">
        <h3 style="font-size: 40px">Registrar Mesa</h3>


    <!-- Login Form -->
    <form action="#" method="post" class="validate-form">

        
        <div class="validate-input" data-validate="Nombre Es necesario">
        <input type="text" id="nombre" class="input100" name="nombrem" placeholder="Nombre">
        </div>
        <input type="hidden" placeholder="Ingresar nombre" class="campo" name="estado">
        

        <input type="submit" value="REGISTRAR" class="registrar" name="enviar">

    </form>
    
</div>

<?php 
			if (isset($_POST['enviar'])) {
				$mesa->__SET('nombre',$_POST['nombrem']);
                $mesa->__SET('estado',1);
                
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

				
                

			} ?>

       <script src="../../public/js/jquery-3.2.1.min.js"></script>
       
    <script src="../../public/js/Validate.js"></script>
   


</body>

<!-- Footer -->
</html>
