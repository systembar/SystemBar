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

<div class="formulario">

    <h1 style="font-family: fantasy; font-size: 40px">Registrar Productos</h1>
    <form action="#" method="post">

        <label>Nombre</label>
        <input type="text" placeholder="Ingresar Nombre" class="campo" name="nombre">
        <label>Precio</label>
        <input type="number" placeholder="Ingresar Precio" class="campo" name="precio">

        <input type="submit" value="REGISTRAR" id="btn_formulario" name="enviar">

    </form>
    <?php 
			if (isset($_POST['enviar'])) {
                if(empty($_POST['nombre']) || empty($_POST['precio'])){
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
