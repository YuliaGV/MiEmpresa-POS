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

					if($_SESSION["us_foto"] != ""){
						echo '<img src="'.$_SESSION["us_foto"].'" class="user-image">';
					}else{
						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
					}
					?>
						<span class="hidden-xs text-white"><?php  echo $_SESSION["us_nombre"]; ?></span>

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
