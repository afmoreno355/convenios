<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . "/../../autoload.php";
//
// Iniciamos sesion para tener las variables
if (!isset($_SESSION["user"])) {
    session_start();
}

$nombreTilde = array("á", "é", "í", "ó", "ú", "ñ", ".", "", "Á", "É", "Í", "Ó", "Ú", "Ñ", ".", "");
$nombreSinTilde = array("&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "", "", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "", "");
$nombreSinTilde_Nuevo = array("A", "E", "I", "O", "U", "N", "", "", "A", "E", "I", "O", "U", "N", "", "");

date_default_timezone_set("America/Bogota");
// variable variable trae las variables que trae POST
foreach ($_POST as $key => $value)
    ${$key} = $value;

$session = new Sesion(" identificacion ", "'{$_SESSION["user"]}'");
$persona = new Persona(" identificacion ", "'{$_SESSION["user"]}'");
$token1 = $session->getToken1();
$token2 = $session->getToken2();
if ($_SESSION["token1"] !== $_COOKIE["token1"] && $_SESSION["token2"] !== $_COOKIE["token2"]) {
    print_r("NO TIENE PERMISO PARA REALIZAR ESTA ACCION");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"] && password_verify(md5($token1 . $token2), $session->getToken3())) {
    if (isset($accion)) {
        if ($id != '') {
            $v1_A = ' id ';
            $v2_A = "'$id'";
        } else {
            $v1_A = null;
            $v2_A = null;
        }
        
        $BienesServicios = new cargo($v1_A, $v2_A);
        print_r($accion);
        Print_r("+**+");

        if ($accion == "ADICIONAR" || $accion == "MODIFICAR") {
            if (Select::validar($codigocargo, 'TEXT', 3, 'CODIGOCARGO') &&
                    Select::validar($nombrecargo, 'TEXT', 200, 'NOMBRECARGO') &&
                    Select::validar($detalle, 'TEXT', 250, 'DETALLE')
            ) {
                $BienesServicios->setCodigocargo(str_replace($nombreTilde, $nombreSinTilde, strtoupper($codigocargo)));
                $BienesServicios->setNombrecargo(str_replace($nombreTilde, $nombreSinTilde, strtoupper($nombrecargo)));
                $BienesServicios->setDetalle(str_replace($nombreTilde, $nombreSinTilde, strtoupper($detalle)));
                if ($accion == "ADICIONAR") {
                    if ($BienesServicios->Adicionar()) {
                        $id = ConectorBD::ejecutarQuery("select id from cargo where codigocargo = '{$cargo->getCodigocargo()}'; ", null)[0][0];
                        print_r("Se ha creado el contrato con el id: $id");
                    } else {
                        print_r("** ERROR INESPERADO VUELVE A INTENTAR **");
                    }
                } elseif ($accion == "MODIFICAR") {
                    if ($BienesServicios->modificar($id)) {
                        print_r("Se ha modificado el contrato con id: <|> id cargo $id");
                    } else {
                        print_r("** ERROR INESPERADO VUELVE A INTENTAR **");
                    }
                }
            }
        } elseif ($accion == "ELIMINAR") {
            $BienesServicios->setId($id);
            if ($BienesServicios->borrar()) {
                print_r("** EL CONTRATO FUE ELIMINADO. **");
            } else {
                print_r("** EL CONTRATO NO PUDO SER ELIMINADO, EXISTE ALGUNA CONTRATO ASOCIADO. **");
            }
        } elseif ($accion == "BLOQUEAR"){
            print_r(":D");
        }
    }
}
        
