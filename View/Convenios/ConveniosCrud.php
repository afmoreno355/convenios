<?php
/**
 * 
 * @author Dibier
 */

require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../utilities/Sesion.php';

use Sesion;

// Definir roles
// CO: Coordinador
// AB: Abogado Responsable
// AD: Auxiliar Administrativo
// EC: Técnico Económico
// EX: Técnico Experto
// *: Todos
$roles = ["*"];

// Acceder a la vista
$post = Sesion\iniciar($roles);

// Traer objeto
$idSolicitud = $post['idSoliciud'] !== '' ? $post['idSolicitud'] : null;
$campo = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenio = new Convenio($campo, $idSolicitud);

$convenio->setNombre( $nombre ) ;
$convenio->setMes( $mes ) ;
$convenio->setCodigoArea( $area );
$convenio->setAbogado( $abogado ) ;
$convenio->setEstado('NEGOCIACIÓN') ;
$convenio->setTecnicoExperto( $tecnicoExperto ) ;
print_r("<script>console.log($tecnicoExperto)</script>");
$convenio->setObjeto( $objeto ) ;
print_r("<script>console.log($objeto)</script>");
$convenio->setAlcance( $alcance ) ;
print_r("<script>console.log($alcance)</script>");
$convenio->setJustificacion( $justificacion ) ;
print_r("<script>console.log($justificacion)</script>");

switch ($post['accion']) {
    
    case "GUARDAR":
        $convenio->guardar();
        break;
        
    default:
        die("No se reconoce acción.");
}









/*require_once __DIR__ . "/../../autoload.php";
//
// Iniciamos sesion para tener las variables
if( !isset($_SESSION["user"]) )
{
    session_start();
}

$nombreTilde = array("á", "é", "í", "ó", "ú", "ñ", ".", "", "Á", "É", "Í", "Ó", "Ú", "Ñ", ".", "");
$nombreSinTilde = array("&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "", "", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "", "");
$nombreSinTilde_Nuevo = array("A", "E", "I", "O", "U", "N", "", "", "A", "E", "I", "O", "U", "N", "", "");

date_default_timezone_set("America/Bogota");
$fecha = date("YmdHis");

// variable variable trae las variables que trae POST
foreach ($_POST as $key => $value)
    ${$key} = $value;


$session = new Sesion(" identificacion ", "'{$_SESSION["user"]}'");
$persona = new Persona( " identificacion ", "'{$_SESSION["user"]}'" );
$token1 = $session->getToken1();
$token2 = $session->getToken2();

if ($_SESSION["token1"] !== $_COOKIE["token1"] && $_SESSION["token2"] !== $_COOKIE["token2"]) {
    print_r("NO TIENE PERMISO PARA REALIZAR ESTA ACCION");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"] && password_verify(md5($token1 . $token2), $session->getToken3())) {
    if (isset($accion)) {
        if( $idSolicitud != '' )
        {
            $campo = ' id_solicitud ' ;
            $valor = "'$idSolicitud'" ;
        }
        else
        {
           $idSolicitud = 0 ;
           $campo = null ;
           $valor = null ; 
        }
        $convenio = new Convenio( $campo, $valor ) ;
        if ($accion == "ADICIONAR" || $accion == "MODIFICAR")
        {
            $maximoLetras = INF;

            if(
                Select::validar( $idSolicitud , 'NUMERIC' , null, 'ID SOLICITUD' ) &&
                Select::validar( $nombre , 'TEXT' , 250 , 'NOMBRE' ) &&
                Select::validar( $area , 'NUMERIC' , null , 'CÓDIGO DE ÁREA' ) &&
                Select::validar( $mes , 'TEXT' , 250 , 'MES DE PUBLICCIÓN') &&
                Select::validar( $abogado, 'TEXT' , 250 , 'ABOGADO' ) &&
                Select::validar( $tecnicoExperto, 'TEXT', 250, 'TÉCNICO EXPERTO' ) //&&
                //Select::validar( $objeto, 'TEXT', $maximoLetras, 'OBJETO') &&
                //Select::validar( $alcance, 'TEXT', $maximoLetras, 'ALCANCE OBJETO' ) &&
                //Select::validar( $justificacion, 'TEXT', $maximoLetras, 'JUSTIFICACIÓN')
            )
            {

                $convenio->setNombre( $nombre ) ;
                $convenio->setCodigoArea( $area );
                $convenio->setMes( $mes ) ;
                $convenio->setEstado('NEGOCIACIÓN') ;
                $convenio->setAbogado( $abogado ) ;
                print_r("<script>console.log($tecnicoExperto)</script>");
                $convenio->setTecnicoExperto( $tecnicoExperto ) ;
                print_r("<script>console.log($objeto)</script>");
                $convenio->setObjeto( $objeto ) ;
                print_r("<script>console.log($alcance)</script>");
                $convenio->setAlcance( $alcance ) ;
                print_r("<script>console.log($justificacion)</script>");
                $convenio->setJustificacion( $justificacion ) ;

                if ( $convenio->adicionarModificar( $idSolicitud ) ) 
                {
                    print_r( "Se ha cargado la solicitud en el módulo convenios <|> nombre convenio $nombre " ) ;
                } else {
                    print_r("ERROR INESPERADO, VUELVE A INTENTAR");
                }
            }
        }
        elseif ($accion == "ELIMINAR")
        {
            print_r($idSolicitud);
            $convenio->setId($idSolicitud);
            if ($convenio->borrar()) 
            {
                print_r("EL CONVENIO FUE ELIMINADO");
            } 
            else 
            {
                print_r("EL CONVENIO NO SE PUDO ELIMINAR");
            }
        }
    }
}*/
