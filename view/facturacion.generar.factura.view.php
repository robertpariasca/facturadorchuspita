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
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
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
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generar Documento</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row justify-content-center">
                                        <div class="box box-primary col-6">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Generar Documento Electronico</h3>
                                            </div>
                                            <form id="frmGenerarDocumento">
                                                <div class="input-group mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tipodoc" id="tipodocbol" value="03" checked>
                                                        <label class="form-check-label" for="tipodocbol">
                                                            Boleta
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="tipodoc" id="tipodocfac" value="01">
                                                        <label class="form-check-label" for="tipodocfac">
                                                            Factura
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="input-group mb-3">
                                                    <input type="text" name="textRuc" id="textRuc" class="form-control" required="" placeholder="N° Ruc"  onkeypress="ValidaSoloNumeros();" maxlength="8">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="textRazonSocial" id="textRazonSocial" class="form-control" required="" placeholder="Razon Social">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="textDireccion" id="textDireccion" class="form-control" required="" placeholder="Direccion">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">

                                                    <div class="box box-primary col-8">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Detalles Documento</h3>
                                                        </div>
                                                        <div class="input-group mb-3 row justify-content-between">
                                                            <div class="col-12 autocomplete">
                                                                <input id="textproducto" class="form-control" type="text" name="textproducto" placeholder="Producto">
                                                            </div>
                                                            <input id="codproducto" type="hidden" name="codproducto" placeholder="Producto">
                                                        </div>
                                                        <div class="input-group mb-3 row justify-content-between">
                                                            <did class="col-4 autocomplete">
                                                                <input type="text" name="textCantProducto" id="textCantProducto" class="form-control" placeholder="Cantidad" onkeypress="ValidaSoloNumerosYPunto();">
                                                            </did>
                                                            <did class="col-4 autocomplete">
                                                                <input type="text" name="textPrecioProducto" id="textPrecioProducto" class="form-control" placeholder="Precio" style="text-align:right;" onkeypress="ValidaSoloNumerosYPunto();" disabled>
                                                            </did>
                                                        </div>
                                                        <div class="row justify-content-center">
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
                                                                <table id="detprod" class="mb-0 table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th style="display:none;">CodProducto</th>
                                                                            <th>Producto</th>
                                                                            <th>Cantidad</th>
                                                                            <th>P. Unitario</th>
                                                                            <th>Total</th>
                                                                            <th>Opciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3 row justify-content-between">
                                                        <did class="col-4 autocomplete">
                                                            <p>TOTAL:</p>
                                                        </did>
                                                        <did class="col-4 autocomplete">
                                                            <input type="text" name="texttotalproducto" id="texttotalproducto" class="form-control" style="text-align:right;" disabled>
                                                        </did>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Generar</button>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </form>
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

                    <script src="js/gestionarFacturaDatos.js" type="text/javascript"></script>
                    <script src="js/generarDocumento.js" type="text/javascript"></script>
                    <!--
                    <script src="js/edicion.usuarios.js" type="text/javascript"></script>
                    <script src="js/actualizar.cliente.js" type="text/javascript"></script>    
                    <script src="js/gestionarTratamiento.js" type="text/javascript"></script>
                    -->


                    <!--
        <script src="js/convocatoriaVigente.js" type="text/javascript"></script>
        <script src="js/convocatoriaConcluida.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoCurriculo.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoPruebas.js" type="text/javascript"></script>
        <script src="js/reporte.resultadoFinal.js" type="text/javascript"></script>
    -->

</body>

</html>