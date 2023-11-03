<?php
/**
 * 
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

// Aceder al CRUD
$post = Sesion\iniciar($roles);

// Traer objeto estudios previos
$idSolicitud = $post['idSolicitud'] !== '' ? $post['idSolicitud'] : null;
$campoId = $idSolicitud !== null ? ' id_solicitud ' : null;
$estudiosPrevios = new ConvenioEstudiosPrevios($campoId, $idSolicitud);

switch ($post['accion']) {

    case "GUARDAR":
        $estudiosPrevios->guardar();
        break;

    case "VISUALIZAR":
        $estudiosPrevios->visualizar();
        break;

    case "GENERAR":
        $estudiosPrevios->generar();
        break;

    case "DESCARGAR":
        $estudiosPrevios->descargar();
        break;

    default:
        die("No se reconoce acción.");
}