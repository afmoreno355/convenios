<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . "/../../autoload.php";
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
    
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"] && password_verify(md5($token1 . $token2), $session->getToken3())) {
    if (isset($accion)) {
        if( $idSolicitud != '' )
        {
            $campo = ' id_solicitud ' ;
            $valor = "'$idSolicitud'" ;
        }
        else
        {
           $idSolicitud= 0 ;
           $campo = null ;
           $valor = null ; 
        }
        $convenioDocumentos = new ConvenioDocumentos( $campo, $valor ) ;
        if ($accion == "ADICIONAR" || $accion == "MODIFICAR")
        {
            $maximoLetras = 250;
            if (
                 Select::validar( $idSolicitud , 'NUMERIC' , null, 'ID DOCUMENTACIÓN' )/* &&
                 Select::validar( $memorando , 'TEXT' , 250 , 'NOMBRE' ) &&
                 Select::validar( $area , 'NUMERIC' , null , 'CÓDIGO DE ÁREA' ) &&
                 Select::validar( $mes , 'TEXT' , 250 , 'MES DE PUBLICCIÓN') &&
                 Select::validar( $abogado, 'TEXT' , 250 , 'ABOGADO' ) &&
                 Select::validar( $tecnicoExperto, 'TEXT', 250, 'TÉCNICO EXPERTO' ) &&
                 Select::validar( $objeto, 'TEXT', $maximoLetras, 'OBJETO') &&
                 Select::validar( $alcance, 'TEXT', $maximoLetras, 'ALCANCE OBJETO' ) &&
                 Select::validar( $justificacion, 'TEXT', $maximoLetras, 'JUSTIFICACIÓN')*/
                )
            {
                //ConvenioDocumentos::zipDocumentos($idSolicitud);
                $convenioDocumentos->setMemorando( $_FILES['memorando'] ) ;
                $convenioDocumentos->setEstudiosPrevios( $_FILES['estudiosPrevios'] ) ;
                $convenioDocumentos->setAnexoTecnico( $_FILES['anexoTecnico'] ) ;
                $convenioDocumentos->setAnalisisSector( $_FILES['analisisSector'] ) ;
                $convenioDocumentos->setSolicitudConceptoTecnico( $_FILES['solicitudConceptoTecnico'] ) ;
                $convenioDocumentos->setPropuestaTecnicaEconomica( $_FILES['propuestaTecnicaEconomica'] ) ;
                $convenioDocumentos->setMatrizRiesgos( $_FILES['matrizRiesgos'] ) ;
                $convenioDocumentos->setDisponibilidadPresupuestal( $_FILES['disponibilidadPresupuestal'] ) ;
                $convenioDocumentos->setPaa( $_FILES['paa'] ) ;
                $convenioDocumentos->setProyectoAutorizacion( $_FILES['proyectoAutorizacion'] ) ;/** */


                if ( $convenioDocumentos->adicionarModificar( $idSolicitud ) ) 
                {
                    print_r( "Se ha cargado la solicitud en el módulo convenios <|> nombre convenio $nombre " );
                } else {
                    print_r("ERROR INESPERADO, VUELVE A INTENTAR");
                }  
            }
        }
        elseif ($accion == "ELIMINAR")
        {
            $convenioDocumentos->setIdSolicitud($idSolicitud);
            if ($convenioDocumentos->borrar())
            {
                print_r("EL CONVENIO FUE ELIMINADO");
            } 
            else 
            {
                print_r("EL CONVENIO NO SE PUDO ELIMINAR");
            }
        }
        elseif ($accion == "DESCARGAR")
        {
            if ($convenioDocumentos -> descargarDocumentosZip($idSolicitud)) {

                print_r("Se ha descargado el archivo ZIP de documentos");
            } else {

                print_r("NO SE PUDO DESCARGAR LA DOCUMENTACIÓN");
            }
        }
    }
}
