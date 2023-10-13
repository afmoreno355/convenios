<?php
/**
 * Clase para gestionar documentos.
 *
 * @author Dibier
 */

 // importa Html2Pdf
 require __DIR__ . '/../Librerias/vendor/autoload.php';
 use \Spipu\Html2Pdf\Html2Pdf;


class Documentos {

    private $idSolicitud;
    private $directorio;
    private $rutas;
    private $baseDatos;
    private $tabla;

    public function __construct() {
        // Constructor vacío
    }

    

    // Otros métodos de la clase para gestionar documentos

    public function crearPdf($ruta, $plantilla) {

        try {

            $nombre = basename($ruta);
            $directorio = dirname($ruta);
            $pdf = $this->getContenidoPdf($plantilla);
            $this->crearDirectorio($directorio, 0777);
            
            //return $this->guardar($pdf, $nombre, $directorio) ? true : false;

        } catch (Exception $e) {
            throw new Exception("Error al crear PDF." . $e->getMessage());
        }
    }

    public function guardar($documento, $nombre, $directorio) {
        
        try {

            $ruta = "$directorio/$nombre";

            return file_put_contents($ruta, $documento) ? true : false;

        } catch (Exception $e) {
            throw new Exception("Error al guardar documento $nombre. " . $e->getMessage());
        }
    }

    public function getContenidoPdf($plantilla) {
        
        try {
            // Obtener contenido HTML de archivo PHP.
            ob_start();
            include(__DIR__ . "/../$plantilla");
            $html = ob_get_clean();

            // Obener contenido PDF de HTML.
            $html2Pdf = new Html2Pdf();
            $html2Pdf->writeHtml($html);
            $pdf = $html2Pdf->output('', 'S');

            return $pdf;
            
        } catch (Exception $e) {
            throw new Exception("Error al obtener contenido PDF. " . $e->getMessage());
        }
    }

    public function crearDirectorio($ruta, $permisos) {
        try {
            if (!is_dir($ruta)) {
                if (mkdir($ruta, $permisos, true)) {
                    return true; // Directorio creado exitosamente
                } else {
                    return false; // Error al crear el directorio
                }
            } else {
                return false; // El directorio ya existe
            }
        } catch (Exception $e) {
            // Manejo de excepción en caso de error
            throw new Exception("Error al crear el directorio. " . $e->getMessage());
        }
    }
    
    // Descargar documento estudios previos
    public function descargar($ruta) {

        try {

            if (file_exists($ruta)) {

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($ruta) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($ruta));
    
                // Descarga el archivo
                readfile($ruta);
    
                return true;
            }
            return false;

        } catch (Exception $e) {
            throw new Exception("No se pudo descargar documento $ruta. " . $e->getMessage());
        }
    }

    public function descargarTemporal($ruta, $segundos) {

        if ($this->descargar($ruta)) {

            sleep($seguntos);
            unlink($ruta);
            
            return true;
        }
        return false;
    }

}


