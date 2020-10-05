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
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Crear Producto</a></li>
                                <li class="nav-item"><a class="nav-link" href="#listar" data-toggle="tab">Listar Productos</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row justify-content-center">
                                        <div class="box box-primary col-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Crear Producto</h3>
                                            </div>
                                            <form id="frmGrabarProducto">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="textcodigo" id="textcodigo" class="form-control" required="" placeholder="Codigo">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-barcode"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="textdescripcion" id="textdescripcion" class="form-control" required="" placeholder="Descripcion">
                                                    <input type="text" name="textcodproducto" id="textcodproducto" class="form-control" hidden>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-box"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select id="opccategoria" class="form-control">
                                                        <option id="000" value="000">Seleccione categoria</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select id="opctipo" class="form-control">
                                                        <option id="000" value="000">Seleccione tipo</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select id="opcmarca" class="form-control">
                                                        <option id="000" value="000">Seleccione marca</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select id="opcenvase" class="form-control">
                                                        <option id="000" value="000">Seleccione envase</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select id="opcmedida" class="form-control">
                                                        <option id="000" value="000">Seleccione unidad de medida</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="textprecio" id="textprecio" class="form-control" required="" placeholder="Precio" onkeypress="ValidaSoloNumerosYPunto();">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-dollar-sign"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tipoigv" id="chkafecta" value="0" checked>
                                                        <label class="form-check-label" for="chkafecta">
                                                            Afecta IGV
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tipoigv" id="chkafectano" value="1">
                                                        <label class="form-check-label" for="chkafectano">
                                                            No Afecta IGV
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-12">
                                                        <button type="submit" id="btngrabar" class="btn btn-primary btn-block btn-flat">Grabar</button>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="listar">
                                    <div class="row justify-content-center">
                                        <div class="row col-12 justify-content-center">
                                            <div class="main-card mb-9 card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Listar Productos</h5>
                                                    <div class="table-responsive">
                                                        <table id="tblproducto" class="mb-0 table">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th style="display:none;">Cod Producto</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Precio</th>
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
                            </div>
                        </div>

                    </div>


                    <!--<?php include_once 'pie.view.php'; ?>-->

                    <!-- Control Sidebar -->

                    <!-- /.control-sidebar -->
                    <div class="control-sidebar-bg"></div>

                    <!-- ./wrapper -->
                    <?php include_once 'scripts.view.php'; ?>
                    <script src="js/edicion.productos.js" type="text/javascript"></script>
                    <!--<script src="js/grabar.producto.js" type="text/javascript"></script>-->
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