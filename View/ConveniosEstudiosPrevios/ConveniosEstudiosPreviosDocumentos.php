<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// require auntomatico encuentra todas las clases/Model qeu se solicitan en el Controlador
require_once __DIR__ . "/../../autoload.php";

// Iniciamos sesion para tener las variables
session_start();

date_default_timezone_set("America/Bogota");
$fecha = date("Y-m-d");
$fecha_vigencia = date("Y");

// variable variable trae las variables que trae POST
foreach ($_POST as $key => $value)
    ${$key} = $value;

// desencripta las variables
$nuevo_POST = Http::decryptIt($I);
// evalua las nuevas variables que vienen ya desencriptadas
foreach ($nuevo_POST as $key => $value)
    ${$key} = $value;

// verificamos permisos
$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), 'eagle');

if ($ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "SA") {
    $permisos = false;
}


// llamamos la clase y verificamos si ya existe info de este dato que llega
$convenio = new Convenio( ' id_solicitud ' , $idSolicitud);
$convenioEstudiosPrevios= new ConvenioEstudiosPrevios( ' id_solicitud ' , $idSolicitud);


//provisional !!!!!
$documento = 'ESTUDIOS_PREVIOS';

if ($documento == 'ESTUDIOS_PREVIOS' and $permisos)
{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Documento de Ejemplo</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 36pt; /* Márgenes de una pulgada */
            line-height: 1.6; /* Espaciado entre líneas */
        }

        h1 {
            font-size: 18pt;
            text-align: center;
            margin-bottom: 12pt;
        }

        p {
            font-size: 12pt;
            text-align: justify;
        }

        ul {
            list-style-type: disc;
        }

        ol {
            list-style-type: decimal;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8pt;
        }
    </style>
</head>
<body>
    
    <h1>ESTUDIOS PREVIOS</h1>

             
                <h2>IDENTIFICACIÓN DEPENDENCIA REQUIRENTE</h2>
                <p><?php echo $convenioEstudiosPrevios->getIdDependenciaRequierente(); ?></p>
                 
             
                <h2>DESCRIPCIÓN DE LA NECESIDAD</h2>
                <p><?php echo $convenioEstudiosPrevios->getDescripcionNecesidad(); ?></p>
             
             
                <h2>JUSTIFIACIÓN</h2>
                <p><?php echo $convenio->getJustificacion(); ?></p>
             
             
                <h2>ANÁLISIS DE CONVENIENCIA</h2>
                <p><?php echo $convenioEstudiosPrevios->getAnalisisCoveniencia(); ?></p>
             
             
                <h2>MADURACIÓN DEL PROYECTO</h2>
                <p><?php echo $convenioEstudiosPrevios->getMaduracionProyecto(); ?></p>
             
             
                <h2>OBJETO</h2>
                <p><?php echo $convenio->getObjeto(); ?></p>
             
             
                <h2>ALCANCE DEL OBJETO</h2>
                <p><?php echo $convenio->getAlcance(); ?></p>
             
             
                <h2>ESPECIFICACIONES TÉCNICAS DEL OBJETO</h2>
                <p><?php echo $convenioEstudiosPrevios->getEspecificacionesTecnicasObjeto(); ?></p>
             
             
                <h2>ANÁLISIS DEL SECTOR</h2>
                <p><?php echo $convenioEstudiosPrevios->getAnalisisSector(); ?></p>
             
             
                <h2>VALOR TOTAL DE APORTES</h2>
                <p><?php echo $convenioEstudiosPrevios->getValorTotalAportes(); ?></p>
             
             
                <h2>DESEMBOLSOS</h2>
                <p><?php echo $convenioEstudiosPrevios->getDesembolsos(); ?></p>
             
             
                <h2>DISPONIBILIDAD PRESUPUESTAL</h2>
                <p><?php echo $convenioEstudiosPrevios->getDisponibilidadPresupuestal(); ?></p>
             
             
                <h2>MODALIDAD DE SELECCIÓN</h2>
                <p><?php echo $convenioEstudiosPrevios->getModalidadSeleccion(); ?></p>
             
             
                <h2>CRITERIOS DE SELECCIÓN</h2>
                <p><?php echo $convenioEstudiosPrevios->getCriteriosSeleccion(); ?></p>
             
             
                <h2>ANÁLISIS DE RIESGO</h2>
                <p><?php echo $convenioEstudiosPrevios->getAnalisisRiesgo(); ?></p>
             
             
                <h2>GARANTÍAS</h2>
                <p><?php echo $convenioEstudiosPrevios->getGarantias(); ?></p>
             
             
                <h2>LIMITACIONES MYPIMES</h2>
                <p><?php echo $convenioEstudiosPrevios->getLimitacionMipymes(); ?></p>
             
             
                <h2>PLAZO DE EJECUCIÓN</h2>
                <p><?php echo $convenioEstudiosPrevios->getPlazoEjecucion(); ?></p>
             
             
                <h2>LUGAR DE EJECUCIÓN</h2>
                <p><?php echo $convenioEstudiosPrevios->getLugarEjecucion(); ?></p>
             
             
                <h2>OBLIGACIONES DE LAS PARTES</h2>
                <p><?php echo $convenioEstudiosPrevios->getObligacionesPartes(); ?></p>
             
             
                <h2>FORMA DE PAGO</h2>
                <p><?php echo $convenioEstudiosPrevios->getFormaPago(); ?></p>
             
             
                <h2>CONTROL Y VIGILANCIA DEL CONTRATO</h2>
                <p><?php echo $convenioEstudiosPrevios->getControlVigilanciaContrato(); ?></p>
             
             
                <h2>ACUERDOS COMERCIALES</h2>
                <p><?php echo $convenioEstudiosPrevios->getAcuerdosComerciales(); ?></p>
             
             
                <h2>OTROS ASPECTOS</h2>
                <p><?php echo $convenioEstudiosPrevios->getOtrosAspectos(); ?></p>
             
             
                <h2>CONCEPTOS TÉCNICOS</h2>
                <p><?php echo $convenioEstudiosPrevios->getConceptosTecnicos(); ?></p>
             


</body>
</html>

<?php
}
?>


