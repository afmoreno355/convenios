<?php
/**
 * 
 *
 * @author Dibier
 */


require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../../utilities/InicioSesion.php';

use InicioSesion;

// Aceder al CRUD
$post = InicioSesion\iniciar();

// Traer objeto estudios previos
$idSolicitud = $post['idSoliciud'] !== '' ? $post['idSolicitud'] : null;
$campo = $idSolicitud !== null ? ' id_solicitud ' : null;
$estudiosPrevios = new ConvenioEstudiosPrevios($campo, $idSolicitud);

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