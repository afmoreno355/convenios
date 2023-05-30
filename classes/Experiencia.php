<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Experiencia
 *
 * @author dmelov
 */
class Experiencia {
    //put your code here
    private $id_experiencia;
    private $fecha_in;
    private $fecha_fi;
    private $meses;
    private $dias;
    private $id_idoneidad;
    private $empresa;
    
     // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from experiencia where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }
    
     //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_experiencia = $vector[0];
        $this->fecha_in = $vector[1];
        $this->fecha_fi = $vector[2];
        $this->meses = $vector[3];
        $this->dias = $vector[4];
        $this->id_idoneidad = $vector[5];
        $this->empresa = $vector[6];
    }
    
    public function getId_experiencia() {
        return $this->id_experiencia;
    }

    public function getFecha_in() {
        return $this->fecha_in;
    }

    public function getFecha_fi() {
        return $this->fecha_fi;
    }

    public function getMeses() {
        return $this->meses;
    }

    public function getDias() {
        return $this->dias;
    }

    public function getId_idoneidad() {
        return $this->id_idoneidad;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setId_experiencia($id_experiencia): void {
        $this->id_experiencia = $id_experiencia;
    }

    public function setFecha_in($fecha_in): void {
        $this->fecha_in = $fecha_in;
    }

    public function setFecha_fi($fecha_fi): void {
        $this->fecha_fi = $fecha_fi;
    }

    public function setMeses($meses): void {
        $this->meses = $meses;
    }

    public function setDias($dias): void {
        $this->dias = $dias;
    }

    public function setId_idoneidad($id_idoneidad): void {
        $this->id_idoneidad = $id_idoneidad;
    }

    public function setEmpresa($empresa): void {
        $this->empresa = $empresa;
    }

public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * from experiencia ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by fecha_in desc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  experiencia  $filtro", 'secretaria');
    } 
    
    public function grabar() {
        $cadenaSQL = "insert into experiencia( fecha_in , fecha_fi , meses , dias , id_idoneidad , empresa ) values('$this->fecha_in','$this->fecha_fi','$this->meses','$this->dias','$this->id_idoneidad','$this->empresa');";
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
    
    
    public static function validar( $empresa1 , $fecha_in1 , $fecha_fi1 , $accion , $fecha_autorizacion , $id ) {
        $id_idoneidad = ( new Idoneidad(' id_radicado ', " $id ") )->getId_idoneidad(); 
        ConectorBD::ejecutarQuery( " delete from experiencia where id_idoneidad = $id_idoneidad" , null ) ;
        $experiencia = new Experiencia(null, null);
        for ($i = 0; $i < count($empresa1); $i++) 
        {
            if( $empresa1[$i] != '' )
            {
                if( $fecha_in1[$i] != '' && $fecha_fi1[$i] != '' && $fecha_in1[$i] <= $fecha_fi1[$i] )
                {
                    $experiencia->setEmpresa($empresa1[$i]);
                    $experiencia->setFecha_in($fecha_in1[$i]);
                    $experiencia->setFecha_fi($fecha_fi1[$i]);
                    /*$date1 = new DateTime($fecha_in1[$i]);
                    $date2 = new DateTime($fecha_fi1[$i]);
                    $dif =  $date1->diff($date2);
                    $experiencia->setMeses($dif->m);
                    $experiencia->setDias($dif->days);*/
                    $date1 = strtotime($fecha_in1[$i]);
                    $date2 = strtotime($fecha_fi1[$i]);
                    $dif_D =  ($date2-$date1)/60/60/24;
                    $dif_M =  $dif_D/30;
                    $experiencia->setMeses($dif_M);
                    $experiencia->setDias($dif_D);
                    $experiencia->setId_idoneidad($id_idoneidad);
                    $experiencia->grabar();                
                }
                else 
                {
                    print_r(strtoupper(""));
                }                    
            }
            else 
            {
                print_r(strtoupper(""));
            }
        }
    }
}
