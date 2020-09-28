<?php

require_once '../logic/Correlativo.class.php';
require_once '../util/functions/Helper.class.php';

try {

    $Coddoc            = $_POST["p_tipodoc"];

    $objProducto = new Correlativo();
    $objProducto->setCoddoc($Coddoc);
    $resultado = $objProducto->listar();
    
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}



