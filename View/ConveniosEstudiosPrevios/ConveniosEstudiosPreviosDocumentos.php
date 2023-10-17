<?php

print_r(":)");
?>


<!-- contenido_pdf.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Mi Documento PDF</title>
</head>
<body>
    <h1>Este es mi documento PDF para la Solicitud <?php echo $_POST['idSolicitud']; ?></h1>
    <p>Contenido de ejemplo para la Solicitud <?php echo $_POST['idSolicitud']; ?>.</p>
    <p>Este es el post: <?php echo $_POST['idSolicitud'];?></p>
</body>
</html>


