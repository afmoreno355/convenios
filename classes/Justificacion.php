<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Justificacion
 *
 * @author FELIP
 */
class Justificacion {
    //put your code here
    private $id_justificacion;
    private $justificacion;
    private $id_radicado;
    
    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from  justificacion where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }
    
     //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_justificaciono = $vector[0];
        $this->justificacion = $vector[1];
        $this->id_radicado = $vector[2];
    }
    
    function getId_justificacion() {
        return $this->id_justificacion;
    }

    function getJustificacion() {
        return $this->justificacion;
    }

    function getId_radicado() {
        return $this->id_radicado;
    }

    function setId_justificacion($id_justificacion) {
        $this->id_justificacion = $id_justificacion;
    }

    function setJustificacion($justificacion) {
        $this->justificacion = $justificacion;
    }

    function setId_radicado($id_radicado) {
        $this->id_radicado = $id_radicado;
    }

    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * justificacion from   ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by id_justificacion asc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  justificacion  $filtro", 'secretaria');
    }   
    
    // guardar elementos en la base de datos
    public function grabar() {
        $nueva_j = str_replace(["'",'"'], ['`', "``"], $this->justificacion );
        $cadenaSQL = "insert into justificacion(justificacion,id_radicado) values('$nueva_j','$this->id_radicado');";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("GRABAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("JUSTIFICACION");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
     // modificar elementos en la base de datos, identificador es el codigo o llave primaria a modificar 
    public function modificar($identificador) {
        $cadenaSQL = "update  justificacion set justificacion = '$this->justificacion' where id_radicado = '$identificador'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("JUSTIFICACION");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }

}
