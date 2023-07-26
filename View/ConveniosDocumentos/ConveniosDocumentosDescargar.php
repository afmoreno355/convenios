<?php

  if(isset($_GET['idConvenio']) ) {

    $id = $_GET['idConvenio'];
    $rutaDirectorioDonvenios = '/convenios/archivos/convenios';

        
    $zip = new ZipArchive();
    $zipRuta = __DIR__ . '/../../..' . $rutaDirectorioConvenios . "/$id/CONVENIO_$id". '.zip';//__DIR__ . '/../..' . $this->ruta . '/CONVENIO_' . $id . '.zip';

    if(!$zip->open($zipRuta, ZipArchive::CREATE)) {

        print_r(" NO ES POSIBLE ABRIR EL ARCHIVO ZIP ");
    } else {

        $sql = " select * from  documentaciones where id_solicitud = '$id' ";
        $bd = ' convenios ';
        $conector=new ConectorBD();
        $conector->conectar($bd);
        $sentencia=$conector->conexion->prepare($sql);
        if (!$sentencia->execute()){ //si hay error en el SQL devuelve falso
            echo "Error al ejecutar en $bd: $sql. ";
            $conector->desconectar();
        } else {
            $resultado=$sentencia->fetchAll();
            $sentencia->closeCursor();
            $conector->desconectar();
        }
        
        $rutas = $resultado[0] ;
    
        print_r($rutas);
        foreach($rutas as $ruta) {

            if($ruta != '') {
                
                $zip->addFile(__DIR__ . '/../..' . $ruta, basename($ruta));
            }
        }

        $zip->close();
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

        }

  }
?>