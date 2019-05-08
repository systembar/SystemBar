<?php 
require_once '../../controller/producto_controller.php';
require_once '../../model/model_producto.php';
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
$control = new producto_Controller();

?>

<div class="col s7">
  
   <p style="font-size: 30px; margin-left:-150px ;margin-top:10%;">Consultar Producto</p>
            <a href="registrar.php"><input type="submit" value="Registrar" id="btn_re"></a>
    <table class="striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Modificar</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($control->listar() as $r):?>
                <td>
                    <?php echo $r->__GET('nombre'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('precio'); ?>
                </td>
                <td>
                 <?php echo $r->__GET('estado')== 1 ? 'Activo' : 'Inactivo';?>
                </td>
                <td>
                     <button style="background:#f76100;" type="button" class="btn" onclick="window.location='estado.php?id=<?php echo $r->__GET('id_producto');?>&estado=<?php echo $r->__GET('estado')?>'"><span class="lnr lnr-sync"></span></button>
                     <a href="editar.php?id=<?php echo $r->__GET('id_producto')?>" class="btn" style=" background:#171616"> <span class="lnr lnr-pencil"></span> </a>
                </td>
        </tbody>

        <?php endforeach; ?>
    </table>
</div>

<?php
require_once '../template/footer.php';
 ?>

</body>

</html>
