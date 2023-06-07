<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autorizacion
 *
 * @author FELIP
 */
class Idoneidad {
    //put your code here
    private $id_idoneidad;
    private $nombre;
    private $cumple;
    private $fecha_sistema;
    private $id_radicado;
      

    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from  idoneidad where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_idoneidad = $vector[0];
        $this->nombre = $vector[1];
        $this->cumple = $vector[2];
        $this->fecha_sistema = $vector[3];
        $this->id_radicado= $vector[4];
       
    }
   
    function getId_idoneidad() {
        return $this->id_idoneidad;
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getCumple() {
        return $this->cumple;
    }

    function getFecha_sistema() {
        return $this->fecha_sistema;
    }

    function getId_radicado() {
        return $this->id_radicado;
    }

    function setId_idoneidad($id_idoneidad){
        $this->id_idoneidad = $id_idoneidad;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function setCumple($cumple){
        $this->cumple = $cumple;
    }

    function setFecha_sistema($fecha_sistema){
        $this->fecha_sistema = $fecha_sistema;
    }

    function setId_radicado($id_radicado){
        $this->id_radicado = $id_radicado;
    }

               
    // metodo magico
    function __toString() {
        //return $this->;
    }

    //datos hace la consulta sql.
    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * from  idoneidad  ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by id_idoneidad asc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  id_idoneidad  $filtro", 'secretaria');
    }   
    
    // guardar elementos en la base de datos
    public function grabar() {
        $cadenaSQL = "insert into idoneidad(nombre,cumple,fecha_sistema,id_radicado) values('$this->nombre','$this->cumple','$this->fecha_sistema','$this->id_radicado');";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("GRABAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("IDONEIDAD");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }

    // asignar elementos en la base de datos
    public function modificar() {
        $cadenaSQL = " update idoneidad set nombre = '$this->nombre' , cumple = '$this->cumple'  where id_radicado = '$this->id_radicado'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("IDONEIDAD");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
}
