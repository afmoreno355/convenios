<h2>INFORMACION DE LA SOLICITUD</h2>

<div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Administrador DFP – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Convenios</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
            <label style="font-size: 1em; " id="aviso2" class="aviso" ><?= $convenio->getId() ?></label> 
        </div>
        <div>
            <fieldset>
                <legend title='NOMBRE'>NOMBRE CONVENIO</legend>
                <input type="text" value='<?= $convenio->getNombre() ?>' required name='nombre' id="nombre">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='AREA'>ÁREA</legend>
                <input type="number" value='<?= $convenio->getCodigoArea() ?>' required name='area' id="area">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='MES'>MES DE PUBLICACIÓN</legend>
                <input type="text" value='<?= $convenio->getMes() ?>' required name='mes' id="mes">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ABOGADO'>ABOGADO</legend>
                <input type='text'  value='<?= $convenio->getAbogado() ?>'  name='abogado' id='abogado' >
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='TECNICO EXPERTO'>TÉCNICO EXPERTO</legend>
                <input type='text'  value='<?= $convenio->getTecnicoExperto() ?>'  name='tecnicoExperto' id='tecnicoExperto' >
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='OBJETO'>OBJETO</legend>
                <textarea name='objeto' id='objeto' ><?= $convenio->getObjeto() ?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ALCANCE'>ALCANCE DEL OBJETO</legend>
                <textarea name='alcance' id='alcance' ><?= $convenio->getAlcance() ?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='JUSTIFICACION'>JUSTIFICACIÓN</legend>
                <textarea name='justificacion' id='justificacion' ><?= $convenio->getJustificacion() ?></textarea>
            </fieldset>
        </div>
        

        <div>
            <fieldset>
                <legend title='MEMORANDO'>MEMORANDO</legend>
                <input type='file' name='memorando' id='memorando' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ESTUDIOS PREVIOS'>ESTUDIOS PREVIOS</legend>
                <input type='file'  name='estudiosPrevios' id='estudiosPrevios' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANEXO TÉCNICO'>ANEXO TÉCNICO</legend>
                <input type='file' name='anexoTecnico' id='anexoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='ANÁLISIS DEL SECTOR'>ANÁLISIS DEL SECTOR</legend>
                <input type='file' name='analisisSector' id='analisisSector' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CONCEPTO TÉCNICO'>CONCEPTO TÉCNICO</legend>
                <input type='file' name='solicitudConceptoTecnico' id='solicitudConceptoTecnico' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROPUESTA TÉCNICA ECONÓMICA'>PROPUESTA TÉCNICA ECONÓMICA</legend>
                <input type='file'  name='propuestaTecnicaEconomica' id='propuestaTecnicaEconomica' >
            </fieldset>
        </div>

        
        <div>
            <fieldset>
                <legend title='MATRIZ DE RIESGOS'>MATRIZ DE RIESGOS</legend>
                <input type='file'  name='matrizRiesgos' id='matrizRiesgos' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='DISPONIBILIDAD PRESUPUESTAL'>DISPONIBILIAD PRESUPUESTAL</legend>
                <input type='file' name='disponibilidadPresupuestal' id='disponibilidadPresupuestal' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='CERTIFICACIÓN PAA'>CERTIFICACIÓN PAA</legend>
                <input type='file' name='paa' id='paa' >
            </fieldset>
        </div>

        <div>
            <fieldset>
                <legend title='PROYECTO DE AUTORIZACIÓN'>PROYECTO DE AUTORIZACIÓN</legend>
                <input type='file' name='proyectoAutorizacion' id='proyectoAutorizacion' >
            </fieldset>
        </div>
        








        <div>     
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='conveniosCargar( "aviso", "Convenios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div>