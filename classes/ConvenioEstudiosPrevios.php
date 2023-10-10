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

 // importa Html2Pdf
require __DIR__ . '/../Librerias/vendor/autoload.php';
use \Spipu\Html2Pdf\Html2Pdf;


class ConvenioEstudiosPrevios {
    //put your code here
    private $id ;
    private $idSolicitud ;
    private $idDependenciaRequierente ;
    private $descripcionNecesidad ;
    private $analisisCoveniencia ;
    private $maduracionProyecto ;
    private $especificacionesTecnicasObjeto ;
    private $analisisSector ;
    private $valorTotalAportes ;
    private $desembolsos ;
    private $disponibilidadPresupuestal ;
    private $modalidadSeleccion ;
    private $criteriosSeleccion ;
    private $analisisRiesgo ;
    private $garantias ;
    private $limitacionMipymes ;
    private $plazoEjecucion ;
    private $lugarEjecucion ;
    private $obligacionesPartes ;
    private $formaPago ;
    private $controlVigilanciaContrato ;
    private $acuerdosComerciales ;
    private $otrosAspectos ;
    private $conceptosTecnicos ;
    private $fecha ;
    
    // Getters y Setters
  
    public function getId() {
        return $this->id;
    }

    public function getIdSolicitud() {
        return $this->idSolicitud;
    }

    public function getIdDependenciaRequierente() {
        return $this->idDependenciaRequierente;
    }

    public function getDescripcionNecesidad() {
        return $this->descripcionNecesidad;
    }

    public function getAnalisisCoveniencia() {
        return $this->analisisCoveniencia;
    }

    public function getMaduracionProyecto() {
        return $this->maduracionProyecto;
    }

    public function getEspecificacionesTecnicasObjeto() {
        return $this->especificacionesTecnicasObjeto;
    }

    public function getAnalisisSector() {
        return $this->analisisSector;
    }

    public function getValorTotalAportes() {
        return $this->valorTotalAportes;
    }

    public function getDesembolsos() {
        return $this->desembolsos;
    }

    public function getDisponibilidadPresupuestal() {
        return $this->disponibilidadPresupuestal;
    }

    public function getModalidadSeleccion() {
        return $this->modalidadSeleccion;
    }

    public function getCriteriosSeleccion() {
        return $this->criteriosSeleccion;
    }

    public function getAnalisisRiesgo() {
        return $this->analisisRiesgo;
    }

    public function getGarantias() {
        return $this->garantias;
    }

    public function getLimitacionMipymes() {
        return $this->limitacionMipymes;
    }

    public function getPlazoEjecucion() {
        return $this->plazoEjecucion;
    }

    public function getLugarEjecucion() {
        return $this->lugarEjecucion;
    }

    public function getObligacionesPartes() {
        return $this->obligacionesPartes;
    }

    public function getFormaPago() {
        return $this->formaPago;
    }

    public function getControlVigilanciaContrato() {
        return $this->controlVigilanciaContrato;
    }

    public function getAcuerdosComerciales() {
        return $this->acuerdosComerciales;
    }

    public function getOtrosAspectos() {
        return $this->otrosAspectos;
    }

    public function getConceptosTecnicos() {
        return $this->conceptosTecnicos;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setIdSolicitud($idSolicitud): void {
        $this->idSolicitud = $idSolicitud;
    }

    public function setIdDependenciaRequierente($idDependenciaRequierente): void {
        $this->idDependenciaRequierente = $idDependenciaRequierente;
    }

    public function setDescripcionNecesidad($descripcionNecesidad): void {
        $this->descripcionNecesidad = $descripcionNecesidad;
    }

    public function setAnalisisCoveniencia($analisisCoveniencia): void {
        $this->analisisCoveniencia = $analisisCoveniencia;
    }

    public function setMaduracionProyecto($maduracionProyecto): void {
        $this->maduracionProyecto = $maduracionProyecto;
    }

    public function setEspecificacionesTecnicasObjeto($especificacionesTecnicasObjeto): void {
        $this->especificacionesTecnicasObjeto = $especificacionesTecnicasObjeto;
    }

    public function setAnalisisSector($analisisSector): void {
        $this->analisisSector = $analisisSector;
    }

    public function setValorTotalAportes($valorTotalAportes): void {
        $this->valorTotalAportes = $valorTotalAportes;
    }

    public function setDesembolsos($desembolsos): void {
        $this->desembolsos = $desembolsos;
    }

    public function setDisponibilidadPresupuestal($disponibilidadPresupuestal): void {
        $this->disponibilidadPresupuestal = $disponibilidadPresupuestal;
    }

    public function setModalidadSeleccion($modalidadSeleccion): void {
        $this->modalidadSeleccion = $modalidadSeleccion;
    }

    public function setCriteriosSeleccion($criteriosSeleccion): void {
        $this->criteriosSeleccion = $criteriosSeleccion;
    }

    public function setAnalisisRiesgo($analisisRiesgo): void {
        $this->analisisRiesgo = $analisisRiesgo;
    }

    public function setGarantias($garantias): void {
        $this->garantias = $garantias;
    }

    public function setLimitacionMipymes($limitacionMipymes): void {
        $this->limitacionMipymes = $limitacionMipymes;
    }

    public function setPlazoEjecucion($plazoEjecucion): void {
        $this->plazoEjecucion = $plazoEjecucion;
    }

    public function setLugarEjecucion($lugarEjecucion): void {
        $this->lugarEjecucion = $lugarEjecucion;
    }

    public function setObligacionesPartes($obligacionesPartes): void {
        $this->obligacionesPartes = $obligacionesPartes;
    }

    public function setFormaPago($formaPago): void {
        $this->formaPago = $formaPago;
    }

    public function setControlVigilanciaContrato($controlVigilanciaContrato): void {
        $this->controlVigilanciaContrato = $controlVigilanciaContrato;
    }

    public function setAcuerdosComerciales($acuerdosComerciales): void {
        $this->acuerdosComerciales = $acuerdosComerciales;
    }

    public function setOtrosAspectos($otrosAspectos): void {
        $this->otrosAspectos = $otrosAspectos;
    }

    public function setConceptosTecnicos($conceptosTecnicos): void {
        $this->conceptosTecnicos = $conceptosTecnicos;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->mapearObjetoSQL($campo);
            } else {
                $sql = "select * from estudios_previos where $campo = $valor";
                $consulta = ConectorBD::ejecutarQuery($sql, 'convenios');
                if (count($consulta) > 0) {
                    $this->mapearObjetoSQL($consulta[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    
    private function mapearObjetoSQL($consulta) {
        
        $this->setId($consulta[0]);
        $this->setIdSolicitud($consulta[1]);
        $this->setIdDependenciaRequierente($consulta[2]);
        $this->setDescripcionNecesidad($consulta[3]);
        $this->setAnalisisCoveniencia($consulta[4]);
        $this->setMaduracionProyecto($consulta[5]);
        $this->setEspecificacionesTecnicasObjeto($consulta[6]);
        $this->setAnalisisSector($consulta[7]);
        $this->setValorTotalAportes($consulta[8]);
        $this->setDesembolsos($consulta[9]);
        $this->setDisponibilidadPresupuestal($consulta[10]);
        $this->setModalidadSeleccion($consulta[11]);
        $this->setCriteriosSeleccion($consulta[12]);
        $this->setAnalisisRiesgo($consulta[13]);
        $this->setGarantias($consulta[14]);
        $this->setLimitacionMipymes($consulta[15]);
        $this->setPlazoEjecucion($consulta[16]);
        $this->setLugarEjecucion($consulta[17]);
        $this->setObligacionesPartes($consulta[18]);
        $this->setFormaPago($consulta[19]);
        $this->setControlVigilanciaContrato($consulta[20]);
        $this->setAcuerdosComerciales($consulta[21]);
        $this->setOtrosAspectos($consulta[22]);
        $this->setConceptosTecnicos($consulta[23]);
        $this->setFecha($consulta[24]);
    }
  // metodo magico
    function __toString() {
        //return $this->;
    }

    //datos hace la consulta sql.
    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * from  radicado , idoneidad ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by radicado.id_radicado desc ";
        if ($pagina != null && $limit != null) {
            $cadenaSQL .= " offset $pagina limit $limit ";
        }
        return ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
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
        return ConectorBD::ejecutarQuery("select count(*) from  radicado, idoneidad  $filtro", 'secretaria');
    }

    // crea pdf estudios previos
    public function crearPdf() {

        $rutaDocumento = $this->ruta;
        $id = $this->idSolicitud;
        $pdfRuta = __DIR__ . "/../$rutaDocumento/ESTUDIOS PREVIOS_$id.pdf";

        // carga de html plantilla
        ob_start();
        require_once __DIR__ . "/../View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosDocumento.php";
        $html = ob_get_clean();

        // genera pdf de html
        $html2Pdf = new Html2Pdf();
        $html2Pdf->writeHtml($html);
        $html2Pdf->output('estudiosPrevios.pdf');

        // guarda pdf en carpeta
        $convenioDocumentos = new ConvenioDocumentos('id_solicitud', $this->idSolicitud);
        $convenioDocumentos->adicionarDocumento($_FILES['estudiosPrevios.pdf'], 'ESTUDIOS PREVIOS');
    }

    // descargar documento estudios previos
    public function descargar() {

        $this->crearPDF();
        $convenioDocumentos = new ConvenioDocumentos('id_solicitud', $this->idSolicitud);
        $ruta = $convenioDocumentos->getRutas()['estdios_previos'];

        if(file_exists($ruta)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($ruta) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta));
            // Descarga zip temporal
            readfile($ruta);

            return true;
        }
        return false;
    }

    // insertar o actualizar información en la base de datos
    public function guardar() {
        $id = $this->getId();
        if($id == null or $id == '' or $id == 0) {

            $sql = "insert into estudios_previos (
                id_solicitud,
                identificacion_dependencia_requirente,
                descripcion_necesidad,
                analisis_conveniencia,
                maduracion_proyecto,
                especificaciones_tecnicas_objeto,
                analisis_sector,
                valor_total_aportes,
                desembolsos,
                disponibilidad_presupuestal_vigencias_futuras,
                modalidad_seleccion,
                criterios_seleccion_objetiva,
                analisis_riesgo,
                garantias,
                limitacion_mipymes,
                plazo_ejecucion,
                lugar_ejecucion,
                obligaciones_partes,
                forma_pago,
                control_vigilancia_contrato,
                acuerdos_comerciales,
                otros_aspectos,
                conceptos_tecnicos,
                fecha_sistema
            ) values (
                '$this->idSolicitud',
                '$this->idDependenciaRequierente',
                '$this->descripcionNecesidad',
                '$this->analisisCoveniencia',
                '$this->maduracionProyecto',
                '$this->especificacionesTecnicasObjeto',
                '$this->analisisSector',
                '$this->valorTotalAportes',
                '$this->desembolsos',
                '$this->disponibilidadPresupuestal',
                '$this->modalidadSeleccion',
                '$this->criteriosSeleccion',
                '$this->analisisRiesgo',
                '$this->garantias',
                '$this->limitacionMipymes',
                '$this->plazoEjecucion',
                '$this->lugarEjecucion',
                '$this->obligacionesPartes',
                '$this->formaPago',
                '$this->controlVigilanciaContrato',
                '$this->acuerdosComerciales',
                '$this->otrosAspectos',
                '$this->conceptosTecnicos',
                now()
            )";
        } else {

            $sql = "update estudios_previos set
                id_solicitud = '$this->idSolicitud',
                identificacion_dependencia_requirente = '$this->idDependenciaRequierente',
                descripcion_necesidad = '$this->descripcionNecesidad',
                analisis_conveniencia = '$this->analisisCoveniencia',
                maduracion_proyecto = '$this->maduracionProyecto',
                especificaciones_tecnicas_objeto = '$this->especificacionesTecnicasObjeto',
                analisis_sector = '$this->analisisSector',
                valor_total_aportes = '$this->valorTotalAportes',
                desembolsos = '$this->desembolsos',
                disponibilidad_presupuestal_vigencias_futuras = '$this->disponibilidadPresupuestal',
                modalidad_seleccion = '$this->modalidadSeleccion',
                criterios_seleccion_objetiva = '$this->criteriosSeleccion',
                analisis_riesgo = '$this->analisisRiesgo',
                garantias = '$this->garantias',
                limitacion_mipymes = '$this->limitacionMipymes',
                plazo_ejecucion = '$this->plazoEjecucion',
                lugar_ejecucion = '$this->lugarEjecucion',
                obligaciones_partes = '$this->obligacionesPartes',
                forma_pago = '$this->formaPago',
                control_vigilancia_contrato = '$this->controlVigilanciaContrato',
                acuerdos_comerciales = '$this->acuerdosComerciales',
                otros_aspectos = '$this->otrosAspectos',
                conceptos_tecnicos = '$this->conceptosTecnicos',
                fecha_sistema = now()
            where id_estudios_previos = $id";
        }
        
        if(ConectorBD::ejecutarQuery($sql, 'convenios')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("CONVENIOS.ESTUDIOS_PREVIOS");
            //$historico->grabar();
            return true;        
        }
        return false;
    }

    // borrar elementos en la base de datos
    public function borrar() {
        $this->unlink($this->id_radicado);  
        $cadenaSQL = "delete from  radicado where id_radicado = '$this->id_radicado'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("SECRETARIA");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }

    // asignar elementos en la base de datos
    public function asignar() {
        $cadenaSQL = " update radicado set revisor_1 = '$this->revisor_1' , revisor_2= '$this->revisor_2' where id_radicado = '$this->id_radicado'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ASIGNAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("SECRETARIA");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
    public function estado() {
        $cadenaSQL = "UPDATE RADICADO SET ESTADO='$this->estado' WHERE id_radicado = '$this->id_radicado'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ESTADO");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("SECRETARIA");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }

    // modificar elementos en la base de datos, identificador es el codigo o llave primaria a modificar 
    public function modificar($identificador) {
       // $this->unlink($identificador);  
        $cadenaSQL = "update  radicado set doc_1 = '$this->doc_1',doc_2 = '$this->doc_2', doc_3 = '$this->doc_3', doc_4 = '$this->doc_4', doc_5 = '$this->doc_5', doc_6 = '$this->doc_6' where id_radicado = '$identificador'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("SECRETARIA");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
}
