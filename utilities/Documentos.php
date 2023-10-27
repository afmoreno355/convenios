<?php
/**
 * Clase para gestionar documentos.
 *
 * @author Dibier
 */

namespace Documentos;

require_once __DIR__ . '/../Librerias/vendor/autoload.php';

use \Spipu\Html2Pdf\Html2Pdf;

function visualizarPdf($plantilla, $post) {

    foreach ($post as $clave => $valor) {
        $$clave = $valor;
    }

    try {
        // Activar el búfer de salida
        ob_start();

        // Incluir la plantilla PHP
        require_once __DIR__ . "/../$plantilla";

        // Obtener la salida generada
        $html = ob_get_clean();

        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);

        // Configurar la cabecera
        header("Content-Type: application/pdf");

        // Limpiar el buffer de salida
        ob_clean();
        $html2pdf->output('about.pdf');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function crearPdf($ruta, $plantilla, $post) {

        try {
            $nombre = basename($ruta);
            $directorio = dirname($ruta);
            $pdf = getContenidoPdf($plantilla, $post);
            crearDirectorio($directorio, 0777);

            return guardar($pdf, $nombre, $directorio);

        } catch (Exception $e) {
            throw new Exception("Error al crear PDF. " . $e->getMessage());
        }
    }

    function guardar($documento, $nombre, $directorio) {
        
        try {

            $ruta = "$directorio/$nombre";

            return file_put_contents($ruta, $documento) ? true : false;

        } catch (Exception $e) {
            throw new Exception("Error al guardar documento $nombre. " . $e->getMessage());
        }
    }

    function getContenidoPdf($plantilla, $post) {
        
        try {
            // Obtener contenido HTML de archivo PHP.
             // Activar el búfer de salida
            ob_start();

            // Incluir la plantilla PHP
            require_once __DIR__ . "/../$plantilla";

            // Obtener la salida generada
            $html = ob_get_clean();

            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);


            // Limpiar el buffer de salida
            ob_clean();

            $pdf = $html2pdf->output('about.pdf', 'S');

            return $pdf;
            
        } catch (Exception $e) {
            throw new Exception("Error al obtener contenido PDF. " . $e->getMessage());
        }
    }

    function crearDirectorio($ruta, $permisos) {
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
    function descargar($ruta) {

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

    function descargarTemporal($ruta, $segundos) {

        if ($this->descargar($ruta)) {

            sleep($segundos);
            unlink($ruta);
            
            return true;
        }
        return false;
    }

    // Crea ZIP para descargar documentos
    function crearZip($ruta, $documentos) {

        try {

            $zip = new ZipArchive();
            $zip->open($ruta, ZipArchive::CREATE);

            // Adjunta documentos
            foreach ($documentos as $doc) {

                if (!empty($doc) and is_file($doc)) {
                    $zip->addFile($doc, basename($doc));
                }
            }

            $zip->close();
           

        } catch (Exception $e) {
            throw new Exception("No es posible crear el archivo ZIP $ruta." . $e->getMessage());
        }
    }

    
    
    // guardar elementos en la base de datos
    function registrar($accion, $sql, $tabla, $baseDatos) {
        
        try {

            if (\ConectorBD::ejecutarQuery($sql, $baseDatos)) {

                $sqlHistorico = strtoupper(str_replace("'", "|", $sql));
                $historico = new \Historico(null, null);
                $historico->setIdentificacion($_SESSION["user"]);
                $historico->setTipo_historico($accion);
                $historico->setHistorico($sqlHistorico);
                $historico->setFecha("now()");
                $historico->setTabla($tabla);
                $historico->grabar();

                return true;
            }
            return false;

        } catch (Exception $e) {
            throw new Exception("No se pudo registrar la acción $accion, SQL $sql. " . $e->getMessage());
        }
    }

    // borrar elementos en la base de datos
    /*function borrar() {  
        $sql = "delete from documentaciones where id_documentacion = '$this->id'";
        if (ConectorBD::ejecutarQuery($sql, ' convenios ')) {
            //Historico de las acciones en el sistemas de informacion
            $sqlFormatted = strtoupper(str_replace("'", "|", $sql));
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico($sqlFormatted);
            $historico->setFecha("now()");
            $historico->setTabla("DOCUMENTACIONES");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }


    function adicionarDocumento($documento, $nombre) {

        $cargarDocumento = isset( $documento ) && $documento['name'] != '';
        $fecha = date("d-m-Y_h:i:s");
        $direccion = $this->ruta . "/$nombre" . "_$this->idSolicitud"."_$fecha" . ".pdf";

        if ($cargarDocumento) {
            
            if (
                Select::validar( $documento, 'FILE', null, $nombre, 'PDF' ) &&
                copy($documento['tmp_name'], __DIR__ . "/../$direccion")
               )
               {
                $sql = 'update documentaciones set';
                switch ($nombre) {
                    case 'MEMORANDO':
                        $sql .= ' memorando ';
                        break;
                    case 'ESTUDIOS PREVIOS':
                        $sql .= ' estudios_previos ';
                        break;
                    case 'ANEXO TÉCNICO':
                        $sql .= ' anexo_tecnico ';
                        break;
                    case 'ANÁLISIS DEL SECTOR':
                        $sql .= ' analisis_sector ';
                        break;
                    case 'CONCEPTO TÉCNICO':
                        $sql .= ' concepto_tecnico ';
                        break;
                    case 'PROPUESTA TÉCNICA ECONÓMICA':
                        $sql .= ' propuesta_tecnica_economica ';
                        break;
                    case 'MATRIZ DE RIESGOS':
                        $sql .= ' matriz_riesgos ';
                        break;
                    case 'CERTIFICADO DISPONIBILIDAD PRESUPUESTAL':
                        $sql .= ' certificado_disponibilidad_presupuestal ';
                        break;
                    case 'CERTIFICADO PAA':
                        $sql .= ' certificado_paa ';
                        break;
                    case 'PROYECTO DE AUTORIZACIÓN':
                        $sql .= ' proyecto_autorizacion ';
                }

                $sql .= " = '$direccion', fecha_sistema = now() where id_solicitud = $this->idSolicitud";

                ConectorBD::ejecutarQuery($sql, ' convenios ');
                $historico = new Historico(null, null);
                $historico->setIdentificacion($_SESSION["user"]);
                $historico->setTipo_historico("AGREGAR_DOCUMENTO");
                $historico->setFecha("now()");
                $historico->grabar();
                return true;
               } else {
                print_r(" No se ha cargado el documento $nombre correctamente. ");
                return false;
               }
        }
        return true;
    }

    function adicionarDocumentacion() {
        return
            $this->adicionarDocumento($this->memorando, 'MEMORANDO') &&
            $this->adicionarDocumento($this->estudiosPrevios, 'ESTUDIOS PREVIOS') &&
            $this->adicionarDocumento($this->anexoTecnico, 'ANEXO TÉCNICO') &&
            $this->adicionarDocumento($this->analisisSector, 'ANÁLISIS DEL SECTOR') &&
            $this->adicionarDocumento($this->solicitudConceptoTecnico, 'CONCEPTO TÉCNICO') &&
            $this->adicionarDocumento($this->propuestaTecnicaEconomica, 'PROPUESTA TÉCNICA ECONÓMICA') &&
            $this->adicionarDocumento($this->matrizRiesgos, 'MATRIZ DE RIESGOS') &&
            $this->adicionarDocumento($this->disponibilidadPresupuestal, 'CERTIFICADO DISPONIBILIDAD PRESUPUESTAL') &&
            $this->adicionarDocumento($this->paa, 'CERTIFICADO PAA') &&
            $this->adicionarDocumento($this->proyectoAutorizacion, 'PROYECTO DE AUTORIZACIÓN');

    }

    function adicionarModificar($idSolicitud) {
        $documentacion = new ConvenioDocumentos(' id_solicitud ', $idSolicitud);
        if ($documentacion->getId() == null) {
            $this->registrarDocumentacion($idSolicitud);
        }

        // crea directorio
        $destino = __DIR__ . "/../archivos/convenios/$idSolicitud";
        mkdir($destino, 0777, true);

        return $this->adicionarDocumentacion();
    } */




