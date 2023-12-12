<?php
/**
 * 
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

// Acceder a la vista
$post = Sesion\iniciar($roles);

// Traer objeto
$idSolicitud = $post['llave_Primaria'] !== '' ? $post['llave_Primaria'] : null;
$campo = $idSolicitud !== null ? ' id_solicitud ' : null;
$convenio = new Convenio($campo, $idSolicitud);
$id = $post['id'];
$I = Http::encryptIt("idSolicitud={$idSolicitud}&user={$_SESSION["user"]}&accion=GUARDAR");

?>

<input type="hidden" value="<?= $I ?>" name="I" id="I" />

<?php

switch ($id) {
    case 1:
        require_once __DIR__ . '/../../View/ConveniosSolicitud/ConveniosSolicitudFormulario.php';
        break;
    case 2:
        ?>
<!--Modal 2 modificar-->
<div class="carga_Documento">
    <div class="contenido">  
        <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
            <img src="img/icon/gestionar.png"/><label class="where">Módulo Convenios y Contratos – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
        </div> 
        <div>
            <fieldset>
                <legend title='FORMULARIO DEL MÓDULO QUE DESEA DILIGENCIAR'>FORMULARIO DEL CONVENIO</legend>
                <select required name=formulario id="formulario" onchange="adicionarTabContenido(this.value)">
                    <option value=''>Selección de Formulario</option>
                    <option value='View/ConveniosSolicitud/ConveniosSolicitudFormulario.php'>Datos de la Solicitud</option>
                    <option value='View/ConveniosDocumentos/ConveniosDocumentosFormulario.php'>Documentos de la Solicitud</option>
                    <option value='View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosFormulario.php'>Estudios Previos</option>
                </select>
             </fieldset>
        </div>   
    </div>
    <di id="tabContenido"></di>
<?php
    break;
case 3:
?>
<!--Modal 3 email-->
<div class="carga_Documento">
    <div class="contenido">  
        <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
            <img src="img/icon/gestionar.png"/>
            <label class="where">Módulo Convenios y Contratos – Dirección de Formación Profesional</label>
        </div>
        <br><br>
        <label style="font-size: 1em; " >Tabla Agregar</label>  
        <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
    </div> 
</div>
<?php require_once __DIR__ . "/../../View/ConveniosMail/ConveniosMailFormulario.php"; ?>

<?PHP
break;
case 4:
?>
    <!--Modal 4 información-->
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Módulo Convenios y Contratos – Dirección de Formación Profesional</label></div>
            <br><br>
            <label style="font-size: 1em; " >Tabla Agregar</label>  
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
        </div> 
        <div>
            <fieldset>
                <legend title='INFORMACIÓN DEL MÓDULO QUE DESEA CONSULTAR'>INFORMACIÓN DEL CONVENIO</legend>
                <select required name=informacion id="informacion" onchange="adicionarTabContenido(this.value , 'I=<?= $I ?>')">
                    <option value=''>Selección de Información</option>
                    <option value='View/ConveniosSolicitud/ConveniosSolicitudVista.php'>Datos de la Solicitud</option>
                    <option value='View/ConveniosDocumentos/ConveniosDocumentosVista.php'>Documentos de la Solicitud</option>
                    <option value='View/ConveniosEstudiosPrevios/ConveniosEstudiosPreviosVista.php'>Estudios Previos</option>
                </select>
             </fieldset>
        </div>   
    </div>
    <di id="tabContenido"></di>

<?PHP

break;
case 5:

?>
    <!--Modal 5 ayuda-->
    <div class="carga_Documento">
         <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <label style="font-size: 1em; " >Manuales y documentos <br> Administrador DFP – Dirección de Formación Profesional<br><br></label> 
            </div>
        </div>
    </div>
    <div id="conte_seccion" class="conte_seccion_icon tableIntT">
        <section>
            <div>
                <p>MANUAL PASO A PASO INDICATIVA VIRTUAL</p><a href="Archivos/Ejemplos/MANUAL_VIRTUAL.pdf" target="_blank"><img src="img/icon/pdf.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>MANUAL PASO A PASO INDICATIVA PRESENCIAL</p><a href="Archivos/Ejemplos/MANUAL_PRESENCIAL.pdf" target="_blank"><img src="img/icon/pdf.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>MANUAL PASO A PASO INDICATIVA REGIONAL</p><a href="Archivos/Ejemplos/MANUAL_REGIONAL.pdf" target="_blank"><img src="img/icon/pdf.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>MANUAL PASO A PASO INDICATIVA ADMINISTRADOR</p><a href="Archivos/Ejemplos/MANUAL_ADMIN.pdf" target="_blank"><img src="img/icon/pdf.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>ARCHIVO CARGA PLANO CSV PRESENCIAL</p><a href="Archivos/Ejemplos/CATALOGO_FORMATO_PRESENCIAL.csv"><img src="img/icon/excel.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>ARCHIVO CARGA PLANO CSV VIRTUAL</p><a href="Archivos/Ejemplos/CATALOGO_FORMATO_VIRTUAL.csv"><img src="img/icon/excel.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>ARCHIVO CARGA PLANO CSV PE04</p><a href="Archivos/Ejemplos/PE04.csv"><img src="img/icon/excel.png" class="zoom" width=70" height=70"/></a>
            </div>
            <div>
                <p>ARCHIVO CARGA PLANO CSV METAS</p><a href="Archivos/Ejemplos/METAS.csv"><img src="img/icon/excel.png" class="zoom" width=70" height=70"/></a>
            </div>
        </section>
    </div>
    <div class="carga_Documento">
         <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <label style="font-size: 1em; " >Videos de ayuda dministrador DFP – Dirección de Formación Profesional<br><br></label> 
            </div>
        </div>
        <div style="width: auto">
            <fieldset>
                <legend title='PASO A PASO GENERAL '>PASO A PASO GENERAL CENTROS PRESENCIAL</legend>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/5y9Sg7okmjE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>            
            </fieldset>
         </div>
         <div style="width: auto">
            <fieldset>
                <legend title='PASO A PASO GENERAL '>PASO A PASO GENERAL CENTROS VIRTUAL</legend>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/VCtFmKXgWks" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </fieldset>
         </div>
    </div>
<?PHP
break;
case 6:
?>
    <!--Modal 6 Descargar-->
<?php
    $rutaConvenio = '/archivos/convenios/' . $convenio->getId() . '/CONVENIO_' . $convenio->getId() . '.zip';
?>
    <a href="View/ConveniosDocumentos/ConveniosDocumentosDescargar.php?file=<?= $rutaConvenio ?>&idConvenio=<?= $convenio->getId() ?>">Descargar</a>

<?php
break;
default:
    die("No se reconoce modal");

}
