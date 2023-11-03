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
        <?php $accion = $post['accion']; ?>
        <?php $I = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=GUARDAR"); ?>
        <input type="hidden" value ="<?= $I ?>" name="I" id="I">  
        <input type="hidden" value="<?= $idSolicitud?>" name="idSolicitud" id="idSolicitud">
        <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
        <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
        <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "ConveniosEstudiosPrevios")'>
        <input type="reset" name="limpiarU"  value="LIMPIAR"/>
    </div>
</div>
