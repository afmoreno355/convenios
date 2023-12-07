<?php
/**
 * 
 * @author Dibier
 */

require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../utilities/Sesion.php';

use Sesion;

// Definir roles
// CO: Coordinador
// AB: Abogado Responsable
// AD: Auxiliar Administrativo
// EC: Técnico Económico
// EX: Técnico Experto
// *: Todos
$roles = ["*"];

// Acceder a la vista
$post = Sesion\iniciar($roles);

// Traer objeto estudios previos
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campoId = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campoId, $idSolicitud);
$contenido = $convenioEstudiosPrevios->getCampos();

?>
<!--Modal Información-->
<h2>ESTUDIOS PREVIOS</h2>
<div class="carga_Documento">
    <div class="nuevaseccion">  
        <fieldset>
            <?php foreach ($contenido as $campo => $parametro) : ?>
                <?php if (!in_array($campo, ['id'])) : ?>
                    <section>
                        <h6><?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?></h6>
                         <p><?= $parametro['valor'] ?></p>
                    </section>
                <?php endif; ?>
            <?php endforeach; ?>
            <br />
            <div>
                <?php $POSTDES = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=DESCARGAR"); ?>
                <?php $POSTGEN = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=GENERAR"); ?>
                <?php $POSTVIS = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=VISUALIZAR"); ?>
                <?php $URL = "View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosCrud.php"; ?>
                <input type="hidden" value="" name="I" id="I">
                <input type="button" value='<?= "DESCARGAR PDF" ?>' name='accionU' id='accionU' onclick='descargarConvenios(`<?= $POSTDES ?>`, `<?= $URL ?>`)'>
                <input type="button" value='<?= "GENERAR PDF" ?>' name='accionU' id='accionU' onclick='generarConvenios(`<?= $POSTGEN ?>`, `<?= $URL ?>`)'>
                <input type="button" value='<?= "VISUALIZAR PDF" ?>' name='accionU' id='accionU' onclick='visualizarConvenios(`<?= $POSTVIS ?>`, `<?= $URL ?>`)'>
            </div> 
        </fieldset>
    </div>
</div>