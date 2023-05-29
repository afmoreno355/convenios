<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona
 *
 * @author Felipe Moreno
 */
class Persona {

    //put your code here
    private $id;
    private $nombre;
    private $apellido;
    private $tel;
    private $correo;
    private $celular;
    private $dependencia;
    private $idsede;
    private $idTipo;
    private $jefeACargo;
    private $password;
    private $imagen;

    function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from persona where $campo=$valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'eagle');
                if (count($resultado) > 0)
                    $this->cargarObjetoDeVector($resultado[0]);
            }
        }
    }

    private function cargarObjetoDeVector($vector) {

        $this->id = $vector[0];
        $this->nombre = $vector[1];
        $this->apellido = $vector[2];
        $this->tel = $vector[3];
        $this->correo = $vector[4];
        $this->celular = $vector[5];
        $this->dependencia = $vector[6];
        $this->idsede = $vector[7];
        $this->idTipo = $vector[8];
        $this->jefeACargo = $vector[9];
        $this->password = $vector[10];
        $this->imagen = $vector[11];
    }

    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function getId() {
        return trim($this->id);
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getTel() {
        return $this->tel;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getCelular() {
        return $this->celular;
    }

    function getDependencia() {
        return $this->dependencia;
    }

    function getidsede() {
        return $this->idsede;
    }

    function getIdTipo() {
        return $this->idTipo;
    }

    function IdTipo() {
        if ($this->idTipo != 'SA') {
            return new Cargo("codigocargo", "'" . $this->idTipo . "'");
        } else {
            return 'SUPER ADMINISTRADOR';
        }
    }

    function getJefeACargo() {
        return $this->jefeACargo;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setDependencia($dependencia) {
        $this->dependencia = $dependencia;
    }

    function setidsede($idsede) {
        $this->idsede = $idsede;
    }

    function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    function setJefeACargo($jefeACargo) {
        $this->jefeACargo = $jefeACargo;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public function __toString() {
        return trim($this->nombre) . " " . trim($this->apellido);
    }

    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * from persona where identificacion<>'20000000' " . $filtro;
        if ($limit != null) {
            $cadenaSQL .= " order by identificacion asc offset $pagina limit $limit ";
        }
        return ConectorBD::ejecutarQuery($cadenaSQL, 'eagle');
    }

    public static function datosobjetos($filtro, $pagina, $limit) {
        $datos = Persona::datos($filtro, $pagina, $limit);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $persona = new Persona($datos[$i], null);
            $lista[$i] = $persona;
        }
        return $lista;
    }
    public static function count($filtro) {
        return ConectorBD::ejecutarQuery("select count(*) from persona where identificacion<>'1085264553' " . $filtro, 'eagle');
    }
    public static function lista( $PERSONA , $TIPO = ''  , $DEPENDENCIA = '' ) {
        if ( $TIPO == 'JURIDICO' ) 
        { 
            $filtro = " idtipo = 'RJ' "  ;
        }
        elseif ( $TIPO == 'TECNICO' ) 
        {
            $filtro =  " idtipo = 'RT' " ;
        }
        elseif ( $TIPO == 'ASIGNAR' ) 
        {
            $filtro =  " idtipo = 'AS' and dependencia = '$DEPENDENCIA' " ;
        }
        else
        {
         '' ;
        }
        $lista = "<option value=''> REVISOR $TIPO</option>" ;
        $sql = self::datosobjetos( " and $filtro" , null , null ) ;
        for ($i = 0; $i < count($sql); $i++) {
            $obj = $sql[$i];
            $lista .= "<option value='{$obj->getId()}'> {$obj->getId()} {$obj->getNombre()} {$obj->getApellido()} {$obj->getDependencia()} </option>" ;
        }
        return $lista;
    }
}
