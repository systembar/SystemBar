<?php 

require_once '../../controller/mesa_controller.php';
require_once '../../model/model_mesa.php';
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


$control = new Mesa_Controller();

?>

<div class="col s7">
  
   <p style="font-size: 30px; margin-left:-150px ;margin-top:10%;">Consultar Mesa</p>
            <a href="registrar.php"><input type="submit" value="Registrar" class="registrar2"></a>
    <table class="striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Modificar</th>
                <th>Pedido</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($control->listar() as $r):?>
                <td>
                    <?php echo $r->__GET('nombre'); ?>
                </td>
                <td>
                 <?php echo $r->__GET('estado')== 1 ? 'Disponible' : 'ocupada';?>
                </td>
                <td>
                     <button style="background:#f76100;" type="button" class="btn" onclick="window.location='estado.php?id=<?php echo $r->__GET('num_mesa');?>&estado=<?php echo $r->__GET('estado')?>'"><span class="lnr lnr-sync"></span></button>
                     
                     <a href="editar.php?id=<?php echo $r->num_mesa; ?>" class="btn btn-primary" style=" background:#171616"> <span class="lnr lnr-pencil"></span> </a>
                </td>
                <td>
                     <a href="../pedidos/agregarP.php?m=<?php echo $r->num_mesa;?>" class="btn btn-primary" style=" background:#171616">Hacer Pedido</a>
                </td>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>



</body>

</html>
