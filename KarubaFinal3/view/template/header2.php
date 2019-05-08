
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
    <link rel="stylesheet" href="../../public/librerias/materialize/css/materialize.css">
    <script src="../../public/js/jquery-3.2.1.min.js"></script>
    <script src="../../public/librerias/materialize/js/materialize.js"></script>

    <link rel="stylesheet" href="../../public/js/modal.js">
    <script src="../../public/librerias/notify/sweetalert.min.js">
        
    </script>
    <script src="../../public/js/Validate.js"></script>
</head>

<body>
    <header class="header_admin">

        <ul>
         
            <li style="float:left;margin-left:3px;margin-top:6px;"> <a href="../../index.php">Bar-Karuba</a> </li>
            <li style="float:left; margin-left:3%;"><button onclick="myFunction()" class="boton"  style="margin-left:3%;"><span class="lnr lnr-menu icon-1" ></span></button>
</li>
            <li><a href="../../controller/CerrarSesion.php">Salir <span class="lnr lnr-exit icon"></span> </a></li>

        </ul>
    </header>

        <div class="col s4" id="myDIV">

            <nav class="main-menu">
                <img src="../../public/img/perfil.png " class="profile" alt="">
                <ul>

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
        <script>
function myFunction() {
  var x = document.getElementById('myDIV');
  if (x.style.visibility === 'hidden') {
    x.style.visibility = 'visible';
  } else {
    x.style.visibility = 'hidden';
  }
}
</script>
