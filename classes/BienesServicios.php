<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sede
 *
 * @author Cristian Avella
 */
class BienesServicios {
    //Datos de la tabla BSorden
    private $idbs;
    private $fcreacion;
    private $idexp;
    private $idcoor;
    private $idabo;
    private $idapoy;
    private $idest;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) {
                $this->objeto($campo);
            }else{
                $cadenaSQL="select * from sede bsorden ";
                //print_r($cadenaSQL);
                $respuesta= ConectorBD::ejecutarQuery($cadenaSQL, 'eagle_admin');
                if ($respuesta>0 || $valor!=null) $this->objeto ($respuesta[0]);
            }
        }
    }

    private function objeto($vector){
        $this->idbs=$vector[0];
        $this->fcreacion=$vector[1];
        $this->idexp=$vector[2];
        $this->idcoor=$vector[3];
        $this->idabo=$vector[4];
        $this->idapoy=$vector[5];
        $this->idest=$vestor[6];
    }
    
    public function getIdbs() {
        return $this->idbs;
    }

    public function setIdbs($getidbs): void {
        $this->idbs = $getidbs;
    }

    function getFcreacion() {
        return $this->fcreacion;
    }

    function setFcreacion($fcreacion){
        $this->fcreacion = $fcreacion;
    }

    function getIdexp() {
        return $this->idexp;
    }

    function setIdexp($idexp){
        $this->idexp = $idexp;
    }

    function getIdcoor() {
        return $this->idcoor;
    }

    function setIdcoor($idcoor){
        $this->idcoor = $idcoor;
    }

    function getIdabo() {
        return $this->idabo;
    }
    
    function setIdabo($idabo) {
        $this->idabo = $idabo;
    }

    function getIdapoy() {
        return $this->idapoy;
    }

    function seIdapoy($idapoy) {
        $this->idapoy = $idapoy;
    }

    function getIdest() {
        return $this->idest;
    }
    
    function setIdest($idest) {
        $this->idest = $idest;
    }
    
    public function __toString() {
        return $this->nombre;
    }
   
    public static function datos($filtro, $pagina, $limit){
        $cadenaSQL="select * from sede , departamento where departamento=id ";
         if($filtro!=''){
            $cadenaSQL.=" and $filtro";
        } 
        $cadenaSQL.=" order by codigosede asc offset $pagina limit $limit ";
        //print_r($cadenaSQL);
        return ConectorBD::ejecutarQuery($cadenaSQL, 'eagle_admin');          
    }
    
    public static function datosobjetos($filtro, $pagina, $limit){
        $datos= Sede::datos($filtro, $pagina, $limit);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $sede=new Sede($datos[$i], null);
            $lista[$i]=$sede;
        }
        return $lista;
    }
    
     public static function count($filtro) {
        $cadena='select count(*) from sede , departamento where departamento=id '; 
        if($filtro!=''){
            $cadena.=" and $filtro";
        } 
        return ConectorBD::ejecutarQuery($cadena, 'eagle_admin');        
    }
    
    public static function listaopciones(){ 
        $lista='';
        $si= ConectorBD::ejecutarQuery("select codigosede,nombresede,bd,imagen,nom_departamento from  sede, departamento where departamento.id=sede.departamento", null);
        for ($i = 0; $i < count($si); $i++) {
            $lista.="<option value='{$si[$i][0]}'> {$si[$i][4]} {$si[$i][0]} {$si[$i][1]}</option>";
        }
    return $lista;
    } 
    
  }

  
  
  

