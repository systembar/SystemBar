<?php
require_once "../../controller/pedido_controller.php";
require_once "../../model/model_pedido.php";
session_start();

$carrito= $_SESSION["carrito"];
$total= $_SESSION["total"];

$pedido = new Pedido();
$control= new Pedido_Controller;
$mesa=$_POST['num_mesa'];

$pedido->__SET('responsable',$_POST['responsable']);
$pedido->__SET('num_mesa',$mesa);

$control->insertar($pedido,$total,$mesa);

unset($_SESSION["carrito"]);
unset($_SESSION["total"]);
header("location:listar.php");

?>