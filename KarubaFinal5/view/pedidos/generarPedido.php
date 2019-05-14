<?php
require_once "../../controller/pedido_controller.php";
require_once "../../model/model_pedido.php";
session_start();

$carrito= $_SESSION["carrito"];
$subtotal= $_SESSION["total"];

$descuento=$_POST['descuento']; 

$total=$subtotal-($subtotal*$descuento/100);


$pedido = new Pedido();
$control= new Pedido_Controller;
$mesa=$_POST['num_mesa'];
$pedido->__SET('responsable',$_POST['responsable']);
$pedido->__SET('num_mesa',$mesa);
$pedido->__SET('descuento',$descuento);
$pedido->__SET('subtotal',$subtotal);

$control->insertar($pedido,$total,$mesa);

unset($_SESSION["carrito"]);
unset($_SESSION["total"]);
header("location:listar.php");

?>