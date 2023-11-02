<?php
/**
 * @author Dibier
 */

$idSolicitud = $post['idSolicitud'];

$convenio = new Convenio(' id_solicitud ', $idSolicitud);
$convenioEstudiosPrevios = new ConvenioEstudiosPrevios(' id_solicitud ', $idSolicitud);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Documento de Ejemplo</title>
    <style>
        /* Estilos globales para todo el documento */
        body {
            font-family: "Times New Roman", serif;
            margin: 72pt; /* Márgenes de una pulgada en todas las direcciones */
            line-height: 1.5; /* Espaciado entre líneas */
        }

        h1 {
            font-size: 24pt;
            text-align: center;
            margin-bottom: 18pt;
        }

        h2 {
            font-size: 18pt;
            background-color: yellow;
        }

        p {
            font-size: 12pt;
            text-align: justify;
            margin-bottom: 12pt;
        }

        ul, ol {
            margin-left: 36pt; /* Sangría para las listas */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 12pt;
        }

        th, td {
            border: 1px solid black;
            padding: 8pt;
        }

        /* Estilos específicos para una clase o elemento */
        .destacado {
            background-color: yellow;
        }

        /* Estilos específicos para un ID o elemento */
        #encabezado {
            font-weight: bold;
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


