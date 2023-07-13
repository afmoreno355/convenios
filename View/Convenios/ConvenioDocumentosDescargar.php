<?php
        if(!empty($_GET['file'])) {

            $zipNombre = basename($_GET['file']);
            $direccion = "archivos/convenios/28/" . $zipNombre;

            if(!empty($zip) and file_exists($direccion)) {

                header("Content-Dipsosition: attachment; filename=" . $_GET['file']);

                readfile($_GET["file"]);
            } else {
                echo " NO ES POSIBLE DESCARGAR LOS DOCUMENTOS ";
            }
        }
    ?>