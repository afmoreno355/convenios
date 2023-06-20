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
                        form documentaciones where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($sql, ' convenios ');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        /**
         * private $id;
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
         */
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
