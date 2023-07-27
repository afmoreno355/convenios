
<?php

$rutas = ConvenioDocumentos::rutasDocumentos($convenio->getId());
?>

<h2>DOCUMENTOS SOLICITUD</h2>
<div class="carga_Documento">
    <div class="nuevaseccion" >
    <fieldset>  
        <section>
            <p>MEMORANDO</p>
            <?php if ($rutas['memorando'] != '') { ?> 
                <a href="<?= $rutas['memorando']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>            
        </section>
        <section>
            <p>ESTUDIOS PREVIOS</p>
            <?php if ($rutas['estudios_previos'] != '') { ?> 
                <a href="<?= $rutas['estudios_previos']?>" target="_blank">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
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

        <section>
            <p>Descargar</p>
            <?php if (true) {?> 
                <a href="View/ConveniosDocumentos/ConveniosDocumentosDescargar.php?idConvenio=<?= $convenio->getId()?>">
                    <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
                </a>
            <?php } else { ?>
                <img src="img/icon/pdfg.png" class="zoom" width=70" height=70" />
            <?php } ?>

        <div>     
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= "DESCARGAR" ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= "DESCARGAR" ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "ConveniosDocumentos")'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
        </section>

        <?php
    $URL = "View/ConveniosDocumentos/ConveniosDocumentosCrud.php" ;
    $http_desc = Http::encryptIt("idConvenio = {$convenio->getId()}&user={$_SESSION["user"]}&accion=DESCARGAR");
    $urlZip = "archivos/convenios/" . $convenio->getId() . "/CONVENIO_" . $convenio-getId() . ".zip";
    ?>
    <section>
    <input type="button" id="button"  onclick="validarDatos(``, `I=<?= $http_desc ?>`, `modalVentana`, `<?= $URL ?>`)" title="Información Elemento" value="DESCARGAR">
    <!-- Poner un tipo hipervínculo en vez de un botón <a></a>-->
    <a href="<?= $urlZip ?>" >Descargar documentos</a>
    Será que si está poniendo algo?
            </section>
    </fieldset>


</div>