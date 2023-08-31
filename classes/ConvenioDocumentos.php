<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autorizacion
 *
 * @author Dibier 
 */
class ConvenioDocumentos {
    //put your code here
    private $id;
    private $idSolicitud;
    private $memorando;
    private $estudiosPrevios;
    private $anexoTecnico;
    private $analisisSector;
    private $solicitudConceptoTecnico;
    private $propuestaTecnicaEconomica;
    private $matrizRiesgos;
    private $disponibilidadPresupuestal;
    private $paa; // Plan Anual
    private $proyectoAutorizacion;
    private $fecha;

    // ruta directorio convenios
    private $ruta;


    // Getters and Setters
    
    public function getId() {
        return $this->id;
    }

    public function getIdSolicitud() {
        return $this->idSolicitud;
    }

    public function getMemorando() {
        return $this->memorando;
    }

    public function getEstudiosPrevios() {
        return $this->estudiosPrevios;
    }

    public function getAnexoTecnico() {
        return $this->anexoTecnico;
    }

    public function getAnalisisSector() {
        return $this->analisisSector;
    }

    public function getSolicitudConceptoTecnico() {
        return $this->solicitudConceptoTecnico;
    }

    public function getPropuestaTecnicaEconomica() {
        return $this->propuestaTecnicaEconomica;
    }

    public function getMatrizRiesgos() {
        return $this->matrizRiesgos;
    }

    public function getDisponibilidadPresupuestal() {
        return $this->disponibilidadPresupuestal;
    }

    public function getPaa() {
        return $this->paa;
    }

    public function getProyectoAutorizacion() {
        return $this->proyectoAutorizacion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getRuta() {
        return $this->ruta;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdSolicitud($idSolicitud): void {
        $this->idSolicitud = $idSolicitud;
    }

    public function setMemorando($memorando): void {
        $this->memorando = $memorando;
    }

    public function setEstudiosPrevios($estudiosPrevios): void {
        $this->estudiosPrevios = $estudiosPrevios;
    }

    public function setAnexoTecnico($anexoTecnico): void {
        $this->anexoTecnico = $anexoTecnico;
    }

    public function setAnalisisSector($analisisSector): void {
        $this->analisisSector = $analisisSector;
    }

    public function setSolicitudConceptoTecnico($solicitudConceptoTecnico): void {
        $this->solicitudConceptoTecnico = $solicitudConceptoTecnico;
    }

    public function setPropuestaTecnicaEconomica($propuestaTecnicaEconomica): void {
        $this->propuestaTecnicaEconomica = $propuestaTecnicaEconomica;
    }

    public function setMatrizRiesgos($matrizRiesgos): void {
        $this->matrizRiesgos = $matrizRiesgos;
    }

    public function setDisponibilidadPresupuestal($disponibilidadPresupuestal): void {
        $this->disponibilidadPresupuestal = $disponibilidadPresupuestal;
    }

    public function setPaa($paa): void {
        $this->paa = $paa;
    }

    public function setProyectoAutorizacion($proyectoAutorizacion): void {
        $this->proyectoAutorizacion = $proyectoAutorizacion;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setRuta($ruta): void {
        $this->ruta = $ruta;
    }

    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $sql = "select
                    id_documentacion,
                    id_solicitud,
                    memorando,
                    estudios_previos,
                    anexo_tecnico,
                    analisis_sector,
                    concepto_tecnico,
                    propuesta_tecnica_economica,
                    matriz_riesgos,
                    certificado_disponibilidad_presupuestal,
                    certificado_paa,
                    proyecto_autorizacion,
                    fecha_sistema
                from documentaciones where $campo = $valor";
                
                $resultado = ConectorBD::ejecutarQuery($sql, ' convenios ');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    // organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id = $vector[0];
        $this->idSolicitud = $vector[1];
        $this->memorando = $vector[2];
        $this->estudiosPrevios = $vector[3];
        $this->anexoTecnico = $vector[4];
        $this->analisisSector = $vector[5];
        $this->solicitudConceptoTecnico = $vector[6];
        $this->propuestaTecnicaEconomica = $vector[7];
        $this->matrizRiesgos = $vector[8];
        $this->disponibilidadPresupuestal = $vector[9];
        $this->paa = $vector[10];
        $this->proyectoAutorizacion = $vector[11];
        $this->fecha = $vector[12];
    }
 
           
    // metodo magico
    function __toString() {
        //return $this->;
    }

    //datos hace la consulta sql.
    public static function datos($filtro, $pagina, $limit) {
        $sql = "select * from  documentaciones";
        if ($filtro != null) {
            $sql .= " where " . $filtro;
        }
        $sql .= " order by documentaciones.id_solicitud desc ";
        if ($pagina != null && $limit != null) {
            $sql .= " offset $pagina limit $limit ";
        }
        return ConectorBD::ejecutarQuery($sql, ' convenios ');
    }

    //convierte los array de datos en objetos enviando las posiciones al constructor 
    public static function datosobjetos($filtro, $pagina, $limit) {
        $datos = self::datos($filtro, $pagina, $limit);
        $listas = array();
        for ($i = 0; $i < count($datos); $i++) {
            $clase = new self($datos[$i], null);
            $listas[$i] = $clase;
        }
        return $listas;
    }
    
    // nos debuelve la cantidad de filas que existen en la tabla para hacer la paginacion.
    public static function count($filtro) {
        $filtro = ( $filtro != "") ? " where $filtro " : "";
        return ConectorBD::ejecutarQuery("select count(*) from  documentaciones  $filtro", ' convenios ');
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
        print_r($zipRuta);

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


