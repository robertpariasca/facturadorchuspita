<?php

require_once '../logic/Marca.class.php';
require_once '../util/functions/Helper.class.php';

try {

    $objProducto = new Marca();
    $resultado = $objProducto->listar();
    
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

