<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// require auntomatico encuentra todas las clases/Model qeu se solicitan en el Controlador
require_once dirname(__FILE__) . "/../../autoload.php";

// Iniciamos sesion para tener las variables
session_start();

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$fecha_vigencia = date("Y");


// variable variable trae las variables que trae POST
foreach ($_POST as $key => $value)
    ${$key} = $value;

// desencripta las variables
$nuevo_POST = Http::decryptIt($I);
// evalua las nuevas variables que vienen ya desencriptadas
foreach ($nuevo_POST as $key => $value)
    ${$key} = $value;

// verificamos permisos
$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), "convenios_contratos");

if ($ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "SA") {
    $permisos = false;
}

$llave_Primaria_Contructor = ( $llave_Primaria == "" ) ? "null" : "'$llave_Primaria'";

// llamamos la clase y verificamos si ya existe info de este dato que llega

if ($id == 1 && $permisos)
{
    $add = $I ;
?>
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Módulo Convenios y Contratos – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Agregar</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
        </div> 
        <div>
            <fieldset>
                <legend title='FORMULARIO DEL MÓDULO QUE DESEA DILIGENCIAR'>FORMULARIO DEL MÓDULO</legend>
                <select required name=formulario id="formulario" onchange="addform( this.value , 'I=<?= $add ?>' )">
                    <option value="">Selección de Formulario</option>
                    <option value="1">Convenios</option>
                    <option value="2">Bienes y Servicios</option>
                    <option value="3">Contratacion Secretaria</option>
                </select>
             </fieldset>
        </div>   
    </div>
    <di id="formularioAdd">
    </di>
<?PHP
}
?>