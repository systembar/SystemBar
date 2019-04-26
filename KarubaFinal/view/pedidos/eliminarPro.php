<?php
$index=$_GET["id"];
session_start();
if(isset($_SESSION["carrito"])){
    $carrito= $_SESSION["carrito"];
    unset($carrito[$index]);
        $carrito=array_values($carrito);

    $_SESSION["carrito"]=$carrito;
    if(count($_SESSION["carrito"])==0){
        unset($_SESSION["carrito"]);
    }

}
$mesa=$_GET["m"];
header("Location: agregarP.php?m=$mesa");

?>