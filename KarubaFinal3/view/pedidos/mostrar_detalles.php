<?php 
require_once '../../controller/pedido_controller.php';
require_once '../../model/model_detalleP.php';
require_once '../../model/conexion.php';
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





$control = new Pedido_Controller();
$id_pedido=$_GET['id'];

?>
<script src="../../public/js/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="../../public/librerias/icon/style.min.css">
<link rel="stylesheet" href="../../public/css/estilos.css">
<link rel="stylesheet" href="../../public/librerias/materialize/css/materialize.css">
<script src="../../public/librerias/materialize/js/materialize.js"></script>

   <p style="font-family: fantasy; font-size: 40px; margin-left:-100px ;margin-top:8%;">Detalles del Pedido</p>


<div class="row" style="margin-top:2%; margin-left:25%;">
    <div class="col s8">
        <div class="card darken-1 ">
            <div class="card-content">
                <span class="card-title blue-text text-darken-2">PRODUCTOS</span>


                  
                        <table style="margin-left:0;">
        <thead>
            <tr>
                <th>Producto</th>
                <th>precio</th>
                <th>cantidad</th>
                <th>Precio Acumulado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($control->listarp($id_pedido) as $r):?>
                <td>
                    <?php echo $r->__GET('nombre'); ?>
                </td>

                <td>
                    <?php echo $r->__GET('precio'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('cantidad'); ?>
                </td>

                <td>
                    <?php echo $r->__GET('precioAcumulado');?>
                </td>
        </tbody>


        <?php endforeach; ?>
    </table>

            </div>
            <div class="card-action" style="background:#f76100; color:#ffffff ;">
                <a class="white-text text-darken-2" href="listar.php"><span class="lnr lnr-chevron-left-circle" style="float:right; font-siza;16px;"></span>listo</a>

            </div>
        </div>
    </div>

</div>
<?php 
    require_once '../template/footer.php';
?>
