<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar categorías</h1>
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

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            Nueva Categoría
          </button>

          
        </div>

        <div class="card-body">

          <table class="table table-bordered table-striped dt-responsive tablas">

            <thead>
              <tr>
                <th style="width:10px;">#</th>
                <th>Categoría</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php

                $item = null;
                $valor = null;

                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {

                  echo '<tr>
                            <td>'.($value['cat_id']).'</td>
                            <td>'.($value['cat_nombre']).'</td>

                            <td> 
                            <div class="btn-group">
                            <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["cat_id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["cat_id"].'"><i class="fa fa-trash-alt"></i></button>
    
                          </div>  
                            </td>
                        </tr>';  
                        

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

  <div id="modalAgregarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Nueva categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post">

                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group row">
                      <label for="nuevaCategoria" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                      </div>
                    </div>

                   
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Guardar categoría</button>
                </div>

                <?php

                  $crearCategoria = new ControladorCategorias();
                  $crearCategoria -> ctrCrearCategoria();

                ?>

                </form>         
               
            </div>
        </div>
    </div> 

  <!-- Modal para editar usuarios -->

  <div id="modalEditarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Editar categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group row">
                      <label for="editarCategoria" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="hidden" id="idCategoria" name="idCategoria" value="">
                        <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value="">
                      </div>
                    </div>

                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Modificar categoría</button>
                </div>

                <?php

                  $editarCategoria = new ControladorCategorias();
                  $editarCategoria -> ctrEditarCategoria();

                ?>

              
                </form>

                
              <?php 

                $borrarCategoria = new ControladorCategorias();
                $borrarCategoria-> ctrBorrarCategoria();

              ?>
            

            </div>
        </div>
  </div> 


</div>


