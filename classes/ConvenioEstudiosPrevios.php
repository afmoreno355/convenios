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
        print_r($consulta);
        $this->setIdSolicitud($consulta[0]);
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
    
    // guardar elementos en la base de datos
    public function grabar() {
        $cadenaSQL = "insert into radicado(centro,fecha_sistema,responsable,doc_1,doc_2,doc_3,doc_4,doc_5,doc_6,estado) values('$this->centro','$this->fecha_sistema','$this->responsable','$this->doc_1','$this->doc_2','$this->doc_3','$this->doc_4','$this->doc_5','$this->doc_6','$this->estado');";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("GRABAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("SECRETARIA");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
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
