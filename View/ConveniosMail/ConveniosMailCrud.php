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
$roles = ["CO", "AD", "AB"];

// Aceder al CRUD
$post = Sesion\iniciar($roles);

// Traer objeto
$idSolicitud = $post['idSolicitud'] !== '' ? $post['idSolicitud'] : null;
$campoId = $idSolicitud !== null ? ' id_solicitud ' : null;
$mail = new ConvenioMail();

switch ($post['accion']) {

    case "ENVIAR":
        $mail->enviar();
        break;

    default:
        die("No se reconoce acción.");
}
