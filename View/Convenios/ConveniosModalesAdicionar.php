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
$roles = ["CO", "AD", "AB"];

// Acceder a la vista
$post = Sesion\iniciar($roles);

?>

<div class="carga_Documento">
    <div class="contenido">  
        <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
            <img src="img/icon/gestionar.png"/><label class="where">Adicionar Convenios – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../View/ConveniosSolicitud/ConveniosSolicitudFormulario.php'; ?>

