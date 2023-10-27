<?php
/**
 * 
 * @author Dibier
 */


require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../utilities/InicioSesion.php';


use InicioSesion;

// Aceder al CRUD
$post = InicioSesion\iniciar();

// Permisos persona
$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), 'eagle_admin');

if ($ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "SA") {
    $permisos = false;
}

// Traer objeto estudios previos
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campo = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campo, $idSolicitud);
$convenio = new Convenio($campo , $idSolicitud);

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
                $NOMBRE = "ESTUDIOS_$idSolicitud.pdf";
                $RUTA = "archivos/convenios/$idSolicitud/$NOMBRE";
                $IDELEMENTO = "documentoDescargar";
                $POSTDES = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=DESCARGAR");
                $POSTGEN = Http::encryptIt("idSolicitud={$convenio->getId()}&user={$_SESSION["user"]}&accion=GENERAR");
                $POSTVIS = Http::encryptIt("idSolicitud={$convenio->getId()}&user={$_SESSION["user"]}&accion=VISUALIZAR");
                $URL = "View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosCrud.php";
                $URLEXP = "View/ConveniosEstudiosPrevios/GenerarPDF.php";
                ?>
                <input type="hidden" value="<?= $idSolicitud ?>" name="idSolicitud" id="idSolicitud">
                <input type="hidden" value="<?= "DESCARGAR" ?>" name="accion" id="accion">
                <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
                <div style="display: none;" id="documentoDescargar"></div>

                <input type="button" value='<?= "DESCARGAR PDF" ?>' name='accionU' id='accionUDes' onclick='descargarConvenios(`<?= $NOMBRE ?>`, `<?= $RUTA ?>`, `<?= $IDELEMENTO ?>`, `I=<?= $POSTDES ?>`, `<?= $URL ?>`)'>

                <input type="button" value='<?= "GENERAR PDF" ?>' name='accionU' id='accionUGen' onclick='generarConvenios(`<?= $RUTA ?>`, `<?= $IDELEMENTO ?>`, `I=<?= $POSTDES ?>`, `<?= $URL ?>`)'>

                <input type="button" value='<?= "VISUALIZAR PDF" ?>' name='accionU' id='accionUVis' onclick='visualizarConvenios(`I=<?= $POSTVIS ?>`, `<?= $URL ?>`)'>
            </div> 
        </fieldset>
    </div>
</div>
<?php
}