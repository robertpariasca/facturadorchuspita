<?php
    
    try {

    require_once '../logic/FacturacionDetalle.class.php';
    require_once '../util/functions/Helper.class.php';

    $RucPropio          = "10472779929";
    $TipoDoc            = $_POST["p_tipodoc"];
    $SerieDoc           = $_POST["p_seriedoc"];
    $NroDoc             = $_POST["p_nrodoc"];
    $CodProducto        = $_POST["p_codproducto"];
    $NomProducto        = $_POST["p_nomproducto"];
    $PrecioSinIgv       = $_POST["p_preciosinigv"];
    $Productoigv        = $_POST["p_productoigv"];
    $Gravado            = $_POST["p_gravadouni"];
    $Inafecto           = $_POST["p_inafectouni"];
    $Exonerado          = $_POST["p_exoneradouni"];
    $PrecioVenta        = $_POST["p_precioventa"];
    $Cantidad           = $_POST["p_cantidad"];
    $TextInafecto       = $_POST["p_inafecto"];

    $objUsuario = new FacturacionDetalle();
    session_name("Birdy");
    session_start();
    
    $SumIGV             = number_format((floatval($Productoigv) * floatval($Cantidad)),2,".","");
    $SumItem            = number_format((floatval($PrecioSinIgv) * floatval($Cantidad)),2,".","");
    $SumTotal           = number_format((floatval($PrecioVenta) * floatval($Cantidad)),2,".","");

    //Tributos

    $SumGravado         = number_format((floatval($Gravado) * floatval($Cantidad)),2,".","");
    $SumInafecto        = number_format((floatval($Inafecto) * floatval($Cantidad)),2,".","");
    $SumExonerado       = number_format((floatval($Exonerado) * floatval($Cantidad)),2,".","");

    //Tributos

    $docdetalle = fopen("E:\SFS_v1.3.3\sunat_archivos\sfs\DATA/".$RucPropio."-".$TipoDoc."-".$SerieDoc."-".$NroDoc.".DET", "a");

    if ($SumGravado != "0.00"){
        $txt = "NIU|".$Cantidad."|".$CodProducto."|-|".$NomProducto."|".$PrecioSinIgv."|".$SumIGV."|1000|".$SumIGV."|".$SumItem."|IGV|VAT|10|18.00|-|||||||-||||||-||||||".$PrecioVenta."|".$SumItem."|0.00|".PHP_EOL;
    }else if ($SumInafecto != "0.00"){
        $txt = "NIU|".$Cantidad."|".$CodProducto."|-|".$NomProducto."|".$PrecioSinIgv."|".$SumIGV."|9998|".$SumIGV."|".$SumItem."|INA|VAT|10|18.00|-|||||||-||||||-||||||".$PrecioVenta."|".$SumItem."|0.00|".PHP_EOL;
    }else if ($SumExonerado != "0.00"){
        $txt = "NIU|".$Cantidad."|".$CodProducto."|-|".$NomProducto."|".$PrecioSinIgv."|".$SumIGV."|9997|".$SumIGV."|".$SumItem."|EXO|VAT|20|18.00|-|||||||-||||||-||||||".$PrecioVenta."|".$SumItem."|0.00|".PHP_EOL;
    }

    fwrite($docdetalle, $txt);
    fclose($docdetalle);


        $objUsuario->setSeriedoc($SerieDoc);
        $objUsuario->setNrodoc($NroDoc);
        $objUsuario->setCodprod($CodProducto);
        $objUsuario->setNomprod($NomProducto);
        $objUsuario->setPreciosinigv($PrecioSinIgv);
        $objUsuario->setIgvproducto($Productoigv);
        $objUsuario->setPrecioventa($PrecioVenta);
        $objUsuario->setCantidadproducto($Cantidad);

        $resultado = $objUsuario->grabar();

        if ($resultado == "EXITO") {
           
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }else{
                Helper::imprimeJSON(200, $resultado, "");
            }
            
       
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


