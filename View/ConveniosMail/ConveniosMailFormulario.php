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

// Acceder a formulario
$post = Sesion\iniciar($roles);

?>
<!--Formulario Estudios Previos-->
<h2>ESTUDIOS PREVIOS</h2>

<div class="carga_Documento">

    <div>
        <fieldset>
            <legend title='<?= "NOMBRE DEL DESTINATARIO" ?>'><?= "NOMBRE DEL DESTINATARIO" ?></legend>
            <input type="text" id="destinatario" name="destinatario" />
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='<?= "CORREO ELECTRÓNICO" ?>'><?= "CORREO ELETRÓNICO" ?></legend>
            <input type="email" id="email" name="email" />
        </fieldset>
    </div>

    <div>
        <fieldset>
            <legend title='<?= "MENSAJE" ?>'><?= "MENSAJE" ?></legend>
            <textarea>Proyectar correo aquí.</textarea>
        </fieldset>
    </div>
    <div>
        <input type="submit" value='<?= $post['accion'] ?>' name='accionU' id='accionU' onclick='enviarEmailConvenios()' />
        <input type="reset" name="limpiarU"  value="LIMPIAR"/>
    </div>
</div>
