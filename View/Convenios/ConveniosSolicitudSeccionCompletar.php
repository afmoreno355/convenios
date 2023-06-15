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
                <textarea  value='<?= $convenio->getObjeto() ?>'  name='objeto' id='objeto' ></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ALCANCE'>ALCANCE DEL OBJETO</legend>
                <textarea  value='<?= $convenio->getAlcance() ?>'  name='alcance' id='alcance' ></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='EXPECIFICACIONES TECNICAS'>EXPECIFICACIONES TÉCNICAS</legend>
                <textarea  value='<?= $convenio->getEspecificacionesTecnicas() ?>'  name='especificacionesTecnicas' id='especificacionesTecnicas' ></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='JUSTIFICACION'>JUSTIFICACIÓN</legend>
                <textarea   value='<?= $convenio->getJustificacion() ?>'  name='justificacion' id='justificacion' ></textarea>
            </fieldset>
        </div>        
        <div>     
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargar( "aviso", "Convenios" )'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
            <p><?=$_SESSION['user']?></p>
        </div>
    </div>