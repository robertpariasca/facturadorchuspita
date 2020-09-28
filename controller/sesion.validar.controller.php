<?php

try {
    $email = $_POST["p_alias"];
    $clave = $_POST["p_clave"];

    require_once '../logic/Acceso.class.php';
    require_once '../util/functions/Helper.class.php';
    /* Obtener los datos ingresados en el formulario */

//    if (!isset($_POST["txtEmail"]) || $_POST["txtEmail"] == "") {
//        Helper::mensaje("Debe ingresar su email", "e", "../view/index.php", 5);
//    } else 
//        if (!isset($_POST["txtClave"]) || $_POST["txtClave"] == "") {
//        Helper::mensaje("Debe ingresar su clave", "e", "../view/index.php", 5);
//        }
    

    $objSesion = new Acceso();
    $objSesion->setAlias($email);
    $objSesion->setClave($clave);

    $resultado = $objSesion->iniciarSesion();
    
    Helper::imprimeJSON(200, "", $resultado);

} catch (Exception $exc) {
    echo $exc->getMessage();
}