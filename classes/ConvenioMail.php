<?php

/**
 * @author Dibier
 */

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../Librerias/vendor/autoload.php';
require_once __DIR__ . '/../utilities/Documentos.php';
require_once __DIR__ . '/../utilities/Mail.php';
require_once __DIR__ . '/../utilities/Crud.php';

use \Spipu\Html2Pdf\Html2Pdf;
use Documentos;
use Mail;
use Crud;

class ConvenioMail {
    //put your code here
    private $id;
    private $idSolicitud;
    private $destinatario;
    private $email;
    private $asunto;
    private $mensaje;
    private $fecha ;
    
    

    function __construct() {
        $atributos = Crud\getAtributos($this);
        print_r($_POST);
        foreach ($atributos as $id => $atributo) {
            $this->{$atributo} = $_POST[$atributo];
        }
    } 

    public function enviar() {
        $id = $this->idSolicitud;
        $correo= [
            'email' => $this->email,
            'destinatario' => $this->destinatario,
            'asunto' => $this->asunto,
            'mensaje' => $this->mensaje,
            'adjunto' => "/var/www/eagle/convenios/archivos/convenios/57/CONVENIO_57.zip"            
        ];
        Mail\enviar($correo);
    }

   // constructor multifuncional segun el tipo de elemento que recibe realiza una busqueda, funciona como constructor vacio o recibe un array.
    
    /*function __construct($campo, $valor) {

        if ($campo != NULL) {
            if (is_array($campo)) {
                $this->mapear($campo);
            } else {
                $this->leer($campo, $valor);
            }
        }
    }*/

    //organiza el array que recibe el constructor  pero se debe colocar la posicion de la columna en el vector 
    
    /*private function mapear($consulta) {        
        $campos = $this->getCampos();
        foreach ($campos as $atributo => $campo) {
            if ($campo['baseDatos'] !== null) {
                $this->{$atributo} = $consulta[$campo['baseDatos']];
            }            
        }
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

    private function leer($campo, $valor) {
        $sql = "select * from estudios_previos where $campo = $valor";
        $consulta = ConectorBD::ejecutarQuery($sql, 'convenios');

        if (count($consulta) === 0) {
            die("Objeto estudios previos no encontrado. $sql");
        }

        // Seleccionar el primer registro
        $consulta  = $consulta[0];

        // Mapear objeto
        $this->mapear($consulta);
    }

    public function visualizar() {
        $post = array(
            "idSolicitud" => $this->getIdSolicitud()
        );
        $plantilla = 'View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosPlantilla.php';
        Documentos\visualizarPdf($plantilla, $post);
    }

    public function generar() {
        // Parámetros
        $id = $this->idSolicitud;
        $carpeta = __DIR__ . "/../archivos/convenios/$id";
        $ruta = "$carpeta/ESTUDIOS_$id.pdf";
        $plantilla = 'View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosPlantilla.php';
        $post = array(
            "idSolicitud" => $this->getIdSolicitud()
        );
        // Crear PDf con los parámetros
        Documentos\crearPdf($ruta, $plantilla, $post);
    
        return $ruta; // Retorna la ruta del archivo PDF generado
    }
    
    // Descargar documento estudios previos
    public function descargar() {
        $ruta = $this->generar();

        return Documentos\descargar($ruta);
    }
    

    // insertar o actualizar información en la base de datos
    public function guardar() {
        $id = $this->getId();

        foreach ($_POST as $clave => $valor) {
            $$clave = $valor;
        }

        if($id == null or $id == '' or $id == 0) {

            $sql = "insert into estudios_previos (
                id_solicitud,
                identificacion_dependencia_requirente,
                descripcion_necesidad,
                analisis_conveniencia,
                maduracion_proyecto,
                especificaciones_tecnicas_objeto,
                analisis_sector,
                valor_total_aportes,
                desembolsos,
                disponibilidad_presupuestal_vigencias_futuras,
                modalidad_seleccion,
                criterios_seleccion_objetiva,
                analisis_riesgo,
                garantias,
                limitacion_mipymes,
                plazo_ejecucion,
                lugar_ejecucion,
                obligaciones_partes,
                forma_pago,
                control_vigilancia_contrato,
                acuerdos_comerciales,
                otros_aspectos,
                conceptos_tecnicos,
                fecha_sistema
            ) values (
                '$this->idSolicitud',
                '$this->idDependenciaRequierente',
                '$this->descripcionNecesidad',
                '$this->analisisCoveniencia',
                '$this->maduracionProyecto',
                '$this->especificacionesTecnicasObjeto',
                '$this->analisisSector',
                '$this->valorTotalAportes',
                '$this->desembolsos',
                '$this->disponibilidadPresupuestal',
                '$this->modalidadSeleccion',
                '$this->criteriosSeleccion',
                '$this->analisisRiesgo',
                '$this->garantias',
                '$this->limitacionMipymes',
                '$this->plazoEjecucion',
                '$this->lugarEjecucion',
                '$this->obligacionesPartes',
                '$this->formaPago',
                '$this->controlVigilanciaContrato',
                '$this->acuerdosComerciales',
                '$this->otrosAspectos',
                '$this->conceptosTecnicos',
                now()
            )";
        } else {

            $sql = "update estudios_previos set
                id_solicitud = '$idSolicitud',
                identificacion_dependencia_requirente = '$idDependenciaRequierente',
                descripcion_necesidad = '$descripcionNecesidad',
                analisis_conveniencia = '$analisisConveniencia',
                maduracion_proyecto = '$maduracionProyecto',
                especificaciones_tecnicas_objeto = '$especificacionesTecnicas',
                analisis_sector = '$analisisSector',
                valor_total_aportes = '$valorTotalAportes',
                desembolsos = '$desembolsos',
                disponibilidad_presupuestal_vigencias_futuras = '$disponibilidadPresupuestal',
                modalidad_seleccion = '$modalidadSeleccion',
                criterios_seleccion_objetiva = '$criteriosSeleccion',
                analisis_riesgo = '$analisisRiesgo',
                garantias = '$garantias',
                limitacion_mipymes = '$limitacionesMypimes',
                plazo_ejecucion = '$plazoEjecucion',
                lugar_ejecucion = '$lugarEjecucion',
                obligaciones_partes = '$obligacionesPartes',
                forma_pago = '$formaPago',
                control_vigilancia_contrato = '$controlVigilanciaContrato',
                acuerdos_comerciales = '$acuerdosComerciales',
                otros_aspectos = '$otrosAspectos',
                conceptos_tecnicos = '$conceptosTecnicos',
                fecha_sistema = now()
            where id_estudios_previos = $id";
        }
        
        if(ConectorBD::ejecutarQuery($sql, 'convenios')) {
            //Historico de las acciones en el sistemas de informacion
            $nuevo_query = str_replace("'", "|", $sql);
            $historico = new Historico(null, null);
            $historico->setIdentificacion($_SESSION["user"]);
            $historico->setTipo_historico("ELIMINAR");
            $historico->setHistorico(strtoupper($nuevo_query));
            $historico->setFecha("now()");
            $historico->setTabla("CONVENIOS.ESTUDIOS_PREVIOS");
            //$historico->grabar();
            return true;        
        }
        return false;
    }

    // borrar elementos en la base de datos
    public function borrar() {
        $this->unlink($this->id_radicado);  
        $cadenaSQL = "delete from  radicado where id_radicado = '$id_radicado'";
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
    }*/
}
