<?php

try {

    require_once '../logic/Facturacion.class.php';
    require_once '../logic/FacturacionDetalle.class.php';
    require_once '../logic/Empresa.class.php';
    require_once '../util/functions/Helper.class.php';
    require_once '../vendor/autoload.php';
    require_once 'functionQR.php';

    $SerieDoc           = $_POST["p_seriedoc"];
    $NroDoc             = $_POST["p_nrodoc"];
    $TipoDoc            = $_POST["p_tipodoc"];
    $NomTipoDoc         = "";
    $TipoDocCliente     = "";

    $TipoDocIdentidad   = "";
    session_name("Birdy");
    session_start();
    $objEmpresa = new Empresa();
    $objFacturacion = new Facturacion();
    $objDetalle = new FacturacionDetalle();
    $datosempresa = $objEmpresa->listar();
    $datoscliente = $objFacturacion->listar();
    $objDetalle->setSeriedoc($SerieDoc);
    $objDetalle->setNrodoc($NroDoc);
    $datosdetalle = $objDetalle->listar();
    
   //$html=$datosempresa[0]["ruc"];

    if($TipoDoc=="01"){
        $NomTipoDoc = "FACTURA";
        $TipoDocCliente = "6";
    }else{
        $NomTipoDoc = "BOLETA";
        $TipoDocCliente = "1";
    }

    $nomdoc = $SerieDoc.'-'.$NroDoc;
    $fechaemision = $datoscliente[0]["fecha_emision"];
    $dividir = explode('[/.-]', $fechaemision);
    $nuefecha = $dividir[2].'-'.$dividir[1].'-'.$dividir[0];


    $cadena = $datosempresa[0]["ruc"].'|'.$TipoDoc.'|'.$SerieDoc.'|'.$NroDoc.'|'.$datoscliente[0]["igv"].'|'.$datoscliente[0]["total"].'|'.$nuefecha.'|'.$TipoDocCliente.'|'.$datoscliente[0]["nro_ruc"];

    $imgQR = QR($nomdoc, $cadena);

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

';
$html.='


<table  class="info_medio" width="100%" height="50%" border="0" >
  <tr> 
    <td  ><b>SEÑOR(ES):</b> '.$datoscliente[0]["razon_social"].'</td>
    <td  align="right"> <b> Nro Doc : </b> '.$datoscliente[0]["nro_ruc"] .'</td>
  </tr>
  <tr>
     <td > <b> DIRECCION:</b> '.$datoscliente[0]["direccion"].' </td>
    <td align="right"> <b> FECHA DE EMISION:</b> '.$datoscliente[0]["fecha_emision"].' </td>
  </tr>
</table>  <br>

';
$html.='
    </header>
      <table  class="tabla_venta">
        <thead>
          <tr>
            <th class="desc">CANT</th>
            <th>DESCRIPCION</th>
            <th>PRECIO UNIT.</th>
            <th>IMPORTE</th>
          </tr>
        </thead>
        <tbody>';


    foreach ($datosdetalle as $data) {
      $tot = number_format(floatval($data["cantidad_producto"]) * floatval($data["precio_venta"]),2,".","");
        $html.='  <tr>
            <td class="desc"  align="right" >'.$data["cantidad_producto"].'</td>
            <td class="unit"  align="left" >'.$data["nom_producto"].'</td>
            <td class="qty"  align="right" >'.$data["precio_venta"].'</td>
            <td class="total"  align="right">'.$tot.'</td>
          </tr>
          ';

          }

          $html.='
           <tr>
            <td class="service" align="center"></td>
            <td class="desc"  align="center" ></td>
            <td class="unit"  align="center" ></td>
            <td class="qty"  align="center" ></td>
            <td class="total"  align="center"></td>
          </tr>
           <tr>
            <td class="service" align="center"></td>
            <td class="desc"  align="center" ></td>
            <td class="unit"  align="center" ></td>
            <td class="qty"  align="center" ></td>
            <td class="total"  align="center"></td>
          </tr>
           <tr>
            <td class="service" align="center"></td>
            <td class="desc"  align="center" ></td>
            <td class="unit"  align="center" ></td>
            <td class="qty"  align="center" ></td>
            <td class="total"  align="center"></td>
          </tr>

        </tbody>
      </table>    
      </main>

<table  class="ultima_tabla" width="100%" border="0">
 
  <tr>
    <td width="40%"><b></b></td>
    <td width="40%"><div align="center">TOT. GRAVADO</div></td>
    <td align="right" width="20%"><div align="right"> S/ '.$datoscliente[0]["gravado"].'</div></td>
  </tr>
  <tr>
    <td></td>
    <td><div align="center">TOT. INAFECTO</div></td>
    <td align="right"><div align="right"> S/ '.$datoscliente[0]["inafecto"].'</div></td>
  </tr>
  <tr>
    <td></td>
    <td><div align="center">TOT. EXONERADO</div></td>
    <td align="right"><div align="right"> S/ '.$datoscliente[0]["exonerado"].'</div></td>
  </tr>
  <tr>
    <td></td>
    <td><div align="center">TOT. RECARGO</div></td>
    <td align="right"><div align="right">S/ 0.00</div></td>
  </tr>
  ';

    $html.='
  <tr>
    <td></td>
    <td><div align="center">TOT. DSCTO</div></td>
    <td align="right"><div align="right">S/ 0.00</div></td>
  </tr>
  ';
$html.='
  <tr>
  <td></td>
    <td><div align="center">IGV (18%)</div></td>
    <td align="right"><div align="right"> S/ '.$datoscliente[0]["igv"].'</div></td>
  </tr>
  <tr>
  <td></td>
    <td><div align="center">TOT. PERCEPCION</div></td>
    <td align="right"><div align="right">S/ 0.00</div></td>
  </tr>
  <tr>
  <td></td>
    <td><div align="center">IMP. TOTAL</div></td>
    <td align="right"><div align="right"> S/ '.$datoscliente[0]["total"].'</div></td>
  </tr>
  <tr>
  <td></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
  <td></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  ';

$html.='

  <tr>
    <td colspan="3"><b>REPRESENTACION IMPRESA DE LA  '.$NomTipoDoc.' ELECTRONICA</b></td>
    
  </tr>
  <tr>
    <td>

    '.$imgQR.'
    </td>
  </tr>
  ';

$html.='
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>

</table>

  </body>
</html> ';

/*Creacion Ticket*/

    $mpdf = new \Mpdf\Mpdf(['format' => [72, 170], 'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);
    $mpdf->page=0;
    $mpdf->state=0;
    $mpdf->WriteHTML($html);
    $mpdf->Output("E:/". $nomdoc.".pdf");

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
