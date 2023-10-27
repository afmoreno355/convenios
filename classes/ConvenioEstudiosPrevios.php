<?php

/**
 * @author Dibier
 */


require_once __DIR__ . '/../Librerias/vendor/autoload.php';
require_once __DIR__ . '/../utilities/Documentos.php';

use \Spipu\Html2Pdf\Html2Pdf;
use Documentos;

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
    
    
    public function __get($atributo) {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        } else {
            throw new Exception("El atributo $atributo no existe en la clase Coche.");
        }
    }

    public function __set($atributo, $valor) {
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        } else {
            throw new Exception("El atributo $atributo no existe en la clase Coche.");
        }
    }
  
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
                $this->mapear($campo);
            } else {
                $this->leer($campo, $valor);
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    
    private function mapear($consulta) {        
        $campos = $this->getCamposBaseDatos();
        foreach ($campos as $atributo => $campo) {
            $this->{$atributo} = $consulta[$campo];
        }
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

    private function leer($campo, $valor) {
        $sql = "select * from estudios_previos where $campo = $valor";
        $consulta = ConectorBD::ejecutarQuery($sql, 'convenios');

        if (count($consulta) === 0) {
            die("Objeto estudios previos no encontrado. $sql");
        }

        // Seleccionar el primer registro
        $consulta  = $consulta[0];

        // Mapear objeto
        $this->mapear($consulta);
    }

    public function getCamposBaseDatos() {
        return [
            'id' => 'id_estudios_previos',
            'idSolicitud' => 'id_solicitud',
            'idDependenciaRequierente' => 'identificacion_dependencia_requirente',
            'descripcionNecesidad' => 'descripcion_necesidad',
            'analisisCoveniencia' => 'analisis_conveniencia',
            'maduracionProyecto' => 'maduracion_proyecto',
            'especificacionesTecnicasObjeto' => 'especificaciones_tecnicas_objeto',
            'analisisSector' => 'analisis_sector',
            'valorTotalAportes' => 'valor_total_aportes',
            'desembolsos' => 'desembolsos',
            'disponibilidadPresupuestal' => 'disponibilidad_presupuestal_vigencias_futuras',
            'modalidadSeleccion' => 'modalidad_seleccion',
            'criteriosSeleccion' => 'criterios_seleccion_objetiva',
            'analisisRiesgo' => 'analisis_riesgo',
            'garantias' => 'garantias',
            'limitacionMipymes' => 'limitacion_mipymes',
            'plazoEjecucion' => 'plazo_ejecucion',
            'lugarEjecucion' => 'lugar_ejecucion',
            'obligacionesPartes' => 'obligaciones_partes',
            'formaPago' => 'forma_pago',
            'controlVigilanciaContrato' => 'control_vigilancia_contrato',
            'acuerdosComerciales' => 'acuerdos_comerciales',
            'otrosAspectos' => 'otros_aspectos',
            'conceptosTecnicos' => 'conceptos_tecnicos',
            'fecha' => 'fecha_sistema'
        ];
    }

    public function visualizar() {
        $post = array(
            "idSolicitud" => $this->getIdSolicitud()
        );
        $plantilla = 'View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosPlantilla.php';
        Documentos\visualizarPdf($plantilla, $post);
    }

    public function generar() {
        // Parámetros
        $id = $this->idSolicitud;
        $carpeta = __DIR__ . "/../archivos/convenios/$id";
        $ruta = "$carpeta/ESTUDIOS_$id.pdf";
        $plantilla = 'View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosPlantilla.php';
        $post = array(
            "idSolicitud" => $this->getIdSolicitud()
        );
        // Crear PDf con los parámetros
        Documentos\crearPdf($ruta, $plantilla, $post);
    
        return $ruta; // Retorna la ruta del archivo PDF generado
    }
    
    // Descargar documento estudios previos
    public function descargar() {
        $ruta = $this->generar();

        return Documentos\descargar($ruta);
    }
    

    // insertar o actualizar información en la base de datos
    public function guardar() {
        $id = $this->getId();

        foreach ($_POST as $clave => $valor) {
            $$clave = $valor;
        }

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
                id_solicitud = '$idSolicitud',
                identificacion_dependencia_requirente = '$idDependenciaRequierente',
                descripcion_necesidad = '$descripcionNecesidad',
                analisis_conveniencia = '$analisisConveniencia',
                maduracion_proyecto = '$maduracionProyecto',
                especificaciones_tecnicas_objeto = '$especificacionesTecnicas',
                analisis_sector = '$analisisSector',
                valor_total_aportes = '$valorTotalAportes',
                desembolsos = '$desembolsos',
                disponibilidad_presupuestal_vigencias_futuras = '$disponibilidadPresupuestal',
                modalidad_seleccion = '$modalidadSeleccion',
                criterios_seleccion_objetiva = '$criteriosSeleccion',
                analisis_riesgo = '$analisisRiesgo',
                garantias = '$garantias',
                limitacion_mipymes = '$limitacionesMypimes',
                plazo_ejecucion = '$plazoEjecucion',
                lugar_ejecucion = '$lugarEjecucion',
                obligaciones_partes = '$obligacionesPartes',
                forma_pago = '$formaPago',
                control_vigilancia_contrato = '$controlVigilanciaContrato',
                acuerdos_comerciales = '$acuerdosComerciales',
                otros_aspectos = '$otrosAspectos',
                conceptos_tecnicos = '$conceptosTecnicos',
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
        $cadenaSQL = "delete from  radicado where id_radicado = '$id_radicado'";
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
}
