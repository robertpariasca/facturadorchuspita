<?php
    
    try {

    require_once '../logic/Producto.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_descripcion"]) ||
            empty($_POST["p_descripcion"]) ||
            
            !isset($_POST["p_precio"]) ||
            empty($_POST["p_precio"]) 
            
    ) 
        {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $Descripcion            = $_POST["p_descripcion"];
    $Precio                 = $_POST["p_precio"];
    $CodProducto            = $_POST["p_codproducto"];

    $objUsuario = new Producto();
    session_name("Birdy");
    session_start();
        
        $objUsuario->setDescripcion($Descripcion);
        $objUsuario->setPrecio($Precio);        
        $objUsuario->setCodproducto($CodProducto);  
        $resultado = $objUsuario->actualizar();
/*
        echo '<pre>';
        echo 'Datos que llegan por POST';
        print_r($resultado);
        echo '</pre>';
*/
        if ($resultado == "EXITO") {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }else{
                Helper::imprimeJSON(200, $resultado, "");
            }
            
       
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

