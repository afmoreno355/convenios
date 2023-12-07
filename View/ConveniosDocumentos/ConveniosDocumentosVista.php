
<?php
/**
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

// Aceder a la vista
$post = Sesion\iniciar($roles);

// Crear objeto
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campoId = $idSolicitud !== null ? 'id_solicitud' : null;
$convenioDocumentos = new ConvenioDocumentos($campoId, $idSolicitud);
$rutas = $convenioDocumentos->getDirecciones();
$permisos = true;
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
        <section style="display: none;">
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
            
            <?php $POST = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=DESCARGAR"); ?>
            <?php $URL = "View/ConveniosDocumentos/ConveniosDocumentosCrud.php"; ?>   
            <input type="hidden" value="" name="I" id="I">
            <input type="button" value='<?= "DESCARGAR ZIP" ?>' name='accionU' id='accionU' onclick='descargarConvenios(`<?= $POST ?>`, `<?= $URL ?>`)'>
        </div>        
    </fieldset>
</div>
<?php
}
?>