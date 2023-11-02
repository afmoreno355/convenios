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
// *: todos
$roles = ["*"];

// Acceder a la vista
$post = Sesion\iniciar($roles);

// Traer objeto estudios previos
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campo = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campo, $idSolicitud);
$contenido = $convenioEstudiosPrevios->getCampos();

?>
<!--Modal Información-->
<h2>ESTUDIOS PREVIOS</h2>
<div class="carga_Documento">
<div class="nuevaseccion">  
<fieldset>
<?php
foreach ($contenido as $campo => $parametro) {
    if (in_array($campo, ['id']) === false) {
?>
    <section>
        <h6><?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?></h6>
        <p><?=  $parametro['valor'] ?></p>
    </section>
<?php
    }
}
?>
    <br />
    <div>
<?php
$NOMBRE = "ESTUDIOS_$idSolicitud.pdf";
$RUTA = "archivos/convenios/$idSolicitud/$NOMBRE";
$POSTDES = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=DESCARGAR");
$POSTGEN = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=GENERAR");
$POSTVIS = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=VISUALIZAR");
$URL = "View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosCrud.php";
$URLEXP = "View/ConveniosEstudiosPrevios/GenerarPDF.php";
?>
        <div style="display: none;" id="documentoDescargar"></div>
        <input type="button" value='<?= "DESCARGAR PDF" ?>' name='accionU' id='accionU' onclick='descargarConvenios(`<?= $NOMBRE ?>`, `<?= $RUTA ?>`, `<?= $IDELEMENTO ?>`, `I=<?= $POSTDES ?>`, `<?= $URL ?>`)'>
        <input type="button" value='<?= "GENERAR PDF" ?>' name='accionU' id='accionU' onclick='generarConvenios(`<?= $RUTA ?>`, `<?= $IDELEMENTO ?>`, `I=<?= $POSTDES ?>`, `<?= $URL ?>`)'>
        <input type="button" value='<?= "VISUALIZAR PDF" ?>' name='accionU' id='accionU' onclick='visualizarConvenios(`I=<?= $POSTVIS ?>`, `<?= $URL ?>`)'>
    </div> 
</fieldset>
</div>
</div>