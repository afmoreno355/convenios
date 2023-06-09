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
    <h1>1</h1>
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Administrador DFP – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Bienes y Servisios</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
            
        </div>
        <div>
            <fieldset>
                <legend title='NOMBRE'>ID CONTRATO</legend>
                <input type="text" value= '' required name='idcontrato' id="idcontrato">
                
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='AREA'>ÁREA</legend>
                <input type="text" value= '' required name='area' id="area">
                
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ABOGADO'>ABOGADO</legend>
                <input type="text" value= '' required name='abogado' id="abogado">
                
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='TECNICO EXPERTO'>TÉCNICO EXPERTO</legend>
                <input type="text" value= '' required name='texperto' id="texperto">
               
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='APOOYO PROFESIONAL'>APOOYO PROFESIONAL</legend>
                <input type="text" value= '' required name='appro' id="appro">
               
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='TIPO'>TIPO</legend>
                <input type="text" value= '' required name='tiopo' id="tipo">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='VPAA'>VERSIÓN PAA</legend>
                <input type="text" value= '' required name='vpaa' id="tipo">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Adicional'>ADICIONAL?</legend>
                
            </fieldset>
        </div>
        
        <div>     
            
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "Convenios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div>
<?PHP
}
?>