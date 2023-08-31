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
$convenio = new Convenio(' id_solicitud ', $llave_Primaria_Contructor);
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios( ' id_solicitud ' , $llave_Primaria_Contructor);
if ($permisos)
{
?>
<!--Formulario Estudios Previos-->
<h2>ESTUDIOS PREVIOS</h2>

<div class="carga_Documento">
    <div>
        <fieldset>
            <legend title='DESCRIPCIÓN DE LA NECESIDAD'>DESCRIPCIÓN DE LA NECESIDAD</legend>
            <textarea name='descripcionNecesidad' id='descripcionNecesidad'><?= $convenioEstudiosPrevios->getDescripcionNecesidad() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='JUSTIFIACIÓN'>JUSTIFICACIÓN</legend>
            <textarea name='justificacion' id='justificacion'><?= $convenio->getJustificacion() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DE CONVENIENCIA'>ANÁLISIS DE CONVENIENCIA</legend>
            <textarea name='analisisConveniencia' id='analisisConveniencia'><?= $convenioEstudiosPrevios->getAnalisisCoveniencia() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='MADURACIÓN DEL PROYECTO'>MADURACIÓN DEL PROYECTO</legend>
            <textarea name='maduracionProyecto' id='maduracionProyecto'><?= $convenioEstudiosPrevios->getMaduracionProyecto() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OBJETO'>OBJETO</legend>
            <textarea name='objeto' id='objeto' ><?= $convenio->getObjeto() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ALCANCE DEL OBJETO'>ALCANCE DEL OBJETO</legend>
            <textarea name='alcanceObjeto' id='alcanceObjeto'><?= $convenio->getAlcance() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ESPECIFICACIONES TÉCNICAS'>ESPECIFICACIONES TÉCNICAS</legend>
            <textarea name='especificacionesTecnicas' id='especificacionesTecnicas'><?= $convenioEstudiosPrevios->getEspecificacionesTecnicasObjeto() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DEL SECTOR'>ANÁLISIS DEL SECTOR</legend>
            <textarea name='analisisSector' id='analisisSector'><?= $convenioEstudiosPrevios->getAnalisisSector() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='VALOR TOTAL APORTES'>VALOR TOTAL APORTES</legend>
            <textarea name='valorTotalAportes' id='valorTotalAportes'><?= $convenioEstudiosPrevios->getValorTotalAportes() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='DISPONIBILIDAD PRESUPUESTAL'>DISPONIBILIDAD PRESUPUESTAL</legend>
            <textarea name='disponibilidadPresupuestal' id='disponibilidadPresupuestal'><?= $convenioEstudiosPrevios->getDisponibilidadPresupuestal() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='MODALIDAD DE SELECCIÓN'>MODALIDAD DE SELECCIÓN</legend>
            <textarea name='modalidadSeleccion' id='modalidadSeleccion'><?= $convenioEstudiosPrevios->getModalidadSeleccion() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CRITERIOS DE SELECCIÓN'>CRITERIOS DE SELECCIÓN</legend>
            <textarea name='criteriosSeleccion' id='criteriosSeleccion'><?= $convenioEstudiosPrevios->getCriteriosSeleccion() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DE RIESGO'>ANÁLISIS DE RIESGO</legend>
            <textarea name='analisisRiesgo' id='analisisRiesgo'><?= $convenioEstudiosPrevios->getAnalisisRiesgo() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='GARANTÍAS'>GARANTÍAS</legend>
            <textarea name='garantias' id='garantias'><?= $convenioEstudiosPrevios->getGarantias() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='LIMITACIONES MYPIMES'>LIMITACIONES MYPIMES</legend>
            <textarea name='limitacionesMypimes' id='limitacionesMypimes'><?= $convenioEstudiosPrevios->getLimitacionMipymes() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='PLAZO DE EJECUCIÓN'>PLAZO DE EJECUCIÓN</legend>
            <textarea name='plazoEjecucion' id='plazoEjecucion'><?= $convenioEstudiosPrevios->getPlazoEjecucion() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='LUGAR DE EJECUCIÓN'>LUGAR DE EJECUCIÓN</legend>
            <textarea name='lugarEjecucion' id='lugarEjecucion'><?= $convenioEstudiosPrevios->getLugarEjecucion() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OBLIGACIONES DE LAS PARTES'>OBLIGACIONES DE LAS PARTES</legend>
            <textarea name='obligacionesPartes' id='obligacionesPartes'><?= $convenioEstudiosPrevios->getObligacionesPartes() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='FORMA DE PAGO'>FORMA DE PAGO</legend>
            <textarea name='formaPago' id='formaPago'><?= $convenioEstudiosPrevios->getFormaPago() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CONTROL Y VIGILANCIA DEL CONTRATO'>CONTROL Y VIGILANCIA DEL CONTRATO</legend>
            <textarea name='controlVigilanciaContrato' id='controlVigilanciaContrato'><?= $convenioEstudiosPrevios->getControlVigilanciaContrato() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ACUERDOS COMERCIALES'>ACUERDOS COMERCIALES</legend>
            <textarea name='acuerdosComerciales' id='acuerdosComerciales'><?= $convenioEstudiosPrevios->getAcuerdosComerciales() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OTROS ASPECTOS'>OTROS ASPECTOS</legend>
            <textarea name='otrosAspectos' id='otrosAspectos'><?= $convenioEstudiosPrevios->getOtrosAspectos() ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CONCEPTOS TÉCNICOS'>CONCEPTOS TÉCNICOS</legend>
            <textarea name='conceptosTecnicos' id='conceptosTecnicos'><?= $convenioEstudiosPrevios->getConceptosTecnicos() ?></textarea>
        </fieldset>
    </div>
    <div>     
        <input type="hidden" value="<?= $convenio->getId()?>" name="idSolicitud" id="idSolicitud">
        <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
        <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
        <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "ConveniosEstudiosPrevios")'>
        <input type="reset" name="limpiarU"  value="LIMPIAR"/>
    </div>
</div>
    
<?PHP 
}
?>