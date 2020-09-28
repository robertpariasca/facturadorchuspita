<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Facturador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once 'estilos.view.php'; ?>
</head>
<style>

  #inicioSesion{
            padding: 90px 0px 190px 0px;
        }

</style>
<body class="hold-transition register-page">
<div class="login-box" id="inicioSesion">
  <!-- /.login-logo -->
  <div class="card">
    <div class="">
      <div class="login-logo">
          <img src="../images/birdy.png" class="img img-responsive center-block" width="200"><br/>
        <!-- <img src="../images/user3.jpg" class="img img-responsive center-block" width="150"> -->
      </div>
        <div class="card-body login-card-body" style="display:block;" id = "iniciarSesion">
          <div class="card-body login-card-body">

            <form id="frmgrabar">
              <div class="input-group mb-3">
                <input type="text" class="form-control" id = "txtEmail" name = "txtEmail" placeholder="Usuario" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id = "txtClave" name = "txtClave"  placeholder="Password" required="true">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-10">
                  <div class="icheck-info">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Mantener la sesión iniciada
                    </label>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-10">
                    <small>
                      ¿No tiene una cuenta?<a href="#" onclick="mostrarR()"> Regístrate</a>
                    </small>
                </div>
                <!-- /.col -->
              </div><br/>
              <div class="row">
                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-info btn-block btn-info">Iniciar sesión</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
        </div>
<!--
        <div class="" style="display:none;" id = "elegirtipoCuenta">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Eliga que usuario quiere crear.</p>

            <div class="input-group mb-3">
              <button type="button" class="btn btn-block bg-gradient-primary btn-lg" onclick="mostrarC()">Cliente</button>
              <button type="button" class="btn btn-block bg-gradient-primary btn-lg" onclick="mostrarP()">Proveedor</button>
            </div>

<br/>
          <div class="row">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-default col-lg-6" onclick="mostrarI()" ><ion-icon name="arrow-back-outline" size="small"></ion-icon></button> 
            </div>
          </div>
        </div>

      </div>

        <div class="" style="display:none;" id = "registrarCuentaCliente">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Registrar nueva cuenta - Cliente</p>

          <form id="frmgrabarUsuarioCli">
          <div class="input-group mb-3">
          <select id= "opcdoccli" class="form-control">
                <option id="000" value="000">Seleccione tipo de documento</option>
                <option id="DNI" value="01">DNI</option>
                <option id="RUC" value="06">RUC</option>
          </select>
          </div>
            <div class="input-group mb-3">
              <input type="text" name="textdoccli" id="textdoccli" class="form-control" required="" maxlength="11"
                     onkeypress="ValidaSoloNumeros();" disabled>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="textNombreCompletoCli" id="textNombreCompletoCli" class="form-control" placeholder="Nombre completo">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="textUsuarioCli" id="textUsuarioCli" class="form-control" placeholder="Usuario">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="textPasswordCli" id="textPasswordCli" class="form-control" placeholder="Contraseña">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
              </div>
            </div>
          </form><br/>
          <div class="row">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-default col-lg-6" onclick="mostrarR()" ><ion-icon name="arrow-back-outline" size="small"></ion-icon></button> 
            </div>
          </div>
        </div>
      </div>

      <div class="" style="display:none;" id = "registrarCuentaProveedor">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Registrar nueva cuenta - Proveedor</p>

          <form id="frmgrabarUsuarioPro">
          <div class="input-group mb-3">
          <select id= "opcdocpro" class="form-control">
                <option id="000" value="000">Seleccione tipo de documento</option>
                <option id="DNI" value="01">DNI</option>
                <option id="RUC" value="06">RUC</option>
          </select>
          </div>
            <div class="input-group mb-3">
              <input type="text" name="textdocpro" id="textdocpro" class="form-control" required="" maxlength="11"
                     onkeypress="ValidaSoloNumeros();" disabled>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="textNombreCompletoPro" id="textNombreCompletoPro" class="form-control" placeholder="Nombre completo">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="textUsuarioPro" id="textUsuarioPro" class="form-control" placeholder="Usuario">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="textPasswordPro" id="textPasswordPro" class="form-control" placeholder="Contraseña">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
              </div>
            </div>
          </form><br/>
          <div class="row">
            <div class="col-12 text-center">
              <button type="button" class="btn btn-default col-lg-6" onclick="mostrarR()" ><ion-icon name="arrow-back-outline" size="small"></ion-icon></button> 
            </div>
          </div>
        </div>
      </div>
-->
    </div>
  </div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  

<!-- ./wrapper -->
<?php include_once 'scripts.view.php'; ?>
<script src="js/sesionValidar.js" type="text/javascript"></script>
<script src="js/registrate.cliente.js" type="text/javascript"></script>
<script src="js/registrate.proveedor.js" type="text/javascript"></script>
<!--<script src="js/index.js" type="text/javascript"></script>
<script src="js/cbCodigo.js" type="text/javascript"></script>-->
</body>
</html>
