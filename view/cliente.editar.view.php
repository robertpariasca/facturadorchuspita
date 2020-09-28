<?php
require_once 'validar.datos.sesion.view.php';
$_POST["s_usuario"] = $dniSesion;


//require_once '../controller/perfil.usuario.leer.datos.controller.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../images/birdy.png">
  <title> Facturador | Edicion</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include_once 'estilos.view.php'; ?>
</head>

<body class="hold-transition skin-purple-light sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <?php include_once './menu-arriba.admin.view.php'; ?>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <?php include_once 'menu-izquierda.admin.view.php'; ?>

    <!-- =============================================== -->
    <div class="content-wrapper">
      <div class="row justify-content-center">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Datos Iniciales</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Datos de Contacto</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <div class="row justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Editar datos Iniciales - Cliente</h3>
                      </div>
                      <form id="frmActualizarUsuarioCli">
                        <div class="input-group mb-3">
                          <select id="opcdoccli" class="form-control">
                            <option id="000" value="000">Seleccione tipo de documento</option>
                            <option id="DNI" value="01">DNI</option>
                            <option id="RUC" value="06">RUC</option>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textdoccli" id="textdoccli" class="form-control" required="" maxlength="11" placeholder="DNI" onkeypress="ValidaSoloNumeros();">
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
                          <div class="form-group">
                            <label for="exampleInputFile">Agregar Foto</label>
                            <input type="file" accept="image/png,image/jpeg" id="fotoUsuarioimagen" name="fotoUsuarioimagen">
                          </div>
                        </div>
                        <!--
             <div class="input-group mb-3">
               <input type="text" name="textDireccionCli" id="textDireccionCli" class="form-control" placeholder="Direccion">
               <div class="input-group-append">
                 <div class="input-group-text">
                   <span class="fas fa-map-marker-alt"></span>
                 </div>
               </div>
             </div>
             <div class="input-group mb-3">
                     <input type="text" class="form-control" id="fechaNacCli" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="Fecha Nacimiento">
                     <div class="input-group-append">
                       <div class="input-group-text">
                   <span class="far fa-calendar-alt"></span>
                 </div>
               </div>
             </div>
             <div class="input-group mb-3">
               <input type="email" name="textEmailCli" id="textEmailCli" class="form-control" placeholder="Email">
               <div class="input-group-append">
                 <div class="input-group-text">
                   <span class="fas fa-envelope"></span>
                 </div>
               </div>
             </div>
             <div class="input-group mb-3">
             <input type="text" id="telCli" class="form-control" data-inputmask="'mask': ['999-999-999']" data-mask="" im-insert="true" placeholder="Telefono">
               <div class="input-group-append">
                 <div class="input-group-text">
                   <span class="fas fa-phone"></span>
                 </div>
               </div>
             </div>
 -->
                        <div class="row">
                          <!-- /.col -->
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <div class="row justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Editar datos de contacto - Cliente</h3>
                      </div>
                      <form id="frmActualizarUsuarioCliContacto">
                        <div class="input-group mb-3">
                          <input type="text" name="textNombreCompletoCliContacto" id="textNombreCompletoCliContacto" class="form-control" placeholder="Nombre Contacto">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textCargoCliContacto" id="textCargoCliContacto" class="form-control" placeholder="Cargo Contacto">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textDireccionCliContacto" id="textDireccionCliContacto" class="form-control" placeholder="Direccion">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-map-marker-alt"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" id="telCliContacto" class="form-control" data-inputmask="'mask': ['999-999-999']" data-mask="" im-insert="true" placeholder="Telefono">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-phone"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="email" name="textEmailCliContacto" id="textEmailCliContacto" class="form-control" placeholder="Email">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <!-- /.col -->
                          <div class="col-6">
                              <button class="mt-1 btn btn-primary" type="button" name="agregarContacto" id="agregarContacto">Cargar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>

                    <div class="main-card mb-9 card">
                      <div class="card-body">
                        <h5 class="card-title">Contactos Asignados</h5>
                        <div class="table-responsive">
                          <table id="clicontacto" class="mb-0 table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Nom Contacto</th>
                                <th>Cargo Contacto</th>
                                <th>Direccion</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>
          </div>


          <!--<?php include_once 'pie.view.php'; ?>-->

          <!-- Control Sidebar -->

          <!-- /.control-sidebar -->
          <div class="control-sidebar-bg"></div>

          <!-- ./wrapper -->
          <?php include_once 'scripts.view.php'; ?>
          <script src="js/edicion.usuarios.js" type="text/javascript"></script>
          <script src="js/actualizar.cliente.js" type="text/javascript"></script>
          <!--<script src="js/gestionarTratamiento.js" type="text/javascript"></script>-->


          <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->

</body>

</html>