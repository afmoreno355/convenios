


<h2>INFORMACION DE LA SOLICITUD</h2>
<div class="carga_Documento">
<div class="nuevaseccion" >
    <fieldset>        
        <section>
            <h6>ID SOLICITUD</h6>
            <p><?= $convenio->getId() ?></p>
        </section>
        <section>
            <h6>NOMBRE</h6>
            <p><?= $convenio->getNombre() ?></p>
        </section>
        <section>
            <h6>CÓDIGO DE ÁREA</h6>
            <p><?= $convenio->getCodigoArea() ?></p>
        </section>
        <section>
            <h6>ABOGADO</h6>
            <p><?= $convenio->getAbogado() ?></p>
        </section>
        <section>
            <h6>TÉCNICO EXPERTO</h6>
            <p><?= $convenio->getTecnicoExperto() ?></p>
        </section>
        <section>
            <h6>MES DE PUBLICACIÓN</h6>
            <p><?= $convenio->getMes() ?></p>
        </section>
        <section>
            <h6>OBJETO</h6>
            <p><?= $convenio->getObjeto() ?></p>
        </section>
        <section>
            <h6>ALCANCE</h6>
            <p><?=$convenio->getAlcance() ?></p>
        </section>
        <section>
            <h6>ESPECIFICACIONES TÉCNICAS</h6>
            <p><?= $convenio->getEspecificacionesTecnicas() ?></p>
        </section>
        <section>
            <h6>JUSTIFIACIÓN</h6>
            <p><?= $convenio->getJustificacion() ?></p>
        </section>
    </fieldset>
</div>
</div>