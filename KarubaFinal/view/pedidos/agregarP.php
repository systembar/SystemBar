<?php 


require_once '../../controller/pedido_controller.php';
require_once '../../controller/producto_controller.php';
require_once '../../model/model_produc_pedi.php';
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

$control = new Producto_Controller();
$producto = new Producto();
?>
<div class="row">
<div class="col s10" style="margin-top:5%;margin-left:35%;">
<table class="striped" style="width:50%; float:left;">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Foto</th>
            <th>Estado</th>
            <th>cantidad agregar</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <?php foreach ($control->listarP() as $r):?>
            <td>
                <?php echo $r->__GET('nombre'); ?>
            </td>
            <td>
                <?php echo $r->__GET('precio');?>
            </td>
            <td>
                <?php echo $r->__GET('foto');?>
            </td>
            <td>
                <?php echo $r->__GET('estado');?>
            </td>
            <td>

                <form action="agregar.php" method="post">
                    <input type="number" class="form-control" name="cantidad" style="width:90px; display:inline;background: #e0e0e0; border-radius:15px; height: 20px">

                    <input type="hidden" name="id_producto" value="<?php echo $r->__GET('id_producto'); ?>">
                    <input type="hidden" name="nombre" value="<?php echo $r->__GET('nombre'); ?>">
                    <input type="hidden" name="precio" value="<?php echo $r->__GET('precio'); ?>">
                    <input type="hidden" name="foto" value="<?php echo $r->__GET('foto'); ?>">
                    <input type="hidden" name="estado" value="<?php echo $r->__GET('estado'); ?>">
                    <input type="hidden" name="responsable" value="$session->cedula">
                    <input type="hidden" name="mesa" value="<?php echo $_GET["m"]; ?>">


                    <input type="submit" name="enviar" class="btn text-light" value="&#5161;" style="background: rgba(232, 63, 0, 0.8); width:30px; color:white">
                </form>

            </td>


        </tr>


    </tbody>
    <?php endforeach; ?>

</table>
</div>


<div class="container">
<!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger" href="#demo-modal" style="margin-top:0%;margin-left:24%; background:#f76100">Carrito <span class="lnr lnr-cart"></span><?php echo count($_SESSION["carrito"]);?></a>

  <!-- Modal Structure -->
  <div id="demo-modal" class="modal" style="background-color: white;">
    <div class="modal-content">
      <?php
$mesa=$_GET["m"];

if(isset($_SESSION["carrito"])){
    $carrito= $_SESSION["carrito"];
    

echo '<table class="striped" style="width:80%; float:left; margin-left:15%; ">';
    echo '<thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Foto</th>
            <th>Estado</th>
            <th>Cantidad</th>
            <th>SubTotal</th>
            <th>Eliminar</th>
        </tr>
    </thead>

    <tbody>';
   $i=0;
    $total=0;
    
     foreach ($carrito as $producto){
        echo '<tr>
            <td>'.$producto->__GET("nombre").'</td>
            <td>'.$producto->__GET("precio").'</td>
            <td>'.$producto->__GET("foto").'</td>
            <td>'.$producto->__GET("estado").'</td>
            <td>'.$producto->__GET("cantidad").'</td>
            <td>'.$producto->__GET("subTotal").'</td>';
            $total+=$producto->__GET("subTotal");
          
            echo '<td> <a href="eliminarPro.php?id='.$i.'&m='.$mesa.'"><span class="lnr lnr-trash" style="font-size:18px; color:red;"></span></a></td>';
            

    $i++;
        echo'</tr>'; }
        
        echo '<tr>
            <td colspan="5">Total</td>
            <td>Total:'.$total.'</td>';
            $_SESSION["total"]=$total;
        echo '</tr>';
     }
        echo '<tr>
            <td>
                <form action="generarPedido.php" method="POST">
                <input type="hidden" name="responsable" value="123">
                <input type="hidden" name="num_mesa" value="'.$_GET["m"].'">

                <input type="submit" class="btn" style="background:#f76100" value="Comprar">
                </form>
            </td>
        </tr>

    </tbody>';

   
echo'</table>';
?>
<div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-red btn brown darken-3"  >Close</a>
    </div>
    </div>
    
  </div>
</div>
<script>
$(document).ready(function(){
    $('.modal').modal();
  })
</script>

</div>

<?php 
    require_once '../template/footer.php';
?>

</body>

</html>
