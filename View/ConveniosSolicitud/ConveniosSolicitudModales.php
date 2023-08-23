<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// require auntomatico encuentra todas las clases/Model qeu se solicitan en el Controlador
require_once __DIR__ . "/../../autoload.php";

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
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), 'eagle');

if ($ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "SA") {
    $permisos = false;
}

$llave_Primaria_Contructor = ( $llave_Primaria == "" ) ? "null" : "'$llave_Primaria'";

// llamamos la clase y verificamos si ya existe info de este dato que llega
$convenio = new Convenio( ' id_solicitud ' , $llave_Primaria_Contructor);
if ($permisos)
{
?>
<!--Modal 1 adicionar-->
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Administrador DFP – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Convenios</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
            <label style="font-size: 1em; " id="aviso2" class="aviso" ><?= $convenio->getId() ?></label> 
        </div>
        <div>
            <fieldset>
                <legend title='NOMBRE'>NOMBRE CONVENIO</legend>
                <input type="text" value='<?= $convenio->getNombre() ?>' required name='nombre' id="nombre">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='AREA'>ÁREA</legend>
                <input type="number" value='<?= $convenio->getCodigoArea() ?>' required name='area' id="area">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='MES'>MES DE PUBLICACIÓN</legend>
                <input type="text" value='<?= $convenio->getMes() ?>' required name='mes' id="mes">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ABOGADO'>ABOGADO</legend>
                <input type='text'  value='<?= $convenio->getAbogado() ?>'  name='abogado' id='abogado' >
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='TECNICO EXPERTO'>TÉCNICO EXPERTO</legend>
                <input type='text'  value='<?= $convenio->getTecnicoExperto() ?>'  name='tecnicoExperto' id='tecnicoExperto' >
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='OBJETO'>OBJETO</legend>
                <textarea  value='<?= $convenio->getObjeto() ?>'  name='objeto' id='objeto' ></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ALCANCE'>ALCANCE DEL OBJETO</legend>
                <textarea  value='<?= $convenio->getAlcance() ?>'  name='alcance' id='alcance' ></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='JUSTIFICACION'>JUSTIFICACIÓN</legend>
                <textarea   value='<?= $convenio->getJustificacion() ?>'  name='justificacion' id='justificacion' ></textarea>
            </fieldset>
        </div>        
        <div>     
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "Convenios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div>
<?PHP 
}
?>
