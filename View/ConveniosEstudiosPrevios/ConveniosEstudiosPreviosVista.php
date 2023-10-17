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
$idSolicitud = $convenio->getId();
$convenioEstudiosPrevios= new ConvenioEstudiosPrevios( ' id_solicitud ' , $llave_Primaria_Contructor);

if ($permisos)
{
?>
<!--Modal Información-->
<h2>ESTUDIOS PREVIOS</h2>

<div class="carga_Documento">
    <div class="nuevaseccion" >
        <fieldset>
            <section>
                <h6>IDENTIFICACIÓN DEPENDENCIA REQUIRENTE</h6>
                <p><?=$convenioEstudiosPrevios->getIdDependenciaRequierente()?></p>
            </section>    
            <section>
                <h6>DESCRIPCIÓN DE LA NECESIDAD</h6>
                <p><?=$convenioEstudiosPrevios->getDescripcionNecesidad()?></p>
            </section>
            <section>
                <h6>JUSTIFIACIÓN</h6>
                <p><?=$convenio->getJustificacion()?></p>
            </section>
            <section>
                <h6>ANÁLISIS DE CONVENIENCIA</h6>
                <p><?=$convenioEstudiosPrevios->getAnalisisCoveniencia()?></p>
            </section>
            <section>
                <h6>MADURACIÓN DEL PROYECTO</h6>
                <p><?=$convenioEstudiosPrevios->getMaduracionProyecto()?></p>
            </section>
            <section>
                <h6>OBJETO</h6>
                <p><?=$convenio->getObjeto()?></p>
            </section>
            <section>
                <h6>ALCANCE DEL OBJETO</h6>
                <p><?=$convenio->getAlcance()?></p>
            </section>
            <section>
                <h6>ESPECIFICACIONES TÉCNICAS DEL OBJETO</h6>
                <p><?=$convenioEstudiosPrevios->getEspecificacionesTecnicasObjeto()?></p>
            </section>
            <section>
                <h6>ANÁLISIS DEL SECTOR</h6>
                <p><?=$convenioEstudiosPrevios->getAnalisisSector()?></p>
            </section>
            <section>
                <h6>VALOR TOTAL DE APORTES</h6>
                <p><?=$convenioEstudiosPrevios->getValorTotalAportes()?></p>
            </section>
            <section>
                <h6>DESEMBOLSOS</h6>
                <p><?=$convenioEstudiosPrevios->getDesembolsos()?></p>
            </section>
            <section>
                <h6>DISPONIBILIDAD PRESUPUESTAL</h6>
                <p><?=$convenioEstudiosPrevios->getDisponibilidadPresupuestal()?></p>
            </section>
            <section>
                <h6>MODALIDAD DE SELECCIÓN</h6>
                <p><?=$convenioEstudiosPrevios->getModalidadSeleccion()?></p>
            </section>
            <section>
                <h6>CRITERIOS DE SELECCIÓN</h6>
                <p><?=$convenioEstudiosPrevios->getCriteriosSeleccion()?></p>
            </section>
            <section>
                <h6>ANÁLISIS DE RIESGO</h6>
                <p><?=$convenioEstudiosPrevios->getAnalisisRiesgo()?></p>
            </section>
            <section>
                <h6>GARANTÍAS</h6>
                <p><?=$convenioEstudiosPrevios->getGarantias()?></p>
            </section>
            <section>
                <h6>LIMITACIONES MYPIMES</h6>
                <p><?=$convenioEstudiosPrevios->getLimitacionMipymes()?></p>
            </section>
            <section>
                <h6>PLAZO DE EJECUCIÓN</h6>
                <p><?=$convenioEstudiosPrevios->getPlazoEjecucion()?></p>
            </section>
            <section>
                <h6>LUGAR DE EJECUCIÓN</h6>
                <p><?=$convenioEstudiosPrevios->getLugarEjecucion()?></p>
            </section>
            <section>
                <h6>OBLIGACIONES DE LAS PARTES</h6>
                <p><?=$convenioEstudiosPrevios->getObligacionesPartes()?></p>
            </section>
            <section>
                <h6>FORMA DE PAGO</h6>
                <p><?=$convenioEstudiosPrevios->getFormaPago()?></p>
            </section>
            <section>
                <h6>CONTROL Y VIGILANCIA DEL CONTRATO</h6>
                <p><?=$convenioEstudiosPrevios->getControlVigilanciaContrato()?></p>
            </section>
            <section>
                <h6>ACUERDOS COMERCIALES</h6>
                <p><?=$convenioEstudiosPrevios->getAcuerdosComerciales()?></p>
            </section>
            <section>
                <h6>OTROS ASPECTOS</h6>
                <p><?=$convenioEstudiosPrevios->getOtrosAspectos()?></p>
            </section>
            <section>
                <h6>CONCEPTOS TÉCNICOS</h6>
                <p><?=$convenioEstudiosPrevios->getConceptosTecnicos()?></p>
            </section>
            <div>
                <?php
                $URL = "View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosCrud.php" ;
                $http_des = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=DESCARGAR");
                $http_gen = Http::encryptIt("idSolicitud={$convenio->getId()}&user={$_SESSION["user"]}&accion=GENERAR");
                $http_vis = Http::encryptIt("idSolicitud={$convenio->getId()}&user={$_SESSION["user"]}&accion=VISUALIZAR");
                $estudiosPreviosRuta = "archivos/convenios/" . $convenio->getId() . "/ESTUDIOS_" . $convenio->getId() . ".pdf";
                ?>
                <input type="hidden" value="<?= $idSolicitud ?>" name="idSolicitud" id="idSolicitud">
                <input type="hidden" value="<?= "DESCARGAR" ?>" name="accion" id="accion">
                <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>

                <input type="button" value='<?= "DESCARGAR PDF" ?>' name='accionU' id='accionU' onclick='descargarConvenios(I=`<?= $http_des ?>`, `aviso`, `<?= $URL?>`, `<?= $estudiosPreviosRuta ?>`, `<?= basename($estudiosPreviosRuta) ?>`)'>

                <input type="button" value='<?= "GENERAR PDF" ?>' name='accionU' id='accionUGen' onclick='generarConvenios(I=`<?= $http_gen ?>`, `aviso`, `<?= $URL ?>`, `<?= $estudiosPreviosRuta ?>`, `<?= basename($estudiosPreviosRuta) ?>`)'>

                <input type="button" value='<?= "VISUALIZAR PDF" ?>' name='accionU' id='accionUVis' onclick='visualizarConvenios(I=`<?= $http_vis ?>`, `aviso`, `<?= $URL ?>`, `<?= $estudiosPreviosRuta ?>`, `<?= basename($estudiosPreviosRuta) ?>`)'>
            </div> 
        </fieldset>
    </div>
</div>
<?php
}
?>