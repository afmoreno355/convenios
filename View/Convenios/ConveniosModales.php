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
$convenio = new Convenio( ' id_solicitud ' , $llave_Primaria_Contructor);
if ($id == 1 && $permisos)
{
?>
<!--Modal 1-->
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
        </div>
    </div>
<?PHP 
}
if ($id == 2 && $permisos)
{
?>
<!--Modal 2-->

<div class="carga_Documento">
    <div class="contenido">
        <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
            <img src="img/icon/gestionar.png"/>
            <label class="where">Convenios DFP – Dirección de Formación Profesional</label></div>
            <br><br> 
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
            <label style="font-size: 1em; " id="aviso2" class="aviso" ><?= $convenio->getId() ?></label> 
        </div>
    </div>
<?php
require_once(__DIR__.'/ConveniosSolicitudSeccionCompletar.php');
require_once(__DIR__.'/ConveniosDocumentosSeccionCompletar.php');
require_once(__DIR__.'/ConveniosEstudiosPreviosSeccionCompletar.php');
require_once(__DIR__.'/ConveniosPaaSeccionCompletar.php');
require_once(__DIR__.'/ConveniosEstadosSeccionCompletar.php');
?>
</div>
<?PHP
}
elseif ($id == 3 && $permisos)
{
?>
<!--Modal 3-->
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/borrar.png"/>
                <lablel>
                    Se realizara la acción "<?= $accion ?>" al menú <?=$llave_Primaria?> cargado en el modulo de la Dirección de Formación Profesional.
                </label>
            </div><br><br>
            <label style="font-size: 1em; " id="aviso"></label>  
        </div>  
        <div>        
            <input type="hidden" value="<?= $convenio->getId() ?>" name="idSolicitud" id="idSolicitud">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type="submit" title="ACEPTA <?= $accion ?> EL ITEM ELEGIDO"  value="<?= $accion ?>" name="accionU" id="accionU" onclick="eliminar('aviso')">
        </div>
    </div> 
<?PHP
}
elseif ($id == 4 && $permisos ) {
    ?>
    <!--Modal 4-->
    <div class="carga_Documento">
    <div class="contenido">
        <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
            <img src="img/icon/gestionar.png"/>
            <label class="where">Convenios DFP – Dirección de Formación Profesional</label></div>
            <br><br> 
            <label style="font-size: 1em; " id="aviso" class="aviso" ></label> 
            <label style="font-size: 1em; " id="aviso2" class="aviso" ><?= $convenio->getId() ?></label> 
        </div>
    </div>
<?php
    require_once(__DIR__.'/ConveniosSolicitudSeccionMostrar.php');
    /**require_once(__DIR__.'/ConveniosDocumentosSeccionMostrar.php');
    require_once(__DIR__.'/ConveniosEstudiosPreviosSeccionMostrar.php');
    require_once(__DIR__.'/ConveniosPaaSeccionMostrar.php');
    require_once(__DIR__.'/ConveniosEstadosSeccionMostrar.php');/** */
?>
</div>
<?PHP
}
elseif ($id == 5 && $permisos ) {
    ?>
    <!--Modal 5-->
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
}
?>
