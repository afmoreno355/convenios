<h2>ESTUDIOS PREVIOS</h2>

<div class="carga_Documento">
    <div>
        <fieldset>
            <legend title='DESCRIPCIÓN DE LA NECESIDAD'>DESCRIPCIÓN DE LA NECESIDAD</legend>
            <textarea name='descripcionNecesidad' id='descripcionNecesidad'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='JUSTIFIACIÓN'>JUSTIFICACIÓN</legend>
            <textarea name='justificacion' id='justificacion'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DE CONVENIENCIA'>ANÁLISIS DE CONVENIENCIA</legend>
            <textarea name='analisisConveniencia' id='analisisConveniencia'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='MADURACIÓN DEL PROYECTO'>MADURACIÓN DEL PROYECTO</legend>
            <textarea name='maduracionProyecto' id='maduracionProyecto'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OBJETO'>OBJETO</legend>
            <textarea name='objeto' id='objeto' ><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ALCANCE DEL OBJETO'>ALCANCE DEL OBJETO</legend>
            <textarea name='alcanceObjeto' id='alcanceObjeto'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ESPECIFICACIONES TÉCNICAS'>ESPECIFICACIONES TÉCNICAS</legend>
            <textarea name='especificacionesTecnicas' id='especificacionesTecnicas'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DEL SECTOR'>ANÁLISIS DEL SECTOR</legend>
            <textarea name='analisisSector' id='analisisSector'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='VALOR TOTAL APORTES'>VALOR TOTAL APORTES</legend>
            <textarea name='valorTotalAportes' id='valorTotalAportes'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='DISPONIBILIDAD PRESUPUESTAL'>DISPONIBILIDAD PRESUPUESTAL</legend>
            <textarea name='disponibilidadPresupuestal' id='disponibilidadPresupuestal'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='MODALIDAD DE SELECCIÓN'>MODALIDAD DE SELECCIÓN</legend>
            <textarea name='modalidadSeleccion' id='modalidadSeleccion'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CRITERIOS DE SELECCIÓN'>CRITERIOS DE SELECCIÓN</legend>
            <textarea name='criteriosSeleccion' id='criteriosSeleccion'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ANÁLISIS DE RIESGO'>ANÁLISIS DE RIESGO</legend>
            <textarea name='analisisRiesgo' id='analisisRiesgo'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='GARANTÍAS'>GARANTÍAS</legend>
            <textarea name='garantias' id='garantias'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='LIMITACIONES MYPIMES'>LIMITACIONES MYPIMES</legend>
            <textarea name='limitacionesMypimes' id='limitacionesMypimes'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='PLAZO DE EJECUCIÓN'>PLAZO DE EJECUCIÓN</legend>
            <textarea name='plazoEjecucion' id='plazoEjecucion'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='LUGAR DE EJECUCIÓN'>LUGAR DE EJECUCIÓN</legend>
            <textarea name='lugarEjecucion' id='lugarEjecucion'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OBLIGACIONES DE LAS PARTES'>OBLIGACIONES DE LAS PARTES</legend>
            <textarea name='obligacionesPartes' id='obligacionesPartes'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='FORMA DE PAGO'>FORMA DE PAGO</legend>
            <textarea name='formaPago' id='formaPago'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CONTROL Y VIGILANCIA DEL CONTRATO'>CONTROL Y VIGILANCIA DEL CONTRATO</legend>
            <textarea name='controlVigilanciaContrato' id='controlVigilanciaContrato'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='ACUERDOS COMERCIALES'>ACUERDOS COMERCIALES</legend>
            <textarea name='acuerdosComerciales' id='acuerdosComerciales'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='OTROS ASPECTOS'>OTROS ASPECTOS</legend>
            <textarea name='otrosAspectos' id='otrosAspectos'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend title='CONCEPTOS TÉCNICOS'>CONCEPTOS TÉCNICOS</legend>
            <textarea name='conceptosTecnicos' id='conceptosTecnicos'><?= '$convenio->getObjeto()' ?></textarea>
        </fieldset>
    </div>
    <div>     
        <input type="hidden" value="<?= $convenio->getId()?>" name="idSolicitud" id="idSolicitud">
        <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
        <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
        <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "ConveniosDocumentos")'>
        <input type="reset" name="limpiarU"  value="LIMPIAR"/>
    </div>
</div>