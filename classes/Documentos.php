<?php
/**
 * Clase para gestionar documentos.
 *
 * @author Dibier
 */
class Documentos {
    private $idSolicitud;
    private $rutas; 
    private $baseDatos;
    private $tabla;

    public function __construct($id, $nombre, $baseDatos, $tabla, $fecha) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->baseDatos = $baseDatos;
        $this->tabla = $tabla;
        $this->fecha = $fecha;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getBaseDatos() {
        return $this->baseDatos;
    }

    public function getTabla() {
        return $this->tabla;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setBaseDatos($baseDatos) {
        $this->baseDatos = $baseDatos;
    }

    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Otros métodos de la clase para gestionar documentos

    public function crearPdf() {
        $id = $this->idSolicitud;
        $carpeta = __DIR__ . "/../archivos/convenios/$id";
        $ruta = "$carpeta/ESTUDIOS_$id.pdf";
    
        // Verificar si el directorio existe o crearlo
        if (!is_dir($carpeta) && !mkdir($carpeta, 0777, true)) {
            die("Error al crear la carpeta: $carpeta");
        }
    
        // Leer el contenido desde el archivo PHP externo y pasar el idSolicitud como parámetro
        ob_start();  // Iniciar el almacenamiento en búfer de salida
        $_GET['idSolicitud'] = $id;  // Establecer el parámetro idSolicitud
        include(__DIR__ . '/../View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosDocumentos.php');  // Incluir el contenido desde el archivo PHP
        $html = ob_get_clean();  // Obtener el contenido almacenado en el búfer de salida
    
        // Genera el PDF de HTML
        $html2Pdf = new Html2Pdf();
        $html2Pdf->writeHtml($html);
        $pdfContent = $html2Pdf->output('', 'S'); // Captura el contenido del PDF en una variable
    
        // Guarda el PDF en la carpeta
        if (file_put_contents($ruta, $pdfContent) === false) {
            // Error si no se pudo guardar el archivo
            die("Error al guardar el archivo PDF: $ruta");
        }
    
        return $ruta; // Retorna la ruta del archivo PDF generado
    }
    
    // Descargar documento estudios previos
    public function descargar() {
        $ruta = $this->crearPdf();
        
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
    }

    
    // retorna rutas de documentos
    public function getRutasDocumentos() {

        $sql = " select * from  documentaciones where id_solicitud = '$this->idSolicitud' ";
        return ConectorBD::ejecutarQuery($sql, ' convenios ')[0];
    }

    // crea zip para descargar documentos
    public function crearZipDocumentos() {

        $rutaDocumento = $this->ruta;
        $id = $this->idSolicitud;
        $zipRuta = __DIR__ . "/../$rutaDocumento/CONVENIO_$id.zip";

        $zip = new ZipArchive();

        if(!$zip->open($zipRuta, ZipArchive::CREATE)) {

            print_r(" NO ES POSIBLE ABRIR EL ARCHIVO ZIP ");
        } else {

            $rutas = $this->getRutasDocumentos();

            foreach($rutas as $ruta) {

                if($ruta != '') {
                    
                    $zip->addFile(__DIR__ . '/../' . $ruta, basename($ruta));
                }
            }

            $zip->close();
        }
    }

    public function descargarZipDocumentos() {

        $this->crearZipDocumentos();

        $rutaDocumento = $this->ruta;
        $id = $this->idSolicitud;
        $zipRuta = __DIR__ . "/../$rutaDocumento/CONVENIO_$id.zip";

        if(file_exists($zipRuta)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($zipRuta) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($zipRuta));
            // Descarga zip temporal
            readfile($zipRuta);
            sleep(5);
            unlink($zipRuta);

            return true;
        }
        return false;
    }
    
    // guardar elementos en la base de datos
    public function registrarDocumentacion($idSolicitud) {
        
        $sql = "insert into documentaciones (
            id_solicitud,
            fecha_sistema
        ) values (
            '$idSolicitud',
            now()
        )";

        if(ConectorBD::ejecutarQuery($sql, ' convenios ')) {

            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ADICIONAR");
            $historico->setHistorico(strtoupper(str_replace("'", "|", $sql)));
            $historico->setFecha("now()");
            $historico->setTabla("DOCUMENTACIONES");
            $historico->grabar();

            return true;
        }
        return false;
    }

    // borrar elementos en la base de datos
    public function borrar() {  
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


    public function adicionarDocumento($documento, $nombre) {

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

    public function adicionarDocumentacion() {
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

    public function adicionarModificar($idSolicitud) {
        $documentacion = new ConvenioDocumentos(' id_solicitud ', $idSolicitud);
        if ($documentacion->getId() == null) {
            $this->registrarDocumentacion($idSolicitud);
        }

        // crea directorio
        $destino = __DIR__ . "/../archivos/convenios/$idSolicitud";
        mkdir($destino, 0777, true);

        return $this->adicionarDocumentacion();
    }

}


