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
$roles = ["CO", "AB", "AD"];

// Acceder a la vista
$post = Sesion\iniciar($roles);

// Traer objeto
$idSolicitud = $post['idSolicitud'] !== '' ? $post['idSolicitud'] : null;
$campoId = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenio = new Convenio($campoId, $idSolicitud);

$permisos = true;
if ($permisos)
{
?>

    <div class="carga_Documento">
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
                <textarea name='objeto' id='objeto' ><?= $convenio->getObjeto() ?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ALCANCE'>ALCANCE DEL OBJETO</legend>
                <textarea name='alcance' id='alcance' ><?= $convenio->getAlcance() ?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='JUSTIFICACION'>JUSTIFICACIÓN</legend>
                <textarea name='justificacion' id='justificacion' ><?= $convenio->getJustificacion() ?></textarea>
            </fieldset>
        </div>        
        <div>
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $post['accion'] ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $post['accion']?>' name='accionU' id='accionU' onclick='cargar( "aviso", "ConveniosSolicitud" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div>
<?PHP 
}
?>
