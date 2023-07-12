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
                <img src="img/icon/gestionar.png"/><label class="where">Administrador DFP – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Bienes y Servisios</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
        </div>
        <div>
            <fieldset>
                <legend title='CONSECUTIVO'>CONSECUTIVO</legend>
                <input type="text" value= '' required name='CONSECUTIVO' id="CONSECUTIVO">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='GRUPO'>GRUPO</legend>
                <input  required list="coordinacion"  name='coordinaciones' id='coordinaciones' />
                <datalist id="coordinacion">
                    <?= Select::listaopciones( 1 , '' , "select codigosede , concat(codigosede, ' ', nombresede) from sede;" ) ; ?>
                </datalist>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='MES PUBLICACION'>MES PUBLICACIÓN</legend>
                <input  required list="mesp"  name='mespublicacion' id='mespublicacion' />
                <datalist id="mesp">
                    <?= Select::listaopciones( 1 , '' , "select idmes , concat(idmes, ' ', nombre) from bsmes;" ) ; ?>
                </datalist>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='MES PRESENTACION OFERTAS'>MES PRESENTACIÓN OFERTAS</legend>
                <input  required list="mespo"  name='mespresentacion' id='mespresentacion' />
                <datalist id="mespo">
                    <?= Select::listaopciones( 1 , '' , "select idmes , concat(idmes, ' ', nombre) from bsmes;" ) ; ?>
                </datalist>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ABOGADO'>ABOGADO</legend>
                <input  required list="abogados"  name='abogado' id='abogado' />
                <datalist id="abogados">
                    <option value="Chocolate">
                    <option value="Coconut">
                    <option value="Mint">
                    <option value="Strawberry">
                    <option value="Vanilla">
                </datalist>
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
                <legend title='APOYO PROFESIONAL'>APOYO PROFESIONAL</legend>
                <input type="text" value= '' required name='appro' id="appro">
               
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Modalidad'>MODALIDAD</legend>
                <input list="Modalidad" name="Modalidad_selec" id="Modalidad_selec">
                <datalist id="Modalidad">
                    <?= Select::listaopciones( 1 , '' , "select id, concat(id,' ',nombre) from bsmodalidad;" ) ; ?>
                </datalist>
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
                <legend title='Valor'>VALOR</legend>
                <input type="num" value= '' required name='valor' id="valor">
                
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Objeto'>OBJETO</legend>
                <textarea id="objeto" required name="objeto" rows="10" cols="20" value= ''></textarea>
            </fieldset>
        </div>
        <div>     
            
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "Bienes y Servicios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div>
<?PHP
}
?>