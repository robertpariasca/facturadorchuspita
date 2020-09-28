<?php
    
    try {

    require_once '../logic/Producto.class.php';
    require_once '../util/functions/Helper.class.php';

    $codproducto      = $_POST["p_codproducto"];


    $objUsuario = new Producto();
    session_name("Birdy");
    session_start();
        $objUsuario->setCodproducto($codproducto);
        $resultado = $objUsuario->eliminar();

        //Helper::imprimeJSON(200, $_SESSION["cod_acceso"], "");
        
        if ($resultado == "EXITO") {
            Helper::imprimeJSON(200, "Eliminado correctamente", "");
        }else{
                Helper::imprimeJSON(200, $resultado, "");
            }
        
       
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


