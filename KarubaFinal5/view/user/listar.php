<?php 

require_once '../../controller/user_controller.php';
require_once '../../model/model_user.php';
require_once '../../model/conexion.php';

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
$control = new User_Controller();

?>

<div class="col s7">
  
   <p class="titulos">Consultar Usuario</p>
            <a href="registrar.php"><input type="submit" value="Registrar" class="registrar2"></a>
    <table class="striped">
        <thead>
            <tr>
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Celular</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Permiso</th>
                <th>Estado</th>
                <th>Estado/Editar</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($control->listar() as $r):?>
                <td>
                    <?php echo $r->__GET('tipo_documento'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('cedula'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('nombre'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('apellido');?>
                </td>
                <td>
                    <?php echo $r->__GET('telefono');?>
                </td>
                <td>
                    <?php echo $r->__GET('celular'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('usuario'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('correo'); ?>
                </td>
                <td>
                    <?php echo $r->__GET('tipo_usuario'); ?>
                </td>

                <td>
                 <?php echo $r->__GET('estado')== 1 ? 'Activo' : 'Inactivo';?>
                </td>
                <td>
                     <button style="background:#f76100;" type="button" class="btn" onclick="window.location='estado.php?id=<?php echo $r->__GET('cedula');?>&estado=<?php echo $r->__GET('estado')?>'"><span class="lnr lnr-sync"></span></button>
                     <a href="editar.php?id=<?php echo $r->cedula; ?>" class="btn btn-primary" style=" background:#171616"> <span class="lnr lnr-pencil"></span> </a>
                </td>
        </tbody>

        <?php endforeach; ?>
    </table>
</div>



</body>

</html>
