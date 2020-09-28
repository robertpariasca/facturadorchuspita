<?php

try {

    require_once '../logic/Facturacion.class.php';
    require_once '../logic/FacturacionDetalle.class.php';
    require_once '../logic/Empresa.class.php';
    require_once '../util/functions/Helper.class.php';
    require_once '../vendor/autoload.php';

    $SerieDoc           = $_POST["p_seriedoc"];
    $NroDoc             = $_POST["p_nrodoc"];
    $TipoDoc            = $_POST["p_tipodoc"];
    $NomTipoDoc         = "";

    $TipoDocIdentidad   = "";
    session_name("Birdy");
    session_start();
    $objEmpresa = new Empresa();
    $objFacturacion = new Facturacion();
    $objDetalle = new FacturacionDetalle();
    $datosempresa = $objEmpresa->listar();

   //$html=$datosempresa[0]["ruc"];

    if($TipoDoc=="01"){
        $NomTipoDoc = "FACTURA";
    }else{
        $NomTipoDoc = "BOLETA";
    }

   $html='

   <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>'.$SerieDoc.'-'.$NroDoc.'</title>
      <link rel="stylesheet" href="../view/css/style.css" media="all" />
    </head>
    <body>
      <header >
            <main>
  
  <table class="info_derecha" width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr >
      <td class="logo_margin" rowspan="3" align="left">  
      <img src="../images/birdy.png" width="150"   height="75"> <br>
        '.$datosempresa[0]["razon_social"].'<br />
       <br>
        '.$datosempresa[0]["direccion"].'<br />
  
  </td>
      <td class="arriba"><b> R.U.C. '.$datosempresa[0]["ruc"].'</b></td>
    </tr>
    <tr>
      <td> <b>  '.$NomTipoDoc.' ELECTRONICA </b> </td>
    </tr>
    <tr >
      <td class="sinpad"> <b>  '.$SerieDoc.'-'.$NroDoc.' </b>  </td>
    </tr>
  </table>
   <br>

   </main>
   </header>
  
  </body>
</html> ';

/*Creacion Ticket*/

    $mpdf = new \Mpdf\Mpdf(['format' => [100, 500]]);
    $mpdf->page=0;
    $mpdf->state=0;
    $mpdf->WriteHTML($html);
    $mpdf->Output("E:\pdf1.pdf");

/*Creacion Ticket*/


    $resultado = "EXITO";

    if ($resultado == "EXITO") {
        Helper::imprimeJSON(200, "Agregado correctamente", "");
    } else {
        Helper::imprimeJSON(200, $resultado, "");
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
