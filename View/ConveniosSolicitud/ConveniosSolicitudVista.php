
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
if ($permisos)
{
?>
<!--Modal Información-->
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
                <h6>JUSTIFIACIÓN</h6>
                <p><?= $convenio->getJustificacion() ?></p>
            </section>
        </fieldset>
    </div>
</div>
<?php
}
?>