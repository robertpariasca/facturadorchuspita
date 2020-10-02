<?php

require '../phpqrcode/qrlib.php';

function QR($nombre, $contenido)
{
    $dir = 'QRImage/';

    if(!file_exists($dir))
    mkdir($dir);

    $filename = $dir.$nombre;

    $tamanio = 8;
    $level = 'H';
    $framesize = 1;

    QRcode::png($contenido, $filename, $tamanio,$framesize);

    return '<img src="'. $filename. '" width="100px" height="90px"/>';
}
