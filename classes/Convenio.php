
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
    private $codigoArea;
    private $abogado;
    private $tecnicoExperto;
    private $mes;
    private $estado;
    // Datos obligatorios de documentos de estudios previos
    private $objeto;
    private $alcance;
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

    public function getCodigoArea() {
        return $this->codigoArea;
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

    public function getAlcance() {
        return $this->alcance;
    }

    public function getJustificacion() {
        return $this->justificacion;
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

    public function setCodigoArea($codigoArea): void {
        $this->codigoArea = $codigoArea;
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

    public function setAlcance($alcance): void {
        $this->alcance = $alcance;
    }

    public function setJustificacion($justificacion): void {
        $this->justificacion = $justificacion;
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
        $this->codigoArea = $vector[2];
        $this->abogado = $vector[3];
        $this->tecnicoExperto = $vector[4];
        $this->mes = $vector[5];
        $this->estado = $vector[6];
        $this->objeto = $vector[7];
        $this->alcance = $vector[8];
        $this->justificacion = $vector[9];
        $this->fecha = $vector[10];
    }


    //datos hace la consulta sql.
    public static function datos($filtro, $pagina, $limit) {
        $sql = "select id_solicitud,
                       nombre,
                       codigo_area,
                       abogado,
                       tecnico_experto,
                       mes_publicacion,
                       estado,
                       objeto,
                       alcance,
                       justificacion,
                       fecha_sistema
                from solicitudes ";
        if ($filtro != null) {
            $sql .= " where " . $filtro;
        }
        $sql .= ' order by id_solicitud asc ' ;
        if ($pagina != null && $limit != null) {
            $sql .= " offset $pagina limit $limit ";
        }
        return ConectorBD::ejecutarQuery($sql, ' convenios ');
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
        $sql = 'select count(*) from solicitudes';
        if ($filtro != null) {
            $sql.= " where " . $filtro;
        }
        return ConectorBD::ejecutarQuery($sql, ' convenios ');
    }


    public function Adicionar() {
        $sql="insert into solicitudes (
                                    nombre,
                                    codigo_area,
                                    abogado,
                                    tecnico_experto,
                                    mes_publicacion,
                                    estado,
                                    objeto,
                                    alcance,
                                    justificacion,
                                    fecha_sistema
                                    )
                               values (
                                    '$this->nombre',
                                    '$this->codigoArea',
                                    '$this->abogado',
                                    '$this->tecnicoExperto',
                                    '$this->mes',
                                    '$this->estado',
                                    '$this->objeto',
                                    '$this->alcance',
                                    '$this->justificacion',
                                    now()
                                   )";
        //print_r($sql);
        if (ConectorBD::ejecutarQuery($sql, ' convenios ')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ADICIONAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("convenio.solicitudes");
            //$historico->grabar();
            return true;
        } /** */
        return false;
    }
    
    public function Modificar( $id ) {
        $sql = "update solicitudes set
                        nombre = '$this->nombre',
                        codigo_area = '$this->codigoArea',
                        abogado = '$this->abogado',
                        tecnico_experto = '$this->tecnicoExperto',
                        mes_publicacion = '$this->mes',
                        estado = '$this->estado',
                        objeto = '$this->objeto',
                        alcance = '$this->alcance',
                        justificacion = '$this->justificacion',
                        fecha_sistema = now()
                where id_solicitud = $id ";
        // print_r($sql);
        if (ConectorBD::ejecutarQuery($sql, ' convenios ')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("MODIFICAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("convenio.solicitudes");
            $historico->grabar();
            return true;
        }/** */
        return false;
    }

    public function AdicionarModificar( $id ) {
        if ( $id == 0 ) {
            return $this->Adicionar() ;
        } else {
            return $this->Modificar( $id ) ;
        }
    }
    
    public function Borrar() {
        $sqlDocumentaciones = "delete from documentaciones where id_solicitud = '$this->id'";
        ConectorBD::ejecutarQuery($sqlDocumentaciones, ' convenios ');
        $sqlSolicitud="delete from solicitudes where id_solicitud = '$this->id'";
        if (ConectorBD::ejecutarQuery($sqlSolicitud, ' convenios ')) {
            
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sqlSolicitud);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("convenios.solicitudes");
            $historico->grabar();
            return true;
        } 
        return false;
    }



}


