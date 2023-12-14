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

// Seleccionar Modal
switch ($post['accion']) {
    case "ADICIONAR":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesAdicionar.php';
        break;
    case "AYUDA":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesAyuda.php';
        break;
    case "MODIFICAR":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesModificar.php';
        break;
    case "ENVIAR":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesEnviar.php';
        break;
    case "INFORMACION":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesInformacion.php';
        break;
    case "DESCARGAR":
        require_once __DIR__ . '/../../View/Convenios/ConveniosModalesDescargar.php';
        break;
    default:
        die("No se reconoce modal $accion.");
}
?>

<!-- Información encriptada -->
<input type="hidden" name="I" id="I" value="">