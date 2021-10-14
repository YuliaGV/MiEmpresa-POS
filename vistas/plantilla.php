<?php

session_start();

?>


<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MiEmpresa-POS</title>

    <link rel="icon" href="vistas\img\plantilla\LogoMini.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="vistas/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vistas/plugins/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vistas/plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"> 

    <link rel="stylesheet"  type="text/css" href=" vistas/plugins/datatables-responsive/css/responsive.bootstrap4.css"> 

    <link rel="stylesheet"  type="text/css" href="vistas/plugins/sweetalert2/sweetalert2.min.css"> 

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">


    <link rel="stylesheet" href="vistas/css/styles.css">


    <!-- jQuery -->
    <script src="vistas/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vistas/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/dist/js/adminlte.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="vistas/plugins/datatables/datatables.js"></script>

    <script type="text/javascript" src="vistas/plugins/datatables-responsive/js/dataTables.responsive.js"></script> 

    <!-- SweetAlert JS -->
    <script type="text/javascript" src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script> 

    <!-- iCheck 1.0.1 -->
    <script src="vistas/plugins/iCheck/icheck.min.js"></script>






</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->


    <?php  

       if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok"){

          echo '<div class="wrapper">';


          include "modulos/header.php";
          include "modulos/sidebar.php";

          if(isset($_GET['ruta'])){

              if($_GET['ruta'] == 'inicio' ||
                  $_GET['ruta'] == 'usuarios' ||
                  $_GET['ruta'] == 'categorias' ||
                  $_GET['ruta'] == 'productos' ||
                  $_GET['ruta'] == 'clientes' ||
                  $_GET['ruta'] == 'ventas' ||
                  $_GET['ruta'] == 'crear-venta' ||
                  $_GET['ruta'] == 'reportes' ||
                  $_GET['ruta'] == 'salir' 

              ){
                  include "modulos/".$_GET['ruta'].".php";
              }
              else{
                  include "modulos/404.php";
              }

          }else{
              include "modulos/inicio.php";
          }


          include "modulos/footer.php";

          echo '</div>';


       }else{

           echo '<div class="hold-transition login-page">';

           include "modulos/login.php";

           echo '</div>';

       }

        

    ?>





<script src="vistas/js/plantilla.js"></script>

<script src="vistas/js/usuarios.js"></script>

<script src="vistas/js/categorias.js"></script>

<script src="vistas/js/productos.js"></script>



</body>

</html>
