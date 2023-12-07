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

// Traer objeto
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campoId = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campoId, $idSolicitud);
$contenido = $convenioEstudiosPrevios->getCampos();

?>
<!--Formulario Estudios Previos-->
<h2>ESTUDIOS PREVIOS</h2>

<div class="carga_Documento">
    <?php foreach ($contenido as $campo => $parametro) : ?>
        <?php if (in_array($campo, ["id", "idSolicitud", "fecha"]) == false) : ?>
            <div>
                <fieldset>
                    <legend title='<?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?>'><?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?></legend>
                    <textarea name='<?= $campo ?>' id='<?= $campo ?>'><?= $parametro['valor'] ?></textarea>
                </fieldset>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div>
        <?php $ACCION= $post['accion']; ?>
        <?php $I = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=GUARDAR"); ?>
        <?php $URL = "View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosCrud.php"; ?>
        <input type="hidden" value ="" name="I" id="I">  
        <input type="submit" value='<?= $ACCION ?>' name='accionU' id='accionU' onclick='enviarSolicitudConvenios("<?= $I ?>", <?= $URL ?>")'>
        <input type="reset" name="limpiarU"  value="LIMPIAR"/>
    </div>
</div>
