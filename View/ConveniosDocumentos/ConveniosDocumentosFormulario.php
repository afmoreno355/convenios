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
<h2>DOCUMENTOS SOLICITUD</h2>
    <div class="carga_Documento">
        <div>
            <fieldset>
                <legend title='MEMORANDO'>MEMORANDO</legend>
                <input type='file' name='memorando' id='memorando' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ESTUDIOS PREVIOS'>ESTUDIOS PREVIOS</legend>
                <input type='file'  name='estudiosPrevios' id='estudiosPrevios' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANEXO TÉCNICO'>ANEXO TÉCNICO</legend>
                <input type='file' name='anexoTecnico' id='anexoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANÁLISIS DEL SECTOR'>ANÁLISIS DEL SECTOR</legend>
                <input type='file' name='analisisSector' id='analisisSector' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CONCEPTO TÉCNICO'>CONCEPTO TÉCNICO</legend>
                <input type='file' name='solicitudConceptoTecnico' id='solicitudConceptoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROPUESTA TÉCNICA ECONÓMICA'>PROPUESTA TÉCNICA ECONÓMICA</legend>
                <input type='file'  name='propuestaTecnicaEconomica' id='propuestaTecnicaEconomica' >
            </fieldset>
        </div>

        
        <div>
            <fieldset>
                <legend title='MATRIZ DE RIESGOS'>MATRIZ DE RIESGOS</legend>
                <input type='file'  name='matrizRiesgos' id='matrizRiesgos' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='DISPONIBILIDAD PRESUPUESTAL'>DISPONIBILIAD PRESUPUESTAL</legend>
                <input type='file' name='disponibilidadPresupuestal' id='disponibilidadPresupuestal' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CERTIFICACIÓN PAA'>CERTIFICACIÓN PAA</legend>
                <input type='file' name='paa' id='paa' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROYECTO DE AUTORIZACIÓN'>PROYECTO DE AUTORIZACIÓN</legend>
                <input type='file' name='proyectoAutorizacion' id='proyectoAutorizacion' >
            </fieldset>
        </div>
        
        <div>
            <?php
            $I = Http::encryptIt("idSolicitud={$convenio->getId()}&user={$_SESSION["user"]}&accion=GUARDAR");
            ?>
            <input type="hidden" value="<?= $I ?>" name="I" id="I">    
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( `aviso`, `ConveniosDocumentos`)'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
        
    </div>
<?PHP 
}
?>
