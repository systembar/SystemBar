<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="../../public/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../../public/librerias/notify/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/tablas.css">
    <link rel="stylesheet" href="../../public/librerias/icon/style.min.css">
    <link rel="stylesheet" href="../../public/css/estilos.css">
    <link rel="stylesheet" href="../../public/css/style4.css">
    <link rel="stylesheet" href="../../public/librerias/materialize/css/materialize.css">
    <script src="../../public/js/jquery-3.2.1.min.js"></script>
    <script src="../../public/js/move.js"></script>
    <script src="../../public/js/script2.js"></script>
    <script src="../../public/librerias/materialize/js/materialize.js"></script>

    <link rel="stylesheet" href="../../public/js/modal.js">
    <script src="../../public/librerias/notify/sweetalert.min.js"></script>
</head>

<body ontouchmove="myFunction(event)">
    <header class="header_admin">

        <ul>
            <li style="float:left; "><img src="../../public/img/logo.png" White="20px" height="40px" style="margin-left:8%; " alt=""></li>
            <li style="float:left;margin-left:3px;margin-top:6px;"> <a href="../../index.php">Bar-Karuba</a> </li>
            <li><a href="../../controller/CerrarSesion.php">Salir <span class="lnr lnr-exit icon"></span> </a></li>

        </ul>
    </header>
  <nav class="menu">
            <ul>
                <li><a href="../user/listar.php">Usuarios</a></li>
                <li><a href="../productos/listar.php">Productos</a></li>
                <li><a href="../mesas/listar.php">Mesas</a></li>
                <li><a href="../pedidos/listar.php">Pedido</a></li>
            </ul>
        </nav>
    <div class="row">
        <div class="col s4">

            <nav class="main-menu">
                <img src="../../public/img/perfil.png " class="profile" alt="">
                <ul>
                    <li>
                        <a href="../user/listar.php">
                            <i class="fa fa-home fa-2x"></i>

                            <span class="nav-text ">
                                <span class="lnr lnr-users icon"></span>
                                Usuarios
                            </span>

                        </a>

                    </li>
                    <li class="has-subnav">
                        <a href="../productos/listar.php">
                            <i class="fa fa-laptop fa-2x"></i>
                            <span class="nav-text">
                                <span class="lnr lnr-store icon"></span>
                                Productos
                            </span>
                        </a>

                    </li>
                    <li class="has-subnav">
                        <a href="../mesas/listar.php">
                            <i class="fa fa-list fa-2x"></i>
                            <span class="nav-text">
                                <span class="lnr lnr-license icon"></span>
                                Mesas
                            </span>
                        </a>

                    </li>
                    <li>
                        <a href="../pedidos/listar.php">
                            <i class="fa fa-map-marker fa-2x"></i>
                            <span class="nav-text">
                                <span class="lnr lnr-cart icon"></span>
                                Pedidos
                            </span>
                        </a>
                    </li>

                </ul>

            </nav>



        </div>
