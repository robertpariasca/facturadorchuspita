<?php

    session_name("Birdy");
    session_start();
    
    unset($_SESSION["cod_acceso"]);
    unset($_SESSION["alias"]);
    unset($_SESSION["id_rol"]);
    unset($_SESSION["nom_ingreso"]);
    unset($_SESSION["nom_rol"]);
    unset($_SESSION["nom_ingreso"]);
    unset($_SESSION["link_acceso"]);
    
    session_destroy();
    
    header("location:../view/index.php");