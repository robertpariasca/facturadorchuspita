<?php

require_once '../logic/UnidadMedida.class.php';
require_once '../util/functions/Helper.class.php';

try {

    $objProducto = new UnidadMedida();
    $resultado = $objProducto->listar();
    
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

