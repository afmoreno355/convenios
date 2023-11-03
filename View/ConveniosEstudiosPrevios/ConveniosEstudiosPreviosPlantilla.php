<?php
/**
 * @author Dibier
 */

// Verificar si se envió 'idSolicitud' a través de POST
$idSolicitud = $post['idSolicitud'] != null ? $post['idSolicitud'] : null;

// Definir el nombre del campo según si 'idSolicitud' está presente
$campoId = $idSolicitud !== null ? 'id_solicitud' : null;

// Crear instancias de las clases
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campoId, $idSolicitud);

// Obtener los campos de ConvenioEstudiosPrevios
$contenido = $convenioEstudiosPrevios->getCampos();
?>

<link rel="stylesheet" type="text/css" href="../../css/ConvenioEstudiosPrevios.css">
<page backtop="20mm" backbottom="20mm" backleft="25mm" backright="25mm">
    <page_header>
        <div style="text-align: center;">
            <img width="40" src="../../img/logo/sena.png" alt="Logo Sena">
        </div>
    </page_header>

    <page_footer>
        <div style="text-align: center;">DIRECCIÓN DE FORMACIÓN PROFESIONAL SENA</div>
    </page_footer>

    <h1>ESTUDIOS PREVIOS</h1>

    <?php foreach ($contenido as $campo => $parametro) : ?>
        <?php if (!in_array($campo, ['id'])) : ?>
            <h2><?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?></h2>
            <p><?= $parametro['valor'] ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
</page>






