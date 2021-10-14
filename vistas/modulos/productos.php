<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar productos</h1>
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

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            Nuevo producto
          </button>

          
        </div>

        <div class="card-body">

          <table class="table table-bordered table-striped dt-responsive tablaProductos">

            <thead>
              <tr>
                <th style="width:10px;">#</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Agregado</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>


            </tbody>


          </table>


          
        </div>

        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Modal para agregar productos -->

  <div id="modalAgregarProducto" class="modal fade" role="dialog"  >
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Nuevo producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group row">
                      <label for="nuevaCategoria" class="col-sm-3 col-form-label">Categoria</label>
                      <div class="col-sm-9">
                          <select class="form-control" id="nuevaCategoria" name="nuevaCategoria" required>
                            <option value="">Seleccionar categoría</option>

                            <?php

                            $item = null;
                            $valor = null;

                            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                            foreach ($categorias as $key => $value) {
                              
                              echo '<option value="'.$value["cat_id"].'">'.$value["cat_nombre"].'</option>';
                            }

                            ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="nuevoCodigo" class="col-sm-3 col-form-label">Código</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" readonly required>
                      </div>
                    </div>

                    
                    <div class="form-group row">
                      <label for="nuevaDescripcion" class="col-sm-3 col-form-label">Descripción</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" required>
                      </div>
                    </div>

                    

                    <div class="form-group row">
                      <label for="nuevoStock" class="col-sm-3 col-form-label">Stock</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nuevoStock" name="nuevoStock" required>
                      </div>
                    </div>


                    <div class="form-group row">

                      <div class="col-xs-12 col-sm-6">
                        <label for="nuevoPrecioCompra" class="col-form-label">Precio compra</label>
                        <div class="input-group">
                           <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" required>
                        </div>

                      </div>

                
                      <div class="col-xs-12 col-sm-6">
                        <label for="nuevoPrecioVenta" class="col-form-label">Precio venta</label>
                        <div class="input-group">
                          <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                        </div>
                        <br>

                        <div class="col-xs-6">
                          <div class="form-group">                        
                            <label>
                              <input type="checkbox" id="porcentaje" class="minimal porcentaje" checked>
                              Usar porcentaje
                            </label>
                          </div>
                        </div>

            

                        <div class="col-xs-6" style="padding:0">
                          <div class="input-group">                     
                            <input type="number" id="nuevoPorcentaje" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="form-group row">
                      <label for="nuevaImagen" class="col-sm-3 col-form-label">Imagen</label>
                      <div class="col-sm-9">
                        <input type="file" class="nuevaImagen" id="nuevaImagen" name="nuevaImagen" accept="image/*">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/productos/ProductoSinImagen.PNG" class="img-thumbnail previsualizar" width="100px">
                      </div>
                    </div>

            
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Guardar producto</button>
                </div>


                <?php

                  $crearProducto = new ControladorProductos();
                  $crearProducto -> ctrCrearProducto();

                ?>

                </form>     
                
                  
               
            </div>
      </div>
  </div> 

  <!-- Modal para editar productos -->

  <div id="modalEditarProducto" class="modal fade" role="dialog"  >
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Editar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                  <div class="box-body">


                    <div class="form-group row">
                      <label for="editarCategoria" class="col-sm-3 col-form-label">Categoria</label>
                      <div class="col-sm-9">
                          <select class="form-control"  name="editarCategoria" readonly required>
                            <option id="editarCategoria">Seleccionar categoría</option>

                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="editarCodigo" class="col-sm-3 col-form-label">Código</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="editarCodigo" name="editarCodigo" readonly required>
                      </div>
                    </div>

                    
                    <div class="form-group row">
                      <label for="editarDescripcion" class="col-sm-3 col-form-label">Descripción</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" required>
                      </div>
                    </div>

                    

                    <div class="form-group row">
                      <label for="editarStock" class="col-sm-3 col-form-label">Stock</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="editarStock" name="editarStock" required>
                      </div>
                    </div>


                    <div class="form-group row">

                      <div class="col-xs-12 col-sm-6">
                        <label for="editarPrecioCompra" class="col-form-label">Precio compra</label>
                        <div class="input-group">
                           <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>
                        </div>

                      </div>

                
                      <div class="col-xs-12 col-sm-6">
                        <label for="editarPrecioVenta" class="col-form-label">Precio venta</label>
                        <div class="input-group">
                          <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                        </div>
                        <br>

                        <div class="col-xs-6">
                          <div class="form-group">                        
                            <label>
                              <input type="checkbox" id="porcentaje" class="minimal porcentaje" checked>
                              Usar porcentaje
                            </label>
                          </div>
                        </div>

            

                        <div class="col-xs-6" style="padding:0">
                          <div class="input-group">                     
                            <input type="number" id="nuevoPorcentaje" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="form-group row">
                      <label for="editarImagen" class="col-sm-3 col-form-label">Imagen</label>
                      <div class="col-sm-9">
                        <input type="file" class="nuevaImagen" id="editarImagen" name="editarImagen" accept="image/*">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/productos/ProductoSinImagen.PNG" class="img-thumbnail previsualizar" width="100px">
                        <input type="hidden" name="imagenActual" id="imagenActual">
                      </div>
                    </div>

            
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Guardar producto</button>
                </div>


                <?php

                  $editarProducto = new ControladorProductos();
                  $editarProducto -> ctrEditarProducto();

                ?>

                </form>   
                
                
                <?php 

                $borrarProducto = new ControladorProductos();
                $borrarProducto-> ctrBorrarProducto();

                ?>
                
                  
               
            </div>
      </div>
  </div> 

  



</div>


