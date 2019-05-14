<?php 
require_once '../../controller/producto_controller.php';
require_once '../../model/model_producto.php';
require_once '../../model/model_user.php';

$producto = new Producto();
$control = new Producto_Controller();

require_once '../template/header.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="librerias/icon/style.min.css">


</head>
<div class="migas">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Registrar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol>
    </nav>
</div>

<div class="formulario">
    <img src="../../img/logo.png" width="80" height="80">


    <form action="#" method="post">
   
        <label for="num_producto">Nombre de producto</label>
        <input type="text" placeholder="ingrese el nombre del producto" class="campo"  name="nombre">
        <label for="num_producto">Precio de producto</label>
        <input type="number" placeholder="ingrese el precio del producto" class="campo"  name="precio">

        <input type="submit" value="REGISTRAR" id="btn_formulario" name="enviar">

    </form>
    <?php 
            if (isset($_POST['enviar'])) {


                $producto->__SET('nombre',$_POST['nombre']);
                $producto->__SET('precio', $_POST['precio']);
                
                if ($control->insertar($producto)) {
                    echo "datos  ingresados con exito";
                }
            } ?>
</div>

<!-- Footer -->
<footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/"> KarubaBar</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="js/script.js"></script>



</body>

</html>