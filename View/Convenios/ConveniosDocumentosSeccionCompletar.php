<h2>DOCUMENTOS SOLICITUD</h2>
<div class="carga_Documento">
<div class="nuevaseccion" >
    <fieldset>
        
        <div>
            <fieldset>
                <legend title='MEMORANDO'>MEMORANDO</legend>
                <input type='file'  value=''  name='memorando' id='memorando' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ESTUDIOS PREVIOS'>ESTUDIOS PREVIOS</legend>
                <input type='file'  value=''  name='estudiosPrevios' id='estudiosPrevios' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANEXO TÉCNICO'>ANEXO TÉCNICO</legend>
                <input type='file'  value=''  name='anexoTecnico' id='anexoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANÁLISIS DEL SECTOR'>ANÁLISIS DEL SECTOR</legend>
                <input type='file'  value=''  name='analisisSector' id='analisisSector' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CONCEPTO TÉCNICO'>CONCEPTO TÉCNICO</legend>
                <input type='file'  value=''  name='solicitudConceptoTecnico' id='solicitudConceptoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROPUESTA TÉCNICA ECONÓMICA'>PROPUESTA TÉCNICA ECONÓMICA</legend>
                <input type='file'  value=''  name='propuestaTecnicaEconomica' id='propuestaTecnicaEconomica' >
            </fieldset>
        </div>

        
        <div>
            <fieldset>
                <legend title='MATRIZ DE RIESGOS'>MATRIZ DE RIESGOS</legend>
                <input type='file'  value=''  name='matrizRiesgos' id='matrizRiesgos' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='DISPONIBILIDAD PRESUPUESTAL'>DISPONIBILIAD PRESUPUESTAL</legend>
                <input type='file'  value=''  name='disponibilidadPresupuestal' id='disponibilidadPresupuestal' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CERTIFICACIÓN PAA'>CERTIFICACIÓN PAA</legend>
                <input type='file'  value=''  name='paa' id='paa' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROYECTO DE AUTORIZACIÓN'>PROYECTO DE AUTORIZACIÓN</legend>
                <input type='file'  value=''  name='proyectoAutorizacion' id='proyectoAutorizacion' >
            </fieldset>
        </div>
        <div>     
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='conveniosCargar( "aviso", "ConveniosDocumentos", "Convenios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </fieldset>
</div>
</div>
