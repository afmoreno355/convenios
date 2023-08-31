
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

$llave_Primaria_Contructor = ( $llave_Primaria == "" ) ? "null" : "'$llave_Primaria'";

// llamamos la clase y verificamos si ya existe info de este dato que llega
$convenioDocumentos = new ConvenioDocumentos( ' id_solicitud ' , $llave_Primaria_Contructor);
$rutas = $convenioDocumentos->getRutasDocumentos();
if ($permisos)
{
?>
<!--Modal Información-->
<h2>DOCUMENTOS SOLICITUD</h2>
<div class="carga_Documento">
    <div class="nuevaseccion" >
    <fieldset>  
        <section>
            <p>MEMORANDO</p>
            <?php if ($rutas['memorando'] != '') { ?> 
                <a href="<?= $rutas['memorando']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70 height=70/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70 height=70 />
            <?php } ?>            
        </section>
        <section>
            <p>ESTUDIOS PREVIOS</p>
            <?php if ($rutas['estudios_previos'] != '') { ?> 
                <a href="<?= $rutas['estudios_previos']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70 height=70/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>ANEXO TÉCNICO</p>
            <?php if ($rutas['anexo_tecnico'] != '') { ?> 
                <a href="<?= $rutas['anexo_tecnico']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>ANÁLISIS DEL SECTOR</p>
            <?php if ($rutas['analisis_sector'] != '') { ?> 
                <a href="<?= $rutas['analisis_sector']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>SOLICITUD DE CONCEPTO TÉCNICO</p>
            <?php if ($rutas['concepto_tecnico'] != '') { ?> 
                <a href="<?= $rutas['concepto_tecnico']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>PROPUESTA TÉCNICA ECONÓMICA</p>
            <?php if ($rutas['propuesta_tecnica_economica'] != '') { ?> 
                <a href="<?= $rutas['propuesta_tecnica_economica']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>MATRIZ DE RIESGOS</p>
            <?php if ($rutas['matriz_riesgos'] != '') { ?> 
                <a href="<?= $rutas['matriz_riesgos']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>CERTIFICADO DISPONIBILIDAD PRESUPUESTAL</p>
            <?php if ($rutas['certificado_disponibilidad_presupuestal'] != '') { ?> 
                <a href="<?= $rutas['certificado_disponibilidad_presupuestal']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>CERTIFICADO PAA</p>
            <?php if ($rutas['certificado_paa'] != '') { ?> 
                <a href="<?= $rutas['certificado_paa']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>
        <section>
            <p>PROYECTO DE AUTORIZACIÓN</p>
            <?php if ($rutas['proyecto_autorizacion'] != '') { ?> 
                <a href="<?= $rutas['proyecto_autorizacion']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>
        </section>

    
        <div>
            <?php
            $URL = "View/ConveniosDocumentos/ConveniosDocumentosCrud.php" ;
            $http_des = Http::encryptIt("idSolicitud={$convenioDocumentos->getIdSolicitud()}&user={$_SESSION["user"]}&accion=DESCARGAR");
            $zipRuta =  "archivos/convenios/" . $convenioDocumentos->getIdSolicitud() . "/CONVENIO_" . $convenioDocumentos->getIdSolicitud() . ".zip";
            ?>   
            <input type="hidden" value="<?= $convenioDocumentos->getIdSolicitud() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= "DESCARGAR" ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="button" value='<?= "DESCARGAR ZIP" ?>' name='accionU' id='accionU' onclick='descargarConvenio(I=`<?= $http_des ?>`, `formDetalle`, `<?= $URL ?>`, `<?= $zipRuta ?>`, `<?= basename($zipRuta) ?>`)'>
        </div>        
    </fieldset>
</div>
<?php
}
?>