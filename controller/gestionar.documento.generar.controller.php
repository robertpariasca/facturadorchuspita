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
    $doc = "1000|IGV|VAT|" . $Subtotal . "|" . $Igv . "|";
    fwrite($doctributo, $doc);
    fclose($doctributo);

/*Creacion Ticket*/

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->Output("E:\pdf1.pdf");

/*Creacion Ticket*/

    $objUsuario->setSeriedoc($SerieDoc);
    $objUsuario->setNrodoc($NroDoc);
    $objUsuario->setNroruc($NroRuc);
    $objUsuario->setRazonsocial($RazonSocial);
    $objUsuario->setDireccion($Direccion);
    $objUsuario->setSubtotal($Subtotal);
    $objUsuario->setIgv($Igv);
    $objUsuario->setTotal($Total);
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
