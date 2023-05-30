<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pago
 *
 * @author dmelov
 */
class Pago {
    //put your code here
    private $id_pago;
    private $duracion;
    private $mes_inicio;
    private $v_pago;
    private $v_p_pago;
    private $v_u_pago;
    private $id_radicado;
    
    // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    function __construct($campo, $valor) {
        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->cargarObjetoDeVector($campo);
            } else {
                $cadenaSQL = "select * from  pago where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'secretaria');
                if (count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }
    
     //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id_pago = $vector[0];
        $this->duracion = $vector[1];
        $this->mes_inicio = $vector[2];
        $this->v_pago = $vector[3];
        $this->v_p_pago = $vector[4];
        $this->v_u_pago = $vector[5];
        $this->id_radicado = $vector[6];
    }
    public function getId_pago() {
        return $this->id_pago;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getMes_inicio() {
        return $this->mes_inicio;
    }

    public function getV_pago() {
        return $this->v_pago;
    }

    public function getV_p_pago() {
        return $this->v_p_pago;
    }

    public function getV_u_pago() {
        return $this->v_u_pago;
    }

    public function getId_radicado() {
        return $this->id_radicado;
    }

    public function setId_pago($id_pago): void {
        $this->id_pago = $id_pago;
    }

    public function setDuracion($duracion): void {
        $this->duracion = $duracion;
    }

    public function setMes_inicio($mes_inicio): void {
        $this->mes_inicio = $mes_inicio;
    }

    public function setV_pago($v_pago): void {
        $this->v_pago = $v_pago;
    }

    public function setV_p_pago($v_p_pago): void {
        $this->v_p_pago = $v_p_pago;
    }

    public function setV_u_pago($v_u_pago): void {
        $this->v_u_pago = $v_u_pago;
    }

    public function setId_radicado($id_radicado): void {
        $this->id_radicado = $id_radicado;
    }

public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select * pago from   ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= " order by id_pago asc ";
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
        return ConectorBD::ejecutarQuery("select count(*) from  pago  $filtro", 'secretaria');
    }   
    public function grabar() {
        $cadenaSQL = "insert into pago(  duracion , mes_inicio , v_pago , v_p_pago , v_u_pago , id_radicado) values('$this->duracion','$this->mes_inicio','$this->v_pago','$this->v_p_pago','$this->v_u_pago','$this->id_radicado');";
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
        $cadenaSQL = "update pago set duracion = '$this->duracion' , mes_inicio= '$this->mes_inicio' , v_pago = '$this->v_pago' , v_p_pago = '$this->v_p_pago' , v_u_pago = '$this->v_u_pago' where id_radicado = '$identificador'";
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
    
    public function meses($duracion)
    {       
        $lista = '<option value="">Duración</option>' ;
        for ($i = 1; $i < 13; $i++)
        {
            if( $duracion == $i )
            {
               
                $auxiliar = 'selected' ;
            }
            else  
            {
                $auxiliar = '' ;
            }
            $lista .= "<option value='$i' $auxiliar >$i</option>" ;
        }
        return $lista ;
    }
    public function meses_anio($meses_anio)
    {       
        $lista = '<option value="">Mes Inicio</option>' ;
        for ($i = 1; $i < 13; $i++)
        {
            if( $meses_anio == $i )
            {               
                $auxiliar = 'selected' ;
            }
            else  
            {
                $auxiliar = '' ;
            }
            if( $i==1 )
            {
                $lista .= "<option value='$i' $auxiliar >Enero</option>" ;
            }
            elseif( $i==2 )
            {
                $lista .= "<option value='$i' $auxiliar >Febrero</option>" ;
            }
            elseif( $i==3 )
            {
                $lista .= "<option value='$i' $auxiliar >Marzo</option>" ;
            }
            elseif( $i==4 )
            {
                $lista .= "<option value='$i' $auxiliar >Abril</option>" ;
            }
            elseif( $i==5 )
            {
                $lista .= "<option value='$i' $auxiliar >Mayo</option>" ;
            }
            elseif( $i==6 )
            {
                $lista .= "<option value='$i' $auxiliar >Junio</option>" ;
            }
            elseif( $i==7 )
            {
                $lista .= "<option value='$i' $auxiliar >Julio</option>" ;
            }
            elseif( $i==8 )
            {
                $lista .= "<option value='$i' $auxiliar >Agosto</option>" ;
            }
            elseif( $i==9 )
            {
                $lista .= "<option value='$i' $auxiliar >Septiembre</option>" ;
            }
            elseif( $i==10 )
            {
                $lista .= "<option value='$i' $auxiliar >Octubre</option>" ;
            }
            elseif( $i==11 )
            {
                $lista .= "<option value='$i' $auxiliar >Noviembre</option>" ;
            }
            elseif( $i==12 )
            {
                $lista .= "<option value='$i' $auxiliar >Diciembre</option>" ;
            }
        }
        return $lista ;
    }
    public function mes($mes, $suma)
    {     
        for ($i = 0; $i < $suma-1; $i++) 
        {
            $mes = $mes + 1 ;
            if( $mes == 13 )
            {
                $mes = 1 ;
            }
        }
        if( $mes==1 )
        {
            return "Enero" ;
        }
        elseif( $mes==2 )
        {
            return "Febrero" ;
        }
        elseif( $mes==3 )
        {
            return "Marzo" ;
        }
        elseif( $mes==4 )
        {
            return "Abril" ;
        }
        elseif( $mes==5 )
        {
            return "Mayo" ;
        }
        elseif( $mes==6 )
        {
            return "Junio" ;
        }
        elseif( $mes==7 )
        {
            return "Julio" ;
        }
        elseif( $mes==8 )
        {
            return "Agosto" ;
        }
        elseif( $mes==9 )
        {
            return "Septiembre" ;
        }
        elseif( $mes==10 )
        {
            return "Octubre" ;
        }
        elseif( $mes==11 )
        {
            return "Noviembre" ;
        }
        elseif( $mes==12 )
        {
            return "Diciembre" ;
        }
    }
}
