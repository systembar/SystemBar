<?php 
require_once '../../controller/Pedido_controller.php';
$control = new Pedido_Controller();
$estado=$_GET['estado'];
if($estado==0){
    $cambio=1;
} else {
    $cambio=0;
}

if ($control->CambiarEstado($cambio,$_GET['id'])) {
	echo "cambio de estado realizado";} ?>
	<meta http-equiv="refresh" content="0; url=listar.php">

