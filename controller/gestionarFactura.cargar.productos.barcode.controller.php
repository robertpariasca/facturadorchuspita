<?php

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

$BarCode           = $_POST["p_barcode"];

try {

    $objProducto = new Producto();
    $objProducto->setCodbarraproducto($BarCode);
    $resultado = $objProducto->ListarBarcode();
    
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

