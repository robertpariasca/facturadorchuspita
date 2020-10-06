<?php

try {

    require_once '../logic/Facturacion.class.php';
    require_once '../util/functions/Helper.class.php';
    require_once '../vendor/autoload.php';

    $RucPropio          = "10472779929";
    $SerieDoc           = $_POST["p_seriedoc"];
    $NroDoc             = $_POST["p_nrodoc"];
    $NroRuc             = $_POST["p_nroruc"];
    $RazonSocial        = $_POST["p_razonsocial"];
    $Direccion          = $_POST["p_direccion"];
    $Gravado            = $_POST["p_gravado"];
    $Inafecto           = $_POST["p_inafecto"];
    $Exonerado          = $_POST["p_exonerado"];
    $Subtotal           = $_POST["p_subtotal"];
    $Igv                = $_POST["p_igv"];
    $Total              = $_POST["p_total"];
    $FechaEmision       = $_POST["p_fechaemision"];
    $HoraEmision        = $_POST["p_horaemision"];
    $TipoDoc            = $_POST["p_tipodoc"];

    $TipoDocIdentidad   = "";

    $objUsuario = new Facturacion();
    session_name("Birdy");
    session_start();

    if ($TipoDoc == "01") {
        $TipoDocIdentidad = "6";
    } else {
        $TipoDocIdentidad = "1";
    }

    $docfactura = fopen("E:\SFS_v1.3.3\sunat_archivos\sfs\DATA/" . $RucPropio . "-" . $TipoDoc . "-" . $SerieDoc . "-" . $NroDoc . ".CAB", "a");
    $txt = "0101|" . $FechaEmision . "|" . $HoraEmision . "|-|0000|" . $TipoDocIdentidad . "|" . $NroRuc . "|" . $RazonSocial . "|PEN|" . $Igv . "|" . $Subtotal . "|" . $Total . "|0.00|0.00|0.00|" . $Total . "|2.1|2.0|";
    fwrite($docfactura, $txt);
    fclose($docfactura);


    $doctributo = fopen("E:\SFS_v1.3.3\sunat_archivos\sfs\DATA/" . $RucPropio . "-" . $TipoDoc . "-" . $SerieDoc . "-" . $NroDoc . ".TRI", "a");

    if ($Gravado != "0.00") {
        $doc = "1000|IGV|VAT|" . $Gravado . "|" . $Igv . "|".PHP_EOL;
        fwrite($doctributo, $doc);
    }
    if ($Exonerado != "0.00") {
        $doc = "9997|EXO|VAT|" . $Exonerado . "|0.00|".PHP_EOL;
        fwrite($doctributo, $doc);
    }
    if ($Inafecto != "0.00") {
        $doc = "9998|INA|VAT|" . $Inafecto . "|0.00|".PHP_EOL;
        fwrite($doctributo, $doc);
    }

    fclose($doctributo);
/*
    $mpdf = new \Mpdf\Mpdf(['format' => [72, 200], 'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);
    $mpdf->page=0;
    $mpdf->state=0;
    $mpdf->WriteHTML("aea");
    $mpdf->Output("E:\pdf2.pdf");
*/

    $objUsuario->setSeriedoc($SerieDoc);
    $objUsuario->setNrodoc($NroDoc);
    $objUsuario->setNroruc($NroRuc);
    $objUsuario->setRazonsocial($RazonSocial);
    $objUsuario->setDireccion($Direccion);
    $objUsuario->setGravado(number_format($Gravado,2,'.',''));
    $objUsuario->setInafecto(number_format($Inafecto,2,'.',''));
    $objUsuario->setExonerado(number_format($Exonerado,2,'.',''));
    $objUsuario->setIgv(number_format($Igv,2,'.',''));
    $objUsuario->setTotal(number_format($Total,2,'.',''));
    $objUsuario->setFechaemision($FechaEmision);
    $objUsuario->setHoraemision($HoraEmision);

    $resultado = $objUsuario->grabar();

    if ($resultado == "EXITO") {
        Helper::imprimeJSON(200, "Agregado correctamente", "");
    } else {
        Helper::imprimeJSON(200, $resultado, "");
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
