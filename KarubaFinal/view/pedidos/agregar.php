<?php 
require_once '../../controller/producto_controller.php';
require_once '../../model/model_produc_pedi.php';
require_once '../../model/model_producto.php';

$mesa=$_POST["mesa"];

$control = new Producto_Controller();
$producto = new Producto();
$producto->__SET('id_producto',$_POST['id_producto']);
$producto->__SET('nombre',$_POST['nombre']);
$producto->__SET('precio',$_POST['precio']);
$producto->__SET('foto',$_POST['foto']);
$producto->__SET('estado',$_POST['estado']);
$producto->__SET('cantidad',$_POST['cantidad']);
$producto->__SET('subTotal',($_POST['precio']*$_POST['cantidad']));


session_start();
if(isset($_SESSION["carrito"])){
    $carrito= $_SESSION["carrito"];
}else{
    $carrito=array();
}
array_push($carrito, $producto);
$_SESSION["carrito"]=$carrito;

header("Location: agregarP.php?m=$mesa");

?>
