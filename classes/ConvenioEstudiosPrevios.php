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
    private $id;
    private $centro;
    private $fecha_sistema;
    private $responsable;
    private $doc_1;
    private $doc_2;
    private $doc_3;
    private $doc_4;
    private $doc_5;
    private $doc_6;
    private $estado;
    private $revisor_1;
    private $revisor_2;
    private $contratista;
    

    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from  radicado , idoneidad where radicado.id_radicado = idoneidad.id_radicado and $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_radicado = $vector[0];
        $this->centro = $vector[1];
        $this->fecha_sistema = $vector[2];
        $this->responsable = $vector[3];
        $this->doc_1 = $vector[4];
        $this->doc_2 = $vector[5];
        $this->doc_3 = $vector[6];
        $this->doc_4 = $vector[7];
        $this->doc_5 = $vector[8];
        $this->doc_6 = $vector[9];
        $this->estado = $vector[10];
        $this->revisor_1 = $vector[11];
        $this->revisor_2 = $vector[12];
        $this->contratista = $vector[14];
    }
   
    public function getContratista() {
        return $this->contratista;
    }

    public function setContratista($contratista): void {
        $this->contratista = $contratista;
    }

    function getId_radicado() {
        return $this->id_radicado;
    }

    function getCentro() {
        return $this->centro;
    }

    function getFecha_sistema() {
        return $this->fecha_sistema;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getDoc_1() {
        return $this->doc_1;
    }

    function getDoc_2() {
        return $this->doc_2;
    }

    function getDoc_3() {
        return $this->doc_3;
    }

    function getDoc_4() {
        return $this->doc_4;
    }

    function getDoc_5() {
        return $this->doc_5;
    }

    function getDoc_6() {
        return $this->doc_6;
    }

    function getEstado() {
        return $this->estado;
    }

    function getRevisor_1() {
        return $this->revisor_1;
    }

    function getRevisor_2() {
        return $this->revisor_2;
    }

    function setId_radicado($id_radicado){
        $this->id_radicado = $id_radicado;
    }

    function setCentro($centro){
        $this->centro = $centro;
    }

    function setFecha_sistema($fecha_sistema){
        $this->fecha_sistema = $fecha_sistema;
    }

    function setResponsable($responsable){
        $this->responsable = $responsable;
    }

    function setDoc_1($doc_1){
        $this->doc_1 = $doc_1;
    }

    function setDoc_2($doc_2){
        $this->doc_2 = $doc_2;
    }

    function setDoc_3($doc_3){
        $this->doc_3 = $doc_3;
    }

    function setDoc_4($doc_4){
        $this->doc_4 = $doc_4;
    }

    function setDoc_5($doc_5){
        $this->doc_5 = $doc_5;
    }

    function setDoc_6($doc_6){
        $this->doc_6 = $doc_6;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function setRevisor_1($revisor_1){
        $this->revisor_1 = $revisor_1;
    }

    function setRevisor_2($revisor_2){
        $this->revisor_2 = $revisor_2;
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
