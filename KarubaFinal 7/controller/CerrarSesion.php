<?php  
include '../model/model_user.php';
session_start();
//error_reporting(0);
$session= $_SESSION['usuario'];

if ($session->cedula == null || $session->cedula= '' ){
    echo 'Usted no tiene autorizacion';
    die();
}
session_destroy();
    header("Location:../view/gestion/vlogin.php");

?>
