 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-gray-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="inicio" class="nav-link text-white">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 

        <li class="nav-item user-menu">
					
					<a class="nav-link" href="#">

					<?php


              $item = "us_id";
              $valor = $_SESSION["us_id"];

              $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

              if($usuarios["us_foto"]){

                echo '<img src="'.$usuarios["us_foto"].'" class="user-image" alt="User Image">';

              }else{

                echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image" alt="User Image">';

              }

              
              if($usuarios["us_nombre"] ){
                echo '<span class="hidden-xs text-white"">'.$usuarios["us_nombre"].'</span>';
              } else {
                echo '<span class="hidden-xs text-white"">Usuario</span>';
              }
              
                

					?>

					</a>


				</li>


        <li class="nav-item user-menu">
            <a class="nav-link text-white" href="salir" role="button">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>


    </ul>
  </nav>
  <!-- /.navbar -->
