<?php

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

try {

    $codproducto   = $_POST["p_codproducto"];

    $objProducto = new Producto();
    session_name("Birdy");
    session_start();
    $objProducto->setCodproducto($codproducto);
    $resultado = $objProducto->listarEdicion();
    
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
