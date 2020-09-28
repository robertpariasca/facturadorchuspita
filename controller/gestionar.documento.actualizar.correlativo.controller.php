<?php

require_once '../logic/Correlativo.class.php';
require_once '../util/functions/Helper.class.php';

try {

    $Coddoc            = $_POST["p_tipodoc"];
    $CorreDoc          = $_POST["p_nrodoc"];

    $objProducto = new Correlativo();
    $objProducto->setCoddoc($Coddoc);
    $objProducto->setCorredoc($CorreDoc);
    $resultado = $objProducto->actualizar();
    
    if ($resultado == "EXITO") {
        Helper::imprimeJSON(200, "Agregado correctamente", "");
    } else {
        Helper::imprimeJSON(200, $resultado, "");
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}



