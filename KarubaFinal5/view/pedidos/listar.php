<?php 
require_once '../../controller/pedido_controller.php';
require_once '../../model/model_pedido.php';
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

?>

<div class="col s7">
  
   <p style="font-family: fantasy; font-size: 30px; margin-left:-150px ;margin-top:10%;">Consultar Pedido</p>
            <a href="../mesas/listar.php"><input type="submit" value="Registrar" class="registrar2"></a>
    <table class="striped">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Numero Mesa</th>
                <th>Responsable</th>
                <th>Subtotal</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Estado/Detalles</th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($control->listar() as $r):?>
                <td>
                    <?php echo $r->__GET('id_pedido'); ?>
                </td>

                <td>
                    <?php echo $r->__GET('fecha'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('num_mesa'); ?>
                </td>

                <td>
                    <?php echo $r->__GET('responsable');?>
                </td>
                <td>
                    <?php echo $r->__GET('subtotal');?>
                </td>
                <td>
                    <?php echo $r->__GET('descuento');?>
                </td>
                <td>
                    <?php echo $r->__GET('total'); ?>
                </td>
                <td>
                 <?php echo $r->__GET('estado')== 1 ? 'Por Cancelar' : 'Cancelado';?>
                </td>
                <td>
                     <button style="background:#f76100;" type="button" class="btn" onclick="window.location='estado.php?id=<?php echo $r->__GET('id_pedido');?>&estado=<?php echo $r->__GET('estado')?>'"><span class="lnr lnr-sync"></span></button>
                     
                     <a href="mostrar_detalles.php?id=<?php echo $r->id_pedido; ?>" class="btn btn-primary" style=" background:#171616"> <span class="lnr lnr-eye"></span> </a>
                     
                </td>
        </tbody>


        <?php endforeach; ?>
    </table>
</div>



</body>

</html>
