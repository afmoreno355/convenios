
<?PHP

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tabla
 *
 * @author Dibier
 */
class Convenio {

    // Datos de la tabla
    private $id;
    private $nombre;
    private $area;
    private $abogado;
    private $tecnicoExperto;
    private $mes;
    private $estado;
    // Datos obligatorios de documentos de estudios previos
    private $objeto;
    private $objetoAlcance;
    private $especificacionesTecnicas;
    private $justificacion;
    // Fecha sistema
    private $fecha;
    
    // Getters and Setters
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getArea() {
        return $this->area;
    }

    public function getAbogado() {
        return $this->abogado;
    }

    public function getTecnicoExperto() {
        return $this->tecnicoExperto;
    }

    public function getMes() {
        return $this->mes;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getObjeto() {
        return $this->objeto;
    }

    public function getObjetoAlcance() {
        return $this->objetoAlcance;
    }

    public function getJustificacion() {
        return $this->justificacion;
    }

    public function getEspecificacionesTecnicas() {
        return $this->especificacionesTecnicas;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setArea($area): void {
        $this->area = $area;
    }

    public function setAbogado($abogado): void {
        $this->abogado = $abogado;
    }

    public function setTecnicoExperto($tecnicoExperto): void {
        $this->tecnicoExperto = $tecnicoExperto;
    }

    public function setMes($mes): void {
        $this->mes = $mes;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setObjeto($objeto): void {
        $this->objeto = $objeto;
    }

    public function setObjetoAlcance($objetoAlcance): void {
        $this->objetoAlcance = $objetoAlcance;
    }

    public function setJustificacion($justificacion): void {
        $this->justificacion = $justificacion;
    }

    public function setEspecificacionesTecnicas($especificacionesTecnicas): void {
        $this->especificacionesTecnicas = $especificacionesTecnicas;
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
                $sql = "select id_solicitud,
                               nombre,
                               codigo_area,
                               abogado,
                               tecnico_experto,
                               mes_publicacion,
                               estado,
                               objeto,
                               alcance,
                               especificaciones_tecnicas,
                               justificacion,
                               fecha_sistema
                        from solicitudes where $campo = $valor";
                $resultado = ConectorBD::ejecutarQuery($sql, ' convenios ');
                if ( !empty($resultado) && count($resultado) > 0) {
                    $this->cargarObjetoDeVector($resultado[0]);
                }
            }
        }
    }

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    private function cargarObjetoDeVector($vector) {
        $this->id = $vector[0];
        $this->nombre = $vector[1];
        $this->area = $vector[2];
        $this->abogado = $vector[3];
        $this->tecnicoExperto = $vector[4];
        $this->mes = $vector[5];
        $this->estado = $vector[6];
        $this->objeto = $vector[7];
        $this->alcance = $vector[8];
        $this->especificacionesTecnicas = $vector[9];
        $this->justificacion = $vector[10];
        $this->fecha = $vector[11];
    }


    //datos hace la consulta sql.
    public static function datos($filtro, $pagina, $limit) {
        $cadenaSQL = "select id,
                             nombre,
                             area,
                             abogado,
                             tecnico_experto,
                             mes,
                             estado
                      from convenios ";
        if ($filtro != null) {
            $cadenaSQL .= " where " . $filtro;
        }
        $cadenaSQL .= ' order by id asc' ;
        if ($pagina != null && $limit != null) {
            $cadenaSQL .= " offset $pagina limit $limit ";
        }
        return ConectorBD::ejecutarQuery($cadenaSQL, ' convenios ');
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

    public static function count($filtro) {
        $cadena = 'select count(*) from convenios';
        if ($filtro != null) {
            $cadena.= " where " . $filtro;
        }
        return ConectorBD::ejecutarQuery($cadena, ' convenios ');
    }


    public function Adicionar() {
        $sqlSolicitud="insert into solicitudes 
                                    (area_competente,
                                     abogado,
                                     tecnico_experto,
                                     mes_publicacion,
                                     fecha_registro)
                           values ('$this->area',
                                   '$this->abogado',
                                   '$this->tecnicoExperto',
                                   '$this->mes',
                                   '$this->fecha')";
        $sqlObjeto="insert into objeto"
        //print_r($sql);
        if (ConectorBD::ejecutarQuery($sql, null)) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ADICIONAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("MENU");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
    public function Modificar( $id ) {
        $sql="update menu set
             nombre = '$this->nombre',
             pnombre = '$this->pnombre',
             icono = '$this->icono'
               where id = '$id' ";
        //print_r($sql);
        if (ConectorBD::ejecutarQuery($sql, null)) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("MENU");
            $historico->grabar();
            return true;
        } else {
            return false;
        }
    }
    
    public function Borrar() {
        $sql="delete from menu where id = '$this->id' ";
        print_r($sql);
        if (ConectorBD::ejecutarQuery($sql, null)) {
            
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("MENU");
            $historico->grabar();
            return true;
        } 
        return false;
    }



}


