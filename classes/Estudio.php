<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estudio
 *
 * @author FELIP
 */
class Estudio {
    //put your code here
    private $id_estudio;
    private $objeto;
    private $educacion;
    private $experiencia;
    private $valor;
    private $municipio;
    private $id_radicado;
    private $fecha;
    private $generador;
    private $ordenador;
    private $directivo;
    
    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from  estudio where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_estudio = $vector[0];
        $this->objeto = $vector[1];
        $this->educacion = $vector[2];
        $this->experiencia = $vector[3];
        $this->valor = $vector[4];
        $this->municipio = $vector[5];
        $this->id_radicado = $vector[6];
        $this->fecha = $vector[7];
        $this->generador = $vector[8];
        $this->ordenador = $vector[9];
        $this->directivo = $vector[10];
    }
    public function getDirectivo() {
        return $this->directivo;
    }

    public function setDirectivo($directivo): void {
        $this->directivo = $directivo;
    }

    public function getOrdenador() {
        return $this->ordenador;
    }

    public function setOrdenador($ordenador): void {
        $this->ordenador = $ordenador;
    }

    function getId_estudio() {
        return $this->id_estudio;
    }

    function getObjeto() {
        return $this->objeto;
    }

    function getEducacion() {
        return $this->educacion;
    }

    function getExperiencia() {
        return $this->experiencia;
    }

    function getValor() {
        return $this->valor;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getId_radicado() {
        return $this->id_radicado;
    }

    function setId_estudio($id_estudio) {
        $this->id_estudio = $id_estudio;
    }

    function setObjeto($objeto) {
        $this->objeto = $objeto;
    }

    function setEducacion($educacion) {
        $this->educacion = $educacion;
    }

    function setExperiencia($experiencia) {
        $this->experiencia = $experiencia;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    function setId_radicado($id_radicado) {
        $this->id_radicado = $id_radicado;
    }
    
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }
    
    public function getGenerador() {
        return $this->generador;
    }

    public function setGenerador($generador): void {
        $this->generador = $generador;
    }

    
    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * estudio from   ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by id_estudio asc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  estudio  $filtro", 'secretaria');
    }   
    
    // guardar elementos en la base de datos
    public function grabar() {
        $cadenaSQL = "insert into estudio(objeto,educacion,experiencia,valor,municipios,id_radicado, fecha, generador, ordenador, directivo) values('$this->objeto','$this->educacion','$this->experiencia','$this->valor','$this->municipio','$this->id_radicado','$this->fecha','$this->generador','$this->ordenador','$this->directivo');";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("GRABAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("ESTUDIO");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
     // modificar elementos en la base de datos, identificador es el codigo o llave primaria a modificar 
    public function modificar($identificador) {
        $cadenaSQL = "update  estudio set objeto = '$this->objeto',educacion= '$this->educacion', experiencia = '$this->experiencia', municipios = '$this->municipio', valor = '$this->valor', fecha = '$this->fecha', generador = '$this->generador', ordenador = '$this->ordenador' , directivo = '$this->directivo' where id_radicado = '$identificador'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("ESTUDIO");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
}
