<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pensionado
 *
 * @author dmelov
 */
class Pensionado {
    //put your code here
    private $id_pensionado;
    private $pensionado;
    private $id_radicado;
    
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from pensionado where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }
    
     //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_pensionado = $vector[0];
        $this->pensionado = $vector[1];
        $this->id_radicado = $vector[2];
    }
    
    public function getId_pensionado() {
        return $this->id_pensionado;
    }

    public function getPensionado() {
        return $this->pensionado;
    }

    public function getId_radicado() {
        return $this->id_radicado;
    }

    public function setId_pensionado($id_pensionado): void {
        $this->id_pensionado = $id_pensionado;
    }

    public function setPensionado($pensionado): void {
        $this->pensionado = $pensionado;
    }

    public function setId_radicado($id_radicado): void {
        $this->id_radicado = $id_radicado;
    }
public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * from pensionado ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by id_pensionado asc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  pensionado  $filtro", 'secretaria');
    } 
    
    public function grabar() {
        $cadenaSQL = "insert into pensionado( pensionado,id_radicado ) values('$this->pensionado','$this->id_radicado');";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("GRABAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("PAGO");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
     // modificar elementos en la base de datos, identificador es el codigo o llave primaria a modificar 
    public function modificar($identificador) {
        $cadenaSQL = "update pensionado set pensionado = '$this->pensionado' where id_experiencia = '$identificador'";
        if (ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $cadenaSQL);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("PAGO");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }

}
