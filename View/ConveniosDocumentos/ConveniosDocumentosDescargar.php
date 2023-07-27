<?php

$zip = new ZipArchive();
$zipRuta = __DIR__ . '/../..' . $_GET['file'];

if($zip->open($zipRuta, ZipArchive::CREATE)) {

    $sql = ' select * from documentaciones where idSolicitud = ' . $_GET['idConvenio'];
    
    
    $zip->addFile('/srv/http/www/convenios/archivos/convenios/60/MEMORANDO_60_26-07-2023_11:40:55.pdf', 'convenios.pdf');
    $zip->close();

} else {

    print_r("No se ha abierto");

}

if(file_exists($zipRuta)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($zipRuta) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zipRuta));

    readfile($zipRuta);


} else {

    print_r("No existe el archivo $zipRuta");

}