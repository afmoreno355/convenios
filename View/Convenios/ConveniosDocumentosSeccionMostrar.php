
<?php

$rutas = ConvenioDocumentos::rutasDocumentos($convenio->getId());
print_r($direcciones);

?>

<h2>DOCUMENTOS SOLICITUD</h2>
<div class="carga_Documento">
    <div class="nuevaseccion" ><fieldset>  
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
            <a href="<?= $rutas['estudios_previos'] ?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>ANEXO TÉCNICO</p>
            <a href="<?= $rutas['anexo_tecnico'] ?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>ANÁLISIS DEL SECTOR</p>
            <a href="<?= $rutas['analisis_sector']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>SOLICITUD DE CONCEPTO TÉCNICO</p>
            <a href="<?= $rutas['concepto_tecnico']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>PROPUESTA TÉCNICA ECONÓMICA</p>
            <a href="<?= $rutas['propuesta_tecnica_economica']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>MATRIZ DE RIESGOS</p>
            <a href="<?= $rutas['matriz_riesgos']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>CERTIFICADO DISPONIBILIDAD PRESUPUESTAL</p>
            <a href="<?= $rutas['certificado_disponibilidad_presupuestal']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>CERTIFICADO PAA</p>
            <a href="<?= $rutas['certificado_paa']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
        <section>
            <p>PROYECTO DE AUTORIZACIÓN</p>
            <a href="<?= $rutas['proyecto_autorizacion']?>" target="_blank">
                <img src="img/icon/pdf.png" class="zoom" width=70" height=70"/>
            </a>
        </section>
    </fieldset></div>
</div>