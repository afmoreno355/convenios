<?php
    if(isset($_GET['idConvenio'])) {
        $idConvenio = $_GET['idConvenio'];
        ConvenioDocumentos::zipDocumentos($idConvenio);

            $zipNombre = 'CONVENIO_' . $idConvenio . '.zip';
            $direccion = __DIR__ . "/../../archivos/convenios/" . "/" . $zipNombre;

            if(!empty($zip) and file_exists($direccion)) {

                header("Content-Dipsosition: attachment; filename=" . $_GET['file']);

                readfile($_GET["file"]);
            } else {
                echo " NO ES POSIBLE DESCARGAR LOS DOCUMENTOS ";
            }
        }
?>