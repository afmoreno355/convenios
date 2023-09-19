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
           $idSolicitud = 0;
           $campo = null ;
           $valor = null ; 
        }
        $convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campo, $valor);
        if ($accion == "ADICIONAR" || $accion == "MODIFICAR")
        {
            $maximoLetras = INF;

            if(
                Select::validar( $idSolicitud , 'NUMERIC' , null, 'ID SOLICITUD' )
            )
            {

                print_r("<script>console.log($idSolicitud)</script>");
                $convenioEstudiosPrevios->setIdSolicitud($idSolicitud);
                print_r("<script>console.log($descripcionNecesidad)</script>");
                $convenioEstudiosPrevios->setDescripcionNecesidad($descripcionNecesidad) ;
                print_r("<script>console.log($analisisConveniencia)</script>");
                $convenioEstudiosPrevios->setAnalisisCoveniencia($analisisConveniencia);
                print_r("<script>console.log($maduracionProyecto)</script>");
                $convenioEstudiosPrevios->setMaduracionProyecto($maduracionProyecto);
                print_r("<script>console.log($especificacionesTecnicas)</script>");
                $convenioEstudiosPrevios->setEspecificacionesTecnicasObjeto($especificacionesTecnicas);
                print_r("<script>console.log($analisisSector)</script>");
                $convenioEstudiosPrevios->setAnalisisSector($analisisSector);
                print_r("<script>console.log($valorTotalAportes)</script>");
                $convenioEstudiosPrevios->setValorTotalAportes($valorTotalAportes);
                print_r("<script>console.log($disponibilidadPresupuestal)</script>");
                $convenioEstudiosPrevios->setDisponibilidadPresupuestal($disponibilidadPresupuestal);
                print_r("<script>console.log($modalidadSeleccion)</script>");
                $convenioEstudiosPrevios->setModalidadSeleccion($modalidadSeleccion);
                print_r("<script>console.log($criteriosSeleccion)</script>");
                $convenioEstudiosPrevios->setCriteriosSeleccion($criteriosSeleccion);
                print_r("<script>console.log($analisisRiesgo)</script>");
                $convenioEstudiosPrevios->setAnalisisRiesgo($analisisRiesgo);
                print_r("<script>console.log($garantias)</script>");
                $convenioEstudiosPrevios->setGarantias($garantias);
                print_r("<script>console.log($limitacionesMypimes)</script>");
                $convenioEstudiosPrevios->setLimitacionMipymes($limitacionesMypimes);
                print_r("<script>console.log($plazoEjecucion)</script>");
                $convenioEstudiosPrevios->setPlazoEjecucion($plazoEjecucion);
                print_r("<script>console.log($lugarEjecucion)</script>");
                $convenioEstudiosPrevios->setLugarEjecucion($lugarEjecucion);
                print_r("<script>console.log($obligacionesPartes)</script>");
                $convenioEstudiosPrevios->setObligacionesPartes($obligacionesPartes);
                print_r("<script>console.log($formaPago)</script>");
                $convenioEstudiosPrevios->setFormaPago($formaPago);
                print_r("<script>console.log($controlVigilanciaContrato)</script>");
                $convenioEstudiosPrevios->setControlVigilanciaContrato($controlVigilanciaContrato);
                print_r("<script>console.log($acuerdosComerciales)</script>");
                $convenioEstudiosPrevios->setAcuerdosComerciales($acuerdosComerciales);
                print_r("<script>console.log($otrosAspectos)</script>");
                $convenioEstudiosPrevios->setOtrosAspectos($otrosAspectos);
                print_r("<script>console.log($conceptosTecnicos)</script>");
                $convenioEstudiosPrevios->setConceptosTecnicos($conceptosTecnicos);

                if($convenioEstudiosPrevios->guardar()) 
                {
                    print_r( "Se ha cargado la solicitud en el módulo convenios <|> nombre convenio $nombre " ) ;
                } else {
                    print_r("ERROR INESPERADO, VUELVE A INTENTAR");
                }
            }
        }
        elseif ($accion == "DESCARGAR")
        {
            if($convenioEstudiosPrevios->descargar()) {

                print_r("Se ha descargado documento de estudios previos.");
            } else {
                
                print_r("ERROR AL INTENTAR DESCARGAR DOCUMENTO.");
            }
        }
        elseif ($accion == "ELIMINAR")
        {
            print_r($idSolicitud);
            $convenio->setId($idSolicitud);
            if ($convenio->Borrar()) 
            {
                print_r("EL CONVENIO FUE ELIMINADO");
            } 
            else 
            {
                print_r("EL CONVENIO NO SE PUDO ELIMINAR");
            }
        }
    }
}
