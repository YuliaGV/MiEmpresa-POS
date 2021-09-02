<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        <div class="card-header">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Nuevo usuario
          </button>

          
        </div>

        <div class="card-body">

          <table class="table table-bordered table-striped dt-responsive tablas">

            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Último login</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php

                $item = null;
                $valor = null;

                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                foreach ($usuarios as $key => $value) {

                  echo "<tr>";

                    echo '<td>'.$value["us_id"].'</td>';

                    echo '<td>'.$value["us_nombre"].'</td>';

                    echo '<td>'.$value["us_usuario"].'</td>';

                    if($value["us_foto"] != ""){
                      echo '<td><img src="'.$value["us_foto"].'" class="img-thumbnail" width="40px"></td>';
                    }else{
                      echo '<td><img src="vistas/img/usuarios/anonymous.png" class="img-thumbnail" width="40px"></td>';
                    }
  
                    echo '<td>'.$value["us_perfil"].'</td>';
  
                    if($value["us_estado"] != 0){
                      echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["us_id"].'" estadoUsuario="0">Activado</button></td>';
                    }else{
                      echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["us_id"].'" estadoUsuario="1">Desactivado</button></td>';
  
                    }             
  
                    echo '<td>'.$value["us_ultimologin"].'</td>';

                    echo '<td> 
                    
                      <div class="btn-group">
                  
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["us_id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["us_id"].'" fotoUsuario="'.$value["us_foto"].'" usuario="'.$value["us_usuario"].'"><i class="fa fa-trash-alt"></i></button>

                      </div>
                    
                    </td>';


                  echo "</tr>";        


                }

              ?>

            </tbody>


          </table>


          
        </div>

        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Modal para agregar usuarios -->

  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Nuevo usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group row">
                      <label for="nuevoNombre" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevoUsuario" class="col-sm-2 col-form-label">Usuario</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="nuevoUsuario" name="nuevoUsuario">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevoPassword" class="col-sm-2 col-form-label">Clave</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control input-lg" id="nuevoPassword" name="nuevoPassword">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevoPerfil" class="col-sm-2 col-form-label">Perfil</label>
                      <div class="col-sm-10">
                        <select class="form-control input-lg" name="nuevoPerfil" id="nuevoPerfil">                   
                          <option value="">Seleccionar perfil</option>
                          <option value="Administrador">Administrador</option>
                          <option value="Especial">Especial</option>
                          <option value="Vendedor">Vendedor</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevaFoto" class="col-sm-2 col-form-label">Foto</label>
                      <div class="col-sm-10">
                        <input type="file" class="nuevaFoto" id="nuevaFoto" name="nuevaFoto" accept="image/*">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                      </div>
                    </div>

                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Guardar usuario</button>
                </div>


                <?php 

                  $crearUsuario = new ControladorUsuarios();
                  $crearUsuario -> ctrCrearUsuario();


                ?>


                </form>
             
            </div>
        </div>
    </div> 

  <!-- Modal para editar usuarios -->

  <div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Editar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group row">
                      <label for="editarNombre" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="editarUsuario" class="col-sm-2 col-form-label">Usuario</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="editarPassword" class="col-sm-2 col-form-label">Clave</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control input-lg" id="editarPassword" name="editarPassword" placeholder="Nueva contraseña">
                        <input type="hidden" id="passwordActual" name="passwordActual">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="editarPerfil" class="col-sm-2 col-form-label">Perfil</label>
                      <div class="col-sm-10">
                        <select class="form-control input-lg" name="editarPerfil">                   
                          <option value="" id="editarPerfil"></option>
                          <option value="Administrador">Administrador</option>
                          <option value="Especial">Especial</option>
                          <option value="Vendedor">Vendedor</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevaFoto" class="col-sm-2 col-form-label">Foto</label>
                      <div class="col-sm-10">
                        <input type="file" class="nuevaFoto" name="editarFoto" accept="image/*">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img class="previsualizar" src="vistas/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                        <input type="hidden" name="fotoActual" id="fotoActual">
                      </div>
                    </div>

                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Modificar usuario</button>
                </div>

               
                <?php 

                  $editarUsuario = new ControladorUsuarios();
                  $editarUsuario -> ctrEditarUsuario();


                ?>

              
                </form>
             
            </div>
        </div>
  </div> 

    <?php 

        $borrarUsuario = new ControladorUsuarios();
        $borrarUsuario -> ctrBorrarUsuario();


    ?>
  



  






</div>


