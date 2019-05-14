<?php
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../../css/perfil.css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>




    <div class="perfil col-md-11">
        <div class="row">
            <div class="col-xs-12 col-sm-9">

                <!-- User profile -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Perfil de usuario</h4>
                    </div>
                    <div class="panel-body">
                        <div class="profile__avatar">
                            <img src="../public/images/carito.jpg">
                        </div>
                        <div class="profile__header">
                            <h4>Carolina Gomez <small>Administrator</small></h4>
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non nostrum odio cum repellat veniam eligendi rem cumque magnam autem delectus qui.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- User info -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Informacion</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table profile__table">
                            <tbody>
                                <tr>
                                    <th><strong>Documento</strong></th>
                                    <td>12332432</td>
                                </tr>
                                <tr>
                                    <th><strong>Nacimiento</strong></th>
                                    <td>00/00/0000</td>
                                </tr>

                                <tr>
                                    <th><strong>Direccion</strong></th>
                                    <td>cra 123 # 23-11</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Community -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Community</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table profile__table">
                            <tbody>
                                <tr>
                                    <th><strong>Comments</strong></th>
                                    <td>58584</td>
                                </tr>
                                <tr>
                                    <th><strong>Member since</strong></th>
                                    <td>Jan 01, 2016</td>
                                </tr>
                                <tr>
                                    <th><strong>Last login</strong></th>
                                    <td>1 day ago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-3">

                <!-- Contact user -->
                <p>
                    <a href="#" class="profile__contact-btn btn btn-lg btn-block btn-info" data-toggle="modal" data-target="#profile__contact-form">
                        Contactar
                    </a>
                </p>

                <hr class="profile__contact-hr">

                <!-- Contact info -->
                <div class="profile__contact-info">
                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="lnr lnr-phone"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">Telefono</h5>
                            (000)987-65-43
                        </div>
                    </div>
                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="lnr lnr-phone-handset"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">Celular</h5>
                            (000)987-65-43
                        </div>
                    </div>
                    <div class="profile__contact-info-item">
                        <div class="profile__contact-info-icon">
                            <i class="lnr lnr-envelope"></i>
                        </div>
                        <div class="profile__contact-info-body">
                            <h5 class="profile__contact-info-heading">E-mail</h5>
                            <a href="mailto:admin@domain.com">carito123@gmail.com</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
