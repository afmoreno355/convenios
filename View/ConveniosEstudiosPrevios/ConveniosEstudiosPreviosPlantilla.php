<?php
/**
 * @author Dibier
 */

$idSolicitud = $post['idSolicitud'] != null ? $post['idSolicitud'] : null;
$campoId = $idSolicitud != null  ? 'id_solicitud' : null;

$convenio = new Convenio(' id_solicitud ', $idSolicitud);
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios($campoId, $idSolicitud);

$contenido = $convenioEstudiosPrevios->getCampos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documento de Ejemplo</title>
    <link rel="stylesheet" type="text/css" href="../../css/ConvenioEstudiosPrevios.css">
</head>
<body>

<page backtop="20mm" backbottom="20mm" backleft="25mm" backright="25mm"> 
    <page_header>
        <div style="text-align: center;">
            <img width="40" src="../../img/logo/sena.png" alt="Logo Sena">   
        </div>
    </page_header>

    <page_footer>
    <div style="text-align: center;">DIRECCIÓN DE FORMACIÓN PROFESIONA SENA</div>
    </page_footer>
    
        <h1>ESTUDIOS PREVIOS</h1>
<?php
foreach ($contenido as $campo => $parametro) {
    if (in_array($campo, ['id']) === false) {
?>
        <h2><?= mb_strtoupper($parametro['nombre'], 'UTF-8') ?></h2>
        <p><?=  $parametro['valor'] ?></p>
<?php
    }
}
?>
</page>
</body>
</html>




