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
    table {
      table-layout: fixed;
      width: 100%;
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

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Promociones</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="row justify-content-center">
        <div>
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <?php

                require_once '../controller/gestionarCliente.listar.tipoprod.cabecera.controller.php';


                for ($i = 0; $i < count($resultado); $i++) {
                  if ($i == 0) {
                    echo '<li class="nav-item"><a class="nav-link active" href="#' . $resultado[$i]["nombre_tipo"] . '" data-toggle="tab"> ' . $resultado[$i]["nombre_tipo"] . '</a></li>';
                  } else {
                    echo '<li class="nav-item"><a class="nav-link" href="#' . $resultado[$i]["nombre_tipo"] . '" data-toggle="tab"> ' . $resultado[$i]["nombre_tipo"] . '</a></li>';
                  }
                }
                ?>

              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">

                <?php

                for ($i = 0; $i < count($resultado); $i++) {

                ?>
                  <div class="tab-pane <?php if ($i == 0) {
                                          echo 'active';
                                        }; ?>" id="<?php echo  $resultado[$i]["nombre_tipo"] ?>">

                    <div class="row justify-content-center">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Las mejores promociones en <?php echo  $resultado[$i]["nombre_tipo"] ?> </h3>
                        </div>

                        <table class="table table-borderless">
                          <tbody>

                            <?php

                            $_POST["nombre_tipo"] = $resultado[$i]["nombre_tipo"];


                            require '../controller/gestionarCliente.listar.promociones.vista.controller.php';

                            $salto = 1;
                            for ($j = 0; $j < count($resultadoProm); $j++) {
                              if ($salto == 1) {
                                echo '<tr>';
                              }
                            ?>

                              <td>
                                <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td class="imagen"><img src="<?php echo  $resultadoProm[$j]["imagen"] ?>" alt="" style="width:100%; height:auto;"></td>

                                      <td>
                                        <table class="table table-borderless">
                                          <tr>
                                            <td class="h2"><?php echo  $resultadoProm[$j]["nom_promocion"] ?> </td>
                                          </tr>
                                          <tr>
                                            <td class="h5">Precio Antes: <?php echo  $resultadoProm[$j]["costo_promocion"] ?> S/ </td>
                                          </tr>
                                          <tr>
                                            <td class="h5">Precio Ahora: <?php echo  $resultadoProm[$j]["costo_real"] ?> S/ </td>
                                          </tr>
                                          <tr>
                                            <td>Vigencia: Hasta el <?php echo  $resultadoProm[$j]["fecha_fin_vigencia"] ?></td>
                                          </tr>
                                          <tr>
                                            <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?php echo  $_SESSION["cod_acceso"] ?>-<?php echo  $resultadoProm[$j]["cod_promocion"] ?>">Ver Mas</button></td>
                                            <div class="modal fade" id="<?php echo  $_SESSION["cod_acceso"] ?>-<?php echo  $resultadoProm[$j]["cod_promocion"] ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo  $_SESSION["cod_acceso"] ?>-<?php echo  $resultadoProm[$j]["cod_promocion"] ?>" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo  $resultadoProm[$j]["nom_promocion"] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="container-fluid">
                                                      <div class="row">
                                                        <div class="col-sm-12">
                                                          <div class="row">
                                                            <div class="col-8 col-sm-4">
                                                              <img src="<?php echo  $resultadoProm[$j]["imagen"] ?>" alt="" style="width:100%; height:auto;">
                                                            </div>
                                                            <div class="col-4 col-sm-8">

                                                              <div><?php echo  $resultadoProm[$j]["descripcion_larga"] ?></div>
                                                              <div>Costo Promocion: <?php echo  $resultadoProm[$j]["costo_promocion"] ?> S/</div>
                                                              <div>Costo Real: <?php echo  $resultadoProm[$j]["costo_real"] ?> S/</div>
                                                              <div>Vigencia: <?php echo  $resultadoProm[$j]["fecha_fin_vigencia"] ?></div>
                                                              <div>Stock: <?php echo  $resultadoProm[$j]["stock_pedido"] ?></div>
                                                              <div>Detalles:</div>
                                                              <?php

                                                              $_POST["p_codpromocion"] = $resultadoProm[$j]["cod_promocion"];

                                                              require '../controller/gestionarCliente.listar.promociones.detalle.vista.controller.php';

                                                              for ($k = 0; $k < count($resultadoDetalle); $k++) {

                                                                ?>
                                                                    <div><?php echo  $resultadoDetalle[$k]["cantidad_producto"] ?> <?php echo  $resultadoDetalle[$k]["nom_producto"] ?></div>
                                                                <?php

                                                              }

                                                              $resultadoDetalle

                                                              ?>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>

                                </table>
                              </td>

                              <?php
                              if ($salto == 3) {
                                echo '</tr>';
                                $salto = 1;
                              } else {
                                $salto = $salto + 1;
                              }
                            }
                            if ($salto == 2) {
                              ?>
                              <td>
                                <table class="table table-borderless">
                                  <tbody>
                                    <tr>
                                      <td></td>

                                      <td>
                                        <table class="table table-borderless">
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>

                                </table>
                              </td>
                              <td>
                                <table class="table table-borderless">
                                  <tbody>
                                    <tr>
                                      <td></td>

                                      <td>
                                        <table class="table table-borderless">
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>

                                </table>
                              </td>
                            <?php
                            } elseif ($salto == 3) {
                            ?>
                              <td>
                                <table class="table table-borderless  ">
                                  <tbody>
                                    <tr>
                                      <td></td>

                                      <td>
                                        <table class="table table-borderless">
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>

                                </table>
                              </td>

                            <?php
                            }
                            ?>


                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                <?php
                }


                ?>
                <!-- /.tab-content -->

              </div>
            </div>
          </div>
          <?php

          ?>

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