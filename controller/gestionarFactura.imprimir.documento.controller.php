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
    $objFacturacion->setSeriedoc($SerieDoc);
    $objFacturacion->setNrodoc($NroDoc);
    $datoscliente = $objFacturacion->listar();
    $objDetalle->setSeriedoc($SerieDoc);
    $objDetalle->setNrodoc($NroDoc);
    $datosdetalle = $objDetalle->listar();
    
    $TamañoDoc = "140";
   //$html=$datosempresa[0]["ruc"];

   $TxtTipoDoc = "";
   $TxtTipoNom = "";

    if($TipoDoc=="01"){
        $NomTipoDoc = "FACTURA";
        $TipoDocCliente = "6";
        $TxtTipoDoc = "RUC:";
        $TxtTipoNom = "RAZON SOCIAL:";
    }else{
        $NomTipoDoc = "BOLETA";
        $TipoDocCliente = "1";
        $TxtTipoDoc = "DNI:";
        $TxtTipoNom = "NOMBRE:";
    }

    

    $nomdoc = $SerieDoc.'-'.$NroDoc;
    $fechaemision = $datoscliente[0]["fecha_emision"];
    $dividir = explode('-', $fechaemision);
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
  
  <table class="tabla_cabecera" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr >
      <td>'.$datosempresa[0]["razon_social"].'</td>
    </tr>
    <tr>
      <td > DIR. FISCAL:'.$datosempresa[0]["direccion"].' </td>
    </tr>
    <tr >
    <td>R.U.C. '.$datosempresa[0]["ruc"].'</td>
  </tr>
    <tr>
      <td> <b>  '.$NomTipoDoc.' ELECTRONICA </b> </td>
    </tr>
    <tr>
    <td> <b>  '.$SerieDoc.'-'.$NroDoc.'</b> </td>
  </tr>
  </table>

';
$html.='


<table  class="info_medio" width="100%" height="50%" border="0" >
  <tr> 
    <td  >Fecha:'.$nuefecha.' </td>
    <td div align="right">Hora:'.$datoscliente[0]["hora_emision"].'</td>
  </tr>
  <tr> 
    <td colspan="2" >'.$TxtTipoNom.' '.$datoscliente[0]["razon_social"].' </td>
  </tr>
  <tr>
     <td colspan="2"> DIRECCION: '.$datoscliente[0]["direccion"].' </td>
  </tr>
  <tr>
    <td colspan="2">'.$TxtTipoDoc.' '.$datoscliente[0]["nro_ruc"].' </td>
</tr>
</table>  <br>

';
$html.='
    </header>
      <table  class="tabla_venta" cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th width="15%" style="font-size:7px">Cant.</th>
            <th width="55%" style="font-size:7px">Descripcion</th>
            <th width="15%" style="font-size:7px">P. Unit</th>
            <th width="15%" style="font-size:7px">Total</th>
          </tr>
        </thead>
        <tbody>';


    foreach ($datosdetalle as $data) {
      $tot = number_format(floatval($data["cantidad_producto"]) * floatval($data["precio_venta"]),2,".","");
      $TamañoDoc = $TamañoDoc + 10;
        $html.='  <tr>
            <td class="desc"  align="right">'.number_format($data["cantidad_producto"],2,'.','').'</td>
            <td class="unit"  align="left">'.$data["nom_producto"].'</td>
            <td class="qty"  align="right">'.number_format($data["precio_venta"],2,'.','').'</td>
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
 
  <tr width="100%">
    <td width="80%"><div align="center">TOT. GRAVADO</div></td>
    <td align="right" width="20%"><div align="right"> S/ '.number_format($datoscliente[0]["gravado"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center">TOT. INAFECTO</div></td>
    <td align="right"><div align="right"> S/ '.number_format($datoscliente[0]["inafecto"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center">TOT. EXONERADO</div></td>
    <td align="right"><div align="right"> S/ '.number_format($datoscliente[0]["exonerado"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center">TOT. RECARGO</div></td>
    <td align="right"><div align="right">S/ 0.00</div></td>
  </tr>
  ';

    $html.='
  <tr>
    <td><div align="center">TOT. DSCTO</div></td>
    <td align="right"><div align="right">S/ 0.00</div></td>
  </tr>
  ';
$html.='
  <tr>
    <td><div align="center">IGV (18%)</div></td>
    <td align="right"><div align="right"> S/ '.number_format($datoscliente[0]["igv"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center">TOT. ICBPER</div></td>
    <td align="right"><div align="right">S/ '.number_format($datoscliente[0]["ICBPER"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center">IMP. TOTAL</div></td>
    <td align="right"><div align="right"> S/ '.number_format($datoscliente[0]["total"],2,'.','').'</div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
  ';

$html.='

  <tr>
    <td align="center" colspan="2"><b>REPRESENTACION IMPRESA GENERADA DEL FACTURADOR SUNAT</b></td>
   
  </tr>

  ';

$html.='

</table>
<table  class="ultima_tabla" width="100%" border="0">
<tr>
    <td align="center">'.$imgQR.'

    
    </td>

  </tr>
 
</table>

<table  class="ultima_tabla" width="100%" border="0">
<tr><td align="center" colspan="2"><b>LA CHUSPITA, TU BODEGUITA ONLINE</b></td></tr>
  
<tr><td align="center" colspan="2"><b>GRACIAS POR SU PREFERENCIA</b></td></tr>
</table>

  </body>
</html> ';

/*Creacion Ticket*/

    $mpdf = new \Mpdf\Mpdf(['format' => [72, $TamañoDoc], 'margin_left' => "3mm",'margin_right' => "3mm",'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);
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
