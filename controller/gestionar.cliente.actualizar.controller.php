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
    $Categoria              = $_POST["p_categoria"];
    $Tipo                   = $_POST["p_tipo"];
    $Marca                  = $_POST["p_marca"];
    $Envase                 = $_POST["p_envase"];
    $Medida                 = $_POST["p_medida"];
    $Precio                 = $_POST["p_precio"];

    $objUsuario = new Producto();
    session_name("Birdy");
    session_start();
    
        $objUsuario->setDescripcion($Descripcion);
        $objUsuario->setIdcategoria($Categoria);
        $objUsuario->setIdtipo($Tipo);
        $objUsuario->setIdmarca($Marca);
        $objUsuario->setIdenvase($Envase);
        $objUsuario->setIdunidadmedida($Medida);
        $objUsuario->setPrecio($Precio);

        $resultado = $objUsuario->grabar();
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


