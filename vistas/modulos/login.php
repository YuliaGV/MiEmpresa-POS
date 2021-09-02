<div class="login-box">
<div class="login-logo">
    <a href=""><img src="vistas/img/plantilla/LogoPrincipal.png" alt="Logo"></a>
</div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión</p>

      <form method="post">

        <div class="input-group mb-3">
        <input type="user" name="user" class="form-control" placeholder="Nombre de usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="btningresar">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
       
        <?php  

        $login = new ControladorUsuarios(); 
        $login -> ctrIngresoUsuario();
        
        
        
        ?>




      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


