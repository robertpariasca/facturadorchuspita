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
                <li class="nav-item"><a class="nav-link active" href="#Iniciales" data-toggle="tab">Datos Iniciales</a></li>
                <li class="nav-item"><a class="nav-link" href="#Contacto" data-toggle="tab">Datos de Contacto</a></li>
                <li class="nav-item"><a class="nav-link" href="#Flota" data-toggle="tab">Datos de Flota</a></li>
                <li class="nav-item"><a class="nav-link" href="#Conductor" data-toggle="tab">Datos de Conductor</a></li>
                <li class="nav-item"><a class="nav-link" href="#Productos" data-toggle="tab">Datos de Producto</a></li>
                <li class="nav-item"><a class="nav-link" href="#Planes" data-toggle="tab">Datos de Planes</a></li>
                <li class="nav-item"><a class="nav-link" href="#Atencion" data-toggle="tab">Lugares de Atencion</a></li>
                <li class="nav-item"><a class="nav-link" href="#Promociones" data-toggle="tab">Promociones - Creacion</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="Iniciales">
                  <div class="row justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Editar datos Iniciales - Proveedor</h3>
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
                <div class="tab-pane" id="Contacto">
                  <div class="row justify-content-center">
                    <div class="row col-12 justify-content-center">
                      <div class="box box-primary col-6">
                        <div class="box-header with-border">
                          <h3 class="box-title">Editar datos de contacto - Proveedor</h3>
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
                          <div class="input-group mb-3">
                            <select name="select" id="cbodepartamentousu" class="form-control">
                              <option value="000">Departamento</option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <select name="select" id="cboprovinciausu" class="form-control">
                              <option value="000">Provincia</option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <select name="select" id="cbodistritousu" class="form-control">
                              <option value="000">Distrito</option>
                            </select>
                          </div>
                          <div class="row justify-content-center">
                            <!-- /.col -->
                            <div class="col-6 justify-content-center">
                              <button class="mt-1 btn btn-primary" type="button" name="agregarContacto" id="agregarContacto" style="display: block; margin: 0 auto;">Cargar</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row col-12 justify-content-center">
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
                  </div>

                </div>
                <div class="tab-pane" id="Flota">
                  <div class="row justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Editar datos de Flota - Proveedor</h3>
                      </div>
                      <form id="frmActualizarUsuarioProFlota" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                          <input type="text" name="textTipoVehiculo" id="textTipoVehiculo" class="form-control" placeholder="Tipo Vehiculo">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textcapacidadKg" id="textcapacidadkg" class="form-control" placeholder="Capacidad (Kg.)" onkeypress="ValidaSoloNumerosYPunto();">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textPlaca" id="textPlaca" class="form-control" placeholder="Placa">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-map-marker-alt"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <select name="select" id="cbogps" class="form-control">
                            <option value="000"> GPS </option>
                            <option value="SI"> Cuenta con GPS </option>
                            <option value="NO"> No cuenta con GPS </option>
                          </select>

                        </div>
                        <div class="input-group mb-3">
                          <div class="form-group">
                            <label for="exampleInputFile">Agregar Foto Vehiculo</label>
                            <input type="file" accept="image/png,image/jpeg" id="fotoUsuario" name="fotoUsuario">
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <!-- /.col -->
                          <div class="col-6">
                            <button class="mt-1 btn btn-primary" type="button" name="agregarFlota" id="agregarFlota" style="display: block; margin: 0 auto;">Cargar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>

                    <div class="main-card mb-9 card">
                      <div class="card-body">
                        <h5 class="card-title">Flotas Asignadas</h5>
                        <div class="table-responsive">
                          <table id="cliflota" class="mb-0 table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th style="display:none;">Id Flota</th>
                                <th>Tipo Vehiculo</th>
                                <th>Capacidad</th>
                                <th>Placa</th>
                                <th>GPS</th>
                                <th>Imagen</th>
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
                </div>
                <div class="tab-pane" id="Conductor">
                  <div class="row justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Editar datos de Conductor - Proveedor</h3>
                      </div>
                      <form id="frmActualizarUsuarioProFlota" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                          <input type="text" name="textNroDocConductor" id="textNroDocConductor" class="form-control" placeholder="Numero Documento Conductor" onkeypress="ValidaSoloNumerosYPunto();">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textnomconductor" id="textnomconductor" class="form-control" placeholder="Nombre Conductor">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" name="textNroLicencia" id="textNroLicencia" class="form-control" placeholder="Nro Licencia">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-map-marker-alt"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" id="textNroTelefono" class="form-control" data-inputmask="'mask': ['999-999-999']" data-mask="" im-insert="true" placeholder="Telefono">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-group">
                            <label for="exampleInputFile">Agregar Foto Conductor</label>
                            <input type="file" accept="image/png,image/jpeg" id="fotoConductor" name="fotoConductor">
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <!-- /.col -->
                          <div class="col-6">
                            <button class="mt-1 btn btn-primary" type="button" name="agregarConductor" id="agregarConductor" style="display: block; margin: 0 auto;">Cargar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>

                    <div class="main-card mb-9 card">
                      <div class="card-body">
                        <h5 class="card-title">Conductores Asignados</h5>
                        <div class="table-responsive">
                          <table id="cliconductor" class="mb-0 table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th style="display:none;">Id Conductor</th>
                                <th>Nro Conductor</th>
                                <th>Nombre</th>
                                <th>Nro Licencia</th>
                                <th>Telefono</th>
                                <th>Imagen</th>
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
                </div>
                <div class="tab-pane" id="Productos">
                  <div class="row justify-content-center">
                    <div class="row col-12 justify-content-center">
                      <div class="box box-primary col-6">
                        <div class="box-header with-border">
                          <h3 class="box-title">Editar datos de Producto - Proveedor</h3>
                        </div>
                        <form id="frmActualizarUsuarioProFlota" enctype="multipart/form-data">
                          <div class="input-group mb-3">
                            <input type="text" name="textNombreProducto" id="textNombreProducto" class="form-control" placeholder="Nombre Producto">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <select name="select" id="cbotipprod" class="form-control">
                              <option value="000"> Tipo Producto </option>
                            </select>
                          </div>
                          <div class="row justify-content-center">
                            <!-- /.col -->
                            <div class="col-6">
                              <button class="mt-1 btn btn-primary" type="button" name="agregarProducto" id="agregarProducto" style="display: block; margin: 0 auto;">Cargar</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row col-12 justify-content-center">
                      <div class="main-card mb-9 card">
                        <div class="card-body">
                          <h5 class="card-title">Contactos Asignados</h5>
                          <div class="table-responsive">
                            <table id="cliproducto" class="mb-0 table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th style="display:none;">Cod Producto</th>
                                  <th>Nombre Producto</th>
                                  <th>Tipo</th>
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
                  </div>
                </div>
                <div class="tab-pane" id="Planes">
                  <div class="row justify-content-center">
                    <div class="row col-12 justify-content-center">

                      <div class="box box-primary col-6">
                        <div class="box-header with-border">
                          <h3 class="box-title">Seleccion de planes - Proveedor</h3>
                        </div>
                        <form id="frmActualizarUsuarioProFlota" enctype="multipart/form-data">
                          <div class="input-group mb-3">
                            <select name="select" id="cboplanesprod" class="form-control">
                              <option value="000"> Seleccione Plan </option>
                            </select>
                          </div>
                          <div class="row justify-content-center">
                            <!-- /.col -->
                            <div class="col-6">
                              <button class="mt-1 btn btn-primary" type="button" name="agregarSuscripcion" id="agregarSuscripcion" style="display: block; margin: 0 auto;">Cargar</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row col-12 justify-content-center">
                      <div class="main-card mb-6 card">
                        <div class="card-body">
                          <h5 class="card-title">Contactos Asignados</h5>
                          <div class="table-responsive">
                            <table id="cliplanes" class="mb-0 table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th style="display:none;">Cod Suscripcion</th>
                                  <th>Tipo Servicio</th>
                                  <th>Fecha Inicio</th>
                                  <th>Fecha Fin</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="Atencion">
                  <!--  <div class="row justify-content-center"> -->
                  <div class="row col-12 justify-content-center">
                    <div class="box box-primary col-6">
                      <div class="box-header with-border">
                        <h3 class="box-title">Lugares de Atencion - Proveedor</h3>
                      </div>
                      <form id="frmActualizarAtencion" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                          <select name="select" id="cbodepartamento" class="form-control">
                            <option value="00"> Todos los departamentos </option>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <select name="select" id="cboprovincia" class="form-control">
                            <option value="00"> Todas las provincias </option>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <select name="select" id="cbodistrito" class="form-control">
                            <option value="00"> Todos los distritos </option>
                          </select>
                        </div>
                        <div class="row justify-content-center">
                          <!-- /.col -->
                          <div class="col-6">
                            <button class="mt-1 btn btn-primary" type="button" name="agregarAtencion" id="agregarAtencion">Cargar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row col-12 justify-content-center">
                    <div class="main-card mb-6 card">
                      <div class="card-body">
                        <h5 class="card-title">Zonas Asignadas</h5>
                        <div class="table-responsive">
                          <table id="prozonas" class="mb-0 table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th style="display:none;">CodDepartamento</th>
                                <th>Departamento</th>
                                <th style="display:none;">CodProvincia</th>
                                <th>Provincia</th>
                                <th style="display:none;">CodDistrito</th>
                                <th>Distritos</th>
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
                  <!-- </div> -->
                </div>

                <div class="tab-pane" id="Promociones">
                  <div class="row justify-content-center">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#Lista" data-toggle="tab">Lista Promociones</a></li>
                          <li class="nav-item"><a class="nav-link" href="#Edicion" data-toggle="tab">Crear-Editar Promocion</a></li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="active tab-pane" id="Lista">
                            <div class="row col-12 justify-content-center">
                              <div class="main-card mb-6 card">
                                <div class="card-body">
                                  <h5 class="card-title">Zonas Asignadas</h5>
                                  <div class="table-responsive">
                                    <table id="propromo" class="mb-0 table">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Cod Promocion</th>
                                          <th>Promocion</th>
                                          <th>Costo Real</th>
                                          <th>Costo Promocion</th>
                                          <th>Fecha Creacion</th>
                                          <th>Fecha Fin Vigencia</th>
                                          <th>Stock Pedido</th>
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
                          </div>
                          <div class="tab-pane" id="Edicion">
                            <div class="row justify-content-center">
                              <div class="box box-primary col-6">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Editar datos Promocion</h3>
                                </div>
                                <form id="frmActualizarPromocion" enctype="multipart/form-data">
                                  <div class="input-group mb-3">
                                    <input type="text" name="textNomPromocion" id="textNomPromocion" class="form-control" placeholder="Nombre Promocion">
                                    <input type="text" name="textIdPromocion" id="textIdPromocion" class="form-control" hidden>
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="textarea" name="textDescripcionLarga" id="textDescripcionLarga" class="form-control" placeholder="Descripcion Larga">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" name="textcostoreal" id="textcostoreal" class="form-control" placeholder="Costo Real" onkeypress="ValidaSoloNumerosYPunto();">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" name="textdescuento" id="textdescuento" class="form-control" placeholder="Descuento" onkeypress="ValidaSoloNumerosYPunto();">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" name="textcostopromocion" id="textcostopromocion" class="form-control" placeholder="Costo Promocion" onkeypress="ValidaSoloNumerosYPunto();">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-map-marker-alt"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="fechaInicioVigencia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="Fecha Inicio Promocion">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="far fa-calendar-alt"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="fechaFinVigencia" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="Fecha Fin Promocion">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="far fa-calendar-alt"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="position-relative form-group"><label for="segmanitetip" class="">Tipo Publicidad</label>
                                      <div class="custom-checkbox custom-control"><input type="checkbox" id="tipopublic1" class="custom-control-input"><label class="custom-control-label" for="tipopublic1">Email</label><span id="servtotal1" class="text-muted"></span>
                                        <div id="servcosto1" style="display: none;"></div>
                                      </div>
                                      <div class="custom-checkbox custom-control"><input type="checkbox" id="tipopublic2" class="custom-control-input"><label class="custom-control-label" for="tipopublic2">Redes</label><span id="servtotal2" class="text-muted"></span>
                                        <div id="servcosto2" style="display: none;"></div>
                                      </div>
                                      <div class="custom-checkbox custom-control"><input type="checkbox" id="tipopublic3" class="custom-control-input"><label class="custom-control-label" for="tipopublic3">Sistema</label><span id="servtotal3" class="text-muted"></span>
                                        <div id="servcosto3" style="display: none;"></div>
                                      </div>
                                      <div class="custom-checkbox custom-control"><input type="checkbox" id="tipopublic4" class="custom-control-input"><label class="custom-control-label" for="tipopublic4">SMS</label><span id="servtotal4" class="text-muted"></span>
                                        <div id="servcosto4" style="display: none;"></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="text" name="textStockPedido" id="textStockPedido" class="form-control" placeholder="Stock Actual">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="form-group">
                                      <label for="fotoPromocion">Agregar Foto Promocion</label>
                                      <input type="file" accept="image/png,image/jpeg" id="fotoPromocion" name="fotoPromocion">
                                    </div>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-6" id="divagregarPromocion">
                                      <button class="mt-1 btn btn-primary" type="button" name="agregarPromocion" id="agregarPromocion" style="display: block; margin: 0 auto;">Actualizar</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="box box-primary col-8">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Zona Objetiva de Promocion</h3>
                                </div>
                                <div class="input-group mb-3">
                                  <select name="select" id="cbodepartamentoEdi" class="form-control">
                                    <option value="00"> Todos los departamentos </option>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <select name="select" id="cboprovinciaEdi" class="form-control">
                                    <option value="00"> Todas las provincias </option>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <select name="select" id="cbodistritoEdi" class="form-control">
                                    <option value="00"> Todos los distritos </option>
                                  </select>
                                </div>
                                <div class="row justify-content-center">
                                  <!-- /.col -->
                                  <div class="col-6" id="divagregarAtencionEdi">
                                    <button class="mt-1 btn btn-primary" type="button" name="agregarAtencionEdi" id="agregarAtencionEdi" style="display: block; margin: 0 auto;">Agregar Nueva Zona</button>
                                  </div>
                                  <div class="col-6" id="divagregarAtencionProm">
                                    <button class="mt-1 btn btn-primary" type="button" name="agregarAtencionProm" id="agregarAtencionProm" style="display: block; margin: 0 auto;">Agregar Zona</button>
                                  </div>
                                  <!-- /.col -->
                                </div>
                              </div>
                              <div class="main-card mb-9 card">
                                <div class="card-body">
                                  <h5 class="card-title">Zonas Asignadas</h5>
                                  <div class="table-responsive">
                                    <table id="clizonaEdi" class="mb-0 table">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th style="display:none;">CodDepartamento</th>
                                          <th>Departamento</th>
                                          <th style="display:none;">CodProvincia</th>
                                          <th>Provincia</th>
                                          <th style="display:none;">CodDistrito</th>
                                          <th>Distritos</th>
                                          <th>Opciones</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>

                              <div class="box box-primary col-8">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Detalles Promocion</h3>
                                </div>
                                <div class="input-group mb-3">
                                  <select name="select" id="cboproductos" class="form-control">
                                    <option value="000"> Elegir Producto </option>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" name="textCantProducto" id="textCantProducto" class="form-control" placeholder="Cantidad Producto" onkeypress="ValidaSoloNumerosYPunto();">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row justify-content-center">
                                  <!-- /.col -->
                                  <div class="col-6" id="divagregarDetalleEdi">
                                    <button class="mt-1 btn btn-primary" type="button" name="agregarDetalleEdi" id="agregarDetalleEdi" style="display: block; margin: 0 auto;">Agregar Nuevo Producto</button>
                                  </div>
                                  <div class="col-6" id="divagregarDetalleProm">
                                    <button class="mt-1 btn btn-primary" type="button" name="agregarDetalleProm" id="agregarDetalleProm" style="display: block; margin: 0 auto;">Agregar Producto</button>
                                  </div>
                                  <!-- /.col -->
                                </div>
                              </div>
                                <div class="main-card mb-9 card">
                                  <div class="card-body">
                                    <h5 class="card-title">Detalles Promocion</h5>
                                    <div class="table-responsive">
                                      <table id="detpromoedi" class="mb-0 table">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th style="display:none;">CodProducto</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Opciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>


                              <div class="col-12" id="divagregarPromocionNueva">
                                <div class="col-2" style="float:right" >
                                <input type="text" name="textmontototal" id="textmontototal" class="form-control" placeholder="Cobro Total">
                                </div>
                              </div>


                              <div class="col-6" id="divagregarPromocionNueva">
                                <button class="mt-1 btn btn-primary" type="button" name="agregarPromocionNueva" id="agregarPromocionNueva" style="display: block; margin: 0 auto;">Crear Promocion</button>
                              </div>
                              <div class="col-6" id="divagregarlimpiarPromocion">
                                <button class="mt-1 btn btn-danger" type="button" name="limpiarPromocion" id="limpiarPromocion" style="display: block; margin: 0 auto;">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
          <script src="js/edicion.usuarios.proveedor.js" type="text/javascript"></script>
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