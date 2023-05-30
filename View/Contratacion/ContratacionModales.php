<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// require auntomatico encuentra todas las clases/Model qeu se solicitan en el Controlador
require_once dirname(__FILE__) . "/../../autoload.php";

// Iniciamos sesion para tener las variables
session_start();

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

$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), "convenios_contratos");

if ($ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "SA") {
    $permisos = false;
}

$llave_Primaria_Contructor = ( $llave_Primaria == "" ) ? "null" : "'$llave_Primaria'";

// llamamos la clase y verificamos si ya existe info de este dato que llega
$autoricacion = new Autorizacion("radicado.id_radicado", $llave_Primaria_Contructor);
$estudio = new Estudio("id_radicado", $llave_Primaria_Contructor);
$justificacion = new Justificacion("id_radicado", $llave_Primaria_Contructor);
$obligaciones = new Obligaciones("id_radicado", $llave_Primaria_Contructor);
$idoneidad = new Idoneidad("id_radicado", $llave_Primaria_Contructor);
$pensionados = new Pensionado("id_radicado", $llave_Primaria_Contructor);
$id_idoneidad_ = ( $idoneidad->getId_idoneidad() != '' ) ? $idoneidad->getId_idoneidad() : 0 ;
$experiencia = Experiencia::datosobjetos( " id_idoneidad in ( $id_idoneidad_ )" , null , null );
$pago = new Pago("id_radicado", $llave_Primaria_Contructor);
$documentoVal = ConectorBD::ejecutarQuery(" select * from documentoval where id_radicado = $llave_Primaria_Contructor ", null );
$s1 = '' ;
$n1 = '' ;
$s2 = '' ;
$n2 = '' ;
$s3 = '' ;
$n3 = '' ;
$s4 = '' ;
$n4 = 'checked' ;
$P1 = '' ;
$P2 = '' ;
$P3 = '' ;
$P4 = '' ;
$experiencias = '' ;
$estudio_Demanda = '' ;

if ( !empty( $contratacion_cobijado = ConectorBD::ejecutarQuery("select * from contratacion_cobijado where id_radicado=$llave_Primaria_Contructor", null ) ) && $contratacion_cobijado[0][1] == 'S' ) 
{
    $s1 = 'checked' ;
}
elseif ( !empty ($contratacion_cobijado) && $contratacion_cobijado[0][1] == 'N') 
{
    $n1 = 'checked' ;
}
if ( !empty( $contratacion_incluido = ConectorBD::ejecutarQuery("select * from contratacion_incluido where id_radicado=$llave_Primaria_Contructor", null ) ) && $contratacion_incluido[0][1] == 'S' ) 
{
    $s2 = 'checked' ;
}
elseif ( !empty ($contratacion_incluido) && $contratacion_incluido[0][1] == 'N') 
{
    $n2 = 'checked' ;
}
if ( $idoneidad->getCumple() == 'S' ) 
{
    $s3 = 'checked' ;
}
elseif ( $idoneidad->getCumple() == 'N') 
{
    $n3 = 'checked' ;
}
if ( $pensionados->getPensionado() == 'S' ) 
{
    $s4 = 'checked' ;
    $n4 = '' ;
}
elseif ( $pensionados->getPensionado() == 'N') 
{
    $n4 = 'checked' ;
}
if (  $pago->getV_pago() != '' && $pago->getV_p_pago() == 0 && $pago->getV_u_pago() == 0 ) 
{
    $P1 = 'checked' ;
    $Pago_lista1 = "<di id='pagosTiposP'></di>";
    $Pago_lista1 .= "<di id='pagosTiposU'></di>";
}
elseif ( $pago->getV_pago() != '' && $pago->getV_u_pago() == 0) 
{
    $P2 = 'checked' ;
    $Pago_lista1 = "<di id='pagosTiposP'><div>
                        <fieldset>
                            <legend title='VALOR DE PRIMER PAGO'>VALOR DE PRIMER PAGO</legend>
                            <input  required type='number'  name='v_p_pago' id='v_p_pago' value='{$pago->getV_p_pago()}' />
                        </fieldset>
                    </div></di>";
    $Pago_lista1 .= "<di id='pagosTiposU'></di>";
}  
elseif ( $pago->getV_p_pago() == 0 && $pago->getV_pago() != '' ) 
{
    $P4 = 'checked' ;
    $Pago_lista1 = "<di id='pagosTiposU'><div>
                        <fieldset>
                            <legend title='ULTIMO PAGO DIFERENTE'>ULTIMO PAGO DIFERENTE</legend>
                            <input  required type='number'  name='v_u_pago' id='v_u_pago' value='{$pago->getV_u_pago()}' />
                        </fieldset>
                    </div></di>";
    $Pago_lista1 .= "<di id='pagosTiposP'></di>";
}  
elseif (  $pago->getV_pago() != '' )
{
   $P3 = 'checked' ;
   $Pago_lista1 = "<di id='pagosTiposP'><div>
                        <fieldset>
                            <legend title='VALOR DE PRIMER PAGO'>VALOR DE PRIMER PAGO</legend>
                            <input  required type='number'  name='v_p_pago' id='v_p_pago' value='{$pago->getV_p_pago()}'>
                        </fieldset>
                    </div></di>";
    $Pago_lista1 .= "<di id='pagosTiposU'><div>
                        <fieldset>
                            <legend title='VALOR DE ULTIMO PAGO'>VALOR DE ULTIMO PAGO</legend>
                            <input  required type='number'  name='v_u_pago' id='v_u_pago' value='{$pago->getV_u_pago()}'>
                        </fieldset>
                    </div></di>";
}
 else
 {
     $Pago_lista1 = "<di id='pagosTiposP'></di>";
     $Pago_lista1 .= "<di id='pagosTiposU'></di>";
 }                       
$select0 = '';
$select1 = '';
$_objeto = '';
$_Anexo = '' ;

if ($id == 1 && $permisos) {
    $lista_Empresa = Select::listaopciones( 3 , '' , 'select empresa , empresa from experiencia group by empresa order by empresa asc;' ) ;
    if( count($experiencia) > 0 && !empty($experiencia) )
{
$Ob_A = ConectorBD::ejecutarQuery( "  select * from n_objeto_a, objeto_a where id_radicado = '{$autoricacion->getId_radicado()}' and objeto_a.id_contrato = n_objeto_a.id_contrato GROUP BY id_n_objeto_a,n_objeto,objeto_a.id_contrato,n_objeto_a.id_radicado,n_objeto_a.id_contrato,objeto_a,valor,modalidad,plazo,contratista,n_valor " , null ) ;
    for ($s = 0; $s < count($Ob_A); $s++) {
        $estudio_Demanda .= " <div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='CONTRATO'>CONTRATO</legend>"
             ."         <input value='{$Ob_A[$s][2]}' required  type='text' name='contratos[]' class='contratos'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='OBJETO'>OBJETO</legend>"
             ."         <input value='{$Ob_A[$s][1]}' required  type='text' name='objetosa[]' class='objetosa'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='VALOR CONTRATO'>VALOR CONTRATO</legend>"
             ."         <input value='";
             if( $Ob_A[$s][4] != '' ) 
             {
                 $estudio_Demanda .= $Ob_A[$s][4];
             }
             else 
             {
                 $estudio_Demanda .= $Ob_A[$s][7];
             }
             $estudio_Demanda .="' required  type='number' name='valorc[]' class='valorc'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='MODALIDAD'>MODALIDAD CONTRATO</legend>"
             ."         <input value='{$Ob_A[$s][8]}' required  type='text' name='modalidadc[]' class='modalidadc'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='PLAZO'>PLAZO</legend>"
             ."         <input value='". str_replace( '-' , '/' , date('d-m-Y', strtotime(substr( $Ob_A[$s][9] , 0 , 10 )  ) ) )."' required  type='text' name='plazoc[]' class='plazoc'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."     <fieldset>"
             ."         <legend title='CONTRATISTA'>CONTRATISTA</legend>"
             ."         <input value='{$Ob_A[$s][10]}' required  type='text' name='contratistac[]' class='contratistac'>"
             ."     </fieldset>"
             ." </div>"
             ." <div>"
             ."   <fieldset>"
             .`     <legend title='ELIMINAR LA EXPERIENCIA '>ELIMINAR ESTUDIO DE LA DEMANDA</legend>`
             ."     <button type='button' name='botonmas' id='' onclick='addestudio(``,$s)' class='botonMas' >-</button><br>"
             ."  </fieldset>"
             ." </div>"
             ." </div>";    
   }    
    for ($h = 0; $h < count($experiencia); $h++) {
       $obj_ex = $experiencia[$h];
       $experiencias .=
                "<div>
                    <fieldset>
                        <legend title='NOMBRE  DE LA ENTIDAD'>NOMBRE ENTIDAD</legend>
                        <input list='empresas' required  value='{$obj_ex->getEmpresa()}' name='empresa[]' class='empresa'>
                        <datalist id='emprsas'> $lista_Empresa </datalist>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend title='FECHA DE INGRESO'>FECHA DE INGRESO</legend>
                        <input type='date' value='".(substr(str_replace('/', '-', $obj_ex->getFecha_in()), 0,10))."' name='fecha_in[]' class='fecha_in' ><br>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend title='FECHA DE RETIRO'>FECHA DE RETIRO</legend>
                        <input type='date' value='".(substr(str_replace('/', '-', $obj_ex->getFecha_fi()), 0,10))."' name='fecha_fi[]' class='fecha_fi' ><br>
                    </fieldset>
                </div>";
        } 
    }
    else
    {
        $experiencias =
                "<div id = 'display1' style = 'display:none' >
                    <fieldset>
                        <legend title='NOMBRE  DE LA ENTIDAD'>NOMBRE ENTIDAD</legend>
                        <input list='empresas'  value='' name='empresa[]' class='empresa'>
                        <datalist id='emprsas'> $lista_Empresa </datalist>
                    </fieldset>
                </div>
                <div id = 'display2' style = 'display:none' >
                    <fieldset>
                        <legend title='FECHA DE INGRESO'>FECHA DE INGRESO</legend>
                        <input type='date' value='' name='fecha_in[]' class='fecha_in' ><br>
                    </fieldset>
                </div>
                <div id = 'display3' style = 'display:none' >
                    <fieldset>
                        <legend title='FECHA DE RETIRO'>FECHA DE RETIRO</legend>
                        <input type='date' value='' name='fecha_fi[]' class='fecha_fi' ><br>
                    </fieldset>
                </div>";
    }
    ?>
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Solicitud Proceso Precontractual</div>
            </label><br><br>
            <label style="font-size: 1em; " id="aviso"></label>
        </div> 
        <div>
            <fieldset>
                <legend title='Objeto del Contrato'>Objeto</legend>
                <textarea  required  name='objeto' id='objeto'><?=$estudio->getObjeto()?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='EDUCACIÓN Y/O FORMACIÓN'>Educación y/o Formación</legend>
                <textarea  required  name='educacion' id='educacion'><?=$estudio->getEducacion()?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Experiencia Relacionada'>Experiencia Relacionada</legend>
                <textarea  required  name='experiencia' id='experiencia'><?=$estudio->getExperiencia()?></textarea>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Lugar de Ejecución'>Lugar de Ejecución</legend>
                <input  required list="municipio"  name='municipios' id='municipios' value="<?=$estudio->getMunicipio()?>" />
                <datalist id="municipio">
                    <?= $autoricacion->municipio() ?>
                </datalist>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Ordenador del Pago'>Ordenador del Pago</legend>
                <select required name='generador' id='generador'>
                        <?= $estudio->lista_select($estudio->getGenerador(),1)?>
                </select>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Supervisor'>Supervisor</legend>
                <input typt='text' required name='ordenador' id='ordenador' value="<?=$estudio->getOrdenador()?>">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='DIRECTIVO'>Nombre del Director (a) de Área o Jefe de Oficina</legend>
                <input typt='text' required name='directivo' id='directivo' value="<?=$estudio->getDirectivo()?>">
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Plazo'>Plazo</legend>
                <input type="date" value="<?php print_r(substr(str_replace('/', '-', $estudio->getFecha()), 0,10)); ?>" name="fecha" id="fecha" ><br>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='Valor Total del Contrato'>Valor Total del Contrato</legend>
                <input  required type="number"  name='valor' id='valor' value="<?=$estudio->getValor()?>" />
            </fieldset>
        </div>
        <!--pago-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where">Valor y Forma de pago:</label>
            </div>
        </div>
        <div>
            <fieldset>
                <legend title='PAGOS IGUALES'>Pagos Iguales</legend>
                <input type="radio" checked value="PAGOS IGUALES" <?=$P1?> name="TP" id="TP1" onclick="pagos(1)"><br>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='PRIMER PAGOS DIFERENTE'>Primer Pago Diferente</legend>
                <input type="radio" value="PRIMER PAGOS DIFERENTE" <?=$P2?> name="TP" id="TP2" onclick="pagos(2)"><br>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='PRIMER Y ULTIMO PAGO DIFERENTE'>Primer y Último Pago Diferente</legend>
                <input type="radio" value="PRIMER Y ULTIMO PAGO DIFERENTE" <?=$P3?> name="TP" id="TP3" onclick="pagos(3)"><br>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ULTIMO PAGO DIFERENTE'>Último Pago Diferente</legend>
                <input type="radio" value="ULTIMO PAGO DIFERENTE" <?=$P4?> name="TP" id="TP4" onclick="pagos(4)"><br>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='NUMERO DE MESES DEL CONTRATO'>Número de Meses</legend>
                <select name="duracion" id="duracion" required>
                    <?=$pago->meses($pago->getDuracion())?>
                </select>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='MES INICIO DEL CONTRATO'>Mes de Inicio</legend>
                <select name="mes_inicio" id="mes_inicio" required>
                    <?=$pago->meses_anio($pago->getMes_inicio())?>
                </select>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='VALOR DE PAGOS IGUALES'>Valor de los pagos iguales</legend>
                <input type="number" name="v_pago" id="v_pago" required value="<?=$pago->getV_pago()?>" />
            </fieldset>
        </div>
        <?PHP print_r($Pago_lista1) ?>        
        <!--justificacion-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 1. Justificación de la necesidad de la contratación: </label>
            </div>
        </div>         
         <div>
            <fieldset>
                <legend title='Justificación de la necesidad de la contratación'>Justificación</legend>
                <textarea  required  name='justificaciones' id='justificaciones'><?=$justificacion->getjustificacion()?></textarea>
            </fieldset>
        </div>
        <!--obligaciones-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 2. Obligaciones Específicas: </label>
            </div>
        </div>         
         <div>
            <fieldset>
                <legend title='Obligaciones Específicas'>Obligaciones</legend>
                <textarea  required  name='obligacion' id='obligacion'><?=$obligaciones->getObligacion()?></textarea>
            </fieldset>
        </div>
       <!--contratacion-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 11. Proceso de contratación cobijado por un acuerdo comercial: </label>
            </div>
        </div>         
        <div>
            <fieldset>
                <legend title='11. Proceso de contratación cobijado por un acuerdo comercial:'></legend>
                Si <input type="radio"  value="S" <?=$s1?> name="C_C" id="C_C1" ><br>
                No <input type="radio" checked value="N" <?=$n1?> name="C_C" id="C_C2" >
            </fieldset>
        </div>      
        
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 12. Proceso de contratación incluido en el plan de adquisiciones: </label>
            </div>
        </div>         
         <div>
            <fieldset>
                <legend title='12. Proceso de contratación incluido en el plan de adquisiciones: '></legend>
                Si <input type="radio" checked value="S" <?=$s2?> name="C_I" id="C_I1" ><br>
                No <input type="radio" value="N" <?=$n2?> name="C_I" id="C_I2" >
            </fieldset>
        </div> 
       <!--experiencia-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 14.1 Idoneidad y experiencia.</label>
            </div>
        </div> 
       <div>
            <fieldset>
                <legend title='NOMBRE CONTRATISTA'>Nombre del Contratista</legend>
                <input type="text" value="<?=$idoneidad->getNombre()?>" name="nombre" id="nombre" ><br>
            </fieldset>
        </div>
       <div>
            <fieldset>
                <legend title='Cumple'>Cumple</legend>
                Si <input type="radio" checked value="S" <?=$s3?> name="cumple" id="cumple1" ><br>
                No <input type="radio" value="N" <?=$n3?> name="cumple" id="cumple2" >
            </fieldset>
        </div>
       <!--experiencia-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where">Experiencia relacionada</label>
            </div>
        </div> 
        <div>
             <fieldset>
                 <legend title='ADICIONAR EXPERIENCIA'>Agregar Experiencia</legend>
                 <button type='button' name='botonmas' id="botonmas" onclick="botonMas('')" class="botonMas" >+</button><br>
             </fieldset>
        </div>
        <di id='masA' >
            <?=$experiencias?>
        </di>
       <!--experiencia-->
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 14.2 Estudio de la Oferta</label>
            </div>
        </div> 
       <div>
            <fieldset>
                <legend title='PENSIONADO'>¿Pensionado?</legend>
                SI <input type="radio" value="S" <?=$s4?> name="pensionado" id="pensionado1" ><br>
                NO <input type="radio" value="N" <?=$n4?> name="pensionado" id="pensionado2" >
            </fieldset>
        </div>
       <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> 14.3 Estudio de la Demanda</label>
            </div>
        </div> 
        <div> 
          <fieldset>
                <textarea id="agregarEstudio" style="display: none"></textarea>
                <legend title='Estudio de la Demanda'>Estudio de la Demanda</legend>
                <input list="estudiodemandas"  name='estudiodemandas' id='estudiodemanda' value="<?=''?>" onchange="addestudio( this.value )"/>
                <datalist id="estudiodemandas">
                    <?= $autoricacion->objeto() ?>
                </datalist>
           </fieldset>
        </div> 
       <b id='estudiodemandasadd'>
           <?= $estudio_Demanda ?>
       </b>
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; min-height: 100px;margin-left: 0px;">
                <label class="where"> Documentos Requeridos</label>
            </div>
        </div> 
        
        <?PHP
              if( empty($documentoVal) || $documentoVal[0][0] == true ){ 
        ?>
        <div>
            <fieldset>
                <legend title='DOCUMENTOS ACADEMICOS'>Documentos académicos</legend>
                <input type='file' required  value='<?= $autoricacion->getDoc_1() ?>' name='archivo1' id='archivo1' class="2p">
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r(" <input type='hidden' required  value='{$autoricacion->getDoc_1()}' name='archivo1' id='archivo1'>");
              }
              if( empty($documentoVal) || $documentoVal[0][1] == true ){
        ?>
         <div>
            <fieldset>
                <legend title='EXPERIENCIA LABORAL'>¿Experiencia Laboral?</legend>
                Si <input type="radio" value="SI" name="requiereEx" id="requieresT" onclick="exprofesional(this.value)"><br>
                No <input type="radio" value="NO" checked name="requiereEx" id="requierenT" onclick="exprofesional(this.value)">
                <p id="expprofesional"></p>
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r("<input type='hidden'  required value='{$autoricacion->getDoc_2()}' name='archivo2' id='archivo2' class = 'vacio'>");
              }
              if( empty($documentoVal) || $documentoVal[0][2] == true ){ 
        ?>
        <div>
            <fieldset>
                <legend title='TARJETA PROFESIONAL'>¿Requiere Tarjeta Profesional?</legend>
                Si <input type="radio" value="SI" name="requiereT" id="requieresT" onclick="requiereprofesional(this.value)"><br>
                No <input type="radio" value="NO" checked name="requiereT" id="requierenT" onclick="requiereprofesional(this.value)">
                <p id="requiereprofesional"></p>
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r("<input type='hidden' required  value='{$autoricacion->getDoc_3()}' name='archivo3' id='archivo3' class = 'vacio' >");
              }
              if( empty($documentoVal) || $documentoVal[0][3] == true ){ 
        ?>
        <div>
            <fieldset>
                <legend title='REQUIERE LIBRETA MILITAR'>¿Requiere Libreta Militar?</legend>
                Si <input type="radio" value="SI" name="requiereL" id="requieresL" onclick="requiereLibreta(this.value)"><br>
                No <input type="radio" value="NO" checked name="requiereL" id="requierenL" onclick="requiereLibreta(this.value)">
                <p id="libretamilitarrequiere"></p>
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r(" <input type='hidden' required  value='{$autoricacion->getDoc_4()}' name='archivo4' id='archivo4' class = 'vacio' >");
              }
              if( empty($documentoVal) || $documentoVal[0][4] == true ){ 
        ?>
        <div>
            <fieldset>
                <legend title='RUT ACTUALIZADO'>Rut Actualizado</legend>
                <input type='file' required  value='<?= $autoricacion->getDoc_5() ?>' name='archivo5' id='archivo5' class="2p">
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r("<input type='hidden' required  value='{$autoricacion->getDoc_5()}' name='archivo5' id='archivo5'>");
              }
              if( empty($documentoVal) || $documentoVal[0][5] == true ){ 
        ?>
        <div>
            <fieldset>
                <legend title='AUTORIZACION OBJETOS IGUALES'>¿Requiere Autorización de Objetos Iguales?</legend>
                Si <input type="radio" value="SI" name="requiereO" id="requieresO" onclick="requiereObjeto(this.value)"><br>
                No <input type="radio" value="NO" checked name="requiereO" id="requieren0" onclick="requiereObjeto(this.value)">
                <p id="requiereObjeto"></p>
            </fieldset>
        </div>
        <?PHP }
              else
              {
                   print_r(" <input type='hidden' required  value='{$autoricacion->getDoc_6()}' name='archivo6' id='archivo6' class = 'vacio' >");
              }
        ?>     
        <div>        
            <input type="hidden" value="<?= $autoricacion->getId_radicado() ?>" name="id" id="id">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$_SESSION['user']?>' name='personaGestion' id='personaGestion'>
            <input type="submit" value='<?= $accion ?>' name='accionU' id='accionU' onclick='cargarAutorizacion()'>
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>
    </div> 
    <?PHP
} elseif ($id == 2 && $permisos) {
    if( isset($sedeGestion) )
    {
        $sedeGestion = "<input type='hidden' value='$sedeGestion' name='sedeGestion' id='sedeGestion'>";
    }
    else 
    {
        $sedeGestion = "";    
    }
    ?>
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="<?PHP if($accion == 'ELIMINAR'){  print_r('img/icon/borrar.png'); } else { print_r('img/icon/estado.png'); }?>"/>
                <lablel>
                    Se realizará la acción "<?= $accion ?>" al proceso estructurado, correspondiente al radicado <?=$llave_Primaria?> cargado en el módulo de la Secretaría General.
                </label>
            </div><br><br>
            <label style="font-size: 1em; " id="aviso"></label>  
        </div>  
        <div>        
            <input type="hidden" value="<?= $autoricacion->getId_radicado() ?>" name="id" id="id">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <?=$sedeGestion?> 
            <input type="submit" title="ACEPTA <?= $accion ?> EL ITEM ELEGIDO"  value="<?= $accion ?>" name="accionU" id="accionU" onclick="eliminar('aviso')">
        </div>
    </div>    
<?PHP
}elseif ($id == 3 && $permisos) {
    ?>
    <div class="carga_Documento">
        <div class="contenido">  
            <div class="where_title where_modal tamanio" style="width: 100%; height: auto; margin-left: 0px;">
                <img src="img/icon/gestionar.png"/><label class="where">Módulo de la Secretaría General – Dirección de Formación Profesional</div>
            </label><br><br>
            <label style="font-size: 1em; " id="aviso"></label>   
        </div> 
        <div>
            <fieldset>
                <legend title='ANALISTA SECRETARIA GENERAL'>ANALISTA SECRETARIA GENERAL</legend>
                <input list="responsableJuridico" required  value='<?= $autoricacion->getRevisor_1() ?>' name='responsableJ' id='responsableJ'>
                <datalist id="responsableJuridico"><?= Persona::lista( $autoricacion->getRevisor_1() , 'JURIDICO' ) ?></datalist>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend title='ASESOR SECRETARIA GENERAL'>ASESOR SECRETARIA GENERAL</legend>
                <input list="responsableTecnico" required  value='<?= $autoricacion->getRevisor_2() ?>' name='responsableT' id='responsableT'>
                <datalist id="responsableTecnico"><?= Persona::lista( $autoricacion->getRevisor_2() , 'TECNICO' ) ?></datalist>
            </fieldset>
        </div>
         <div>        
            <input type="hidden" value="<?= $autoricacion->getId_radicado() ?>" name="id" id="id">
            <input type="hidden" value="<?= $accion ?>" name="accion" id="accion">
            <input type='hidden' value='<?=$sedeGestion?>' name='sedeGestion' id='sedeGestion'>
            <input type="submit" value="<?= $accion ?>" name="accionU" id="accionU" onclick="eliminar('aviso')">
            <input type="reset" name="limpiarU"  value="LIMPIAR"/>
        </div>        
    </div>
<?PHP
}
elseif ($id == 4 && $permisos ) {
    ?>
    <div id="conte_seccion" class="conte_seccion tableIntT">
        <section>
        </section>
    </div>
<?PHP
}
elseif ($id == 5 && $permisos ) {
    ?>
    <div id="conte_seccion" class="conte_seccion tableIntT">
        <section>
        </section>
    </div>
<?PHP
} 
elseif($id == 6 && $permisos)
{
    
?>   
<div class="carga_Documento">
    <div class="contenido">  
        <div class="where_title where_modal" style="width: 100%; height: auto; margin-left: 0px;">
            <lablel>
                Historial de Devoluciones 
            </label>
        </div><br><br>
        <?php
        $devoluciones = ConectorBD::ejecutarQuery(" select motivo from aprobado where id_radicado = {$autoricacion->getId_radicado()} and estadO = 'D' order by id_aprobado asc ; ", null ) ;
        for ($i = 0; $i < count($devoluciones); $i++) {
        ?>
            <p><?=$devoluciones[$i][0]?></p>
        <?php
        }
        ?>
    </div> 
</div>
<?PHP
}
elseif($id == 7 && $permisos)
{
    $var_mod = Http::encryptIt("id=1&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=MODIFICAR$envioSA");
    $var_env = Http::encryptIt("id=2&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=ENVIAR$envioSA");
    $var_eli = Http::encryptIt("id=2&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=ELIMINAR$envioSA");
    $var_pdf = Http::encryptIt("id=5&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=PDF$envioSA");
    if( isset($sedeGestion) )
    {
        $var_apr = Http::encryptIt("id=2&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=APROBAR&sedeGestion=$sedeGestion");
        $var_dev = Http::encryptIt("id=2&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=DEVOLVER&sedeGestion=$sedeGestion");
        $var_del = Http::encryptIt("id=3&llave_Primaria={$autoricacion->getId_radicado()}&user={$_SESSION["user"]}&accion=ASIGNAR&sedeGestion=$sedeGestion");
    }
?>
    <section class="sombra" style="background: rgba( <?= $style ?> );">
        <div style="width: 100%; height: 20px;"><h3>Solicitud Radicado <?= $autoricacion->getId_radicado() ?> </h3></div> 
        <?PHP if ($autoricacion->getDoc_1() != '' ) { ?>
            <div title="<?= $autoricacion->getDoc_1()?>"> <p>DOCUMENTOS ACADEMICOS</p> <a target="_blank" href="<?= $autoricacion->getDoc_1()?>"><img src="img/icon/estudios.png" class="zoom" width=120" height=70"/></a></div>
        <?PHP }
              if ($autoricacion->getDoc_2() != '' ) { ?>
            <div title="<?= $autoricacion->getDoc_2()?>"> <p>EXPERIENCIA LABORAL</p> <a target="_blank" href="<?= $autoricacion->getDoc_2()?>"><img src="img/icon/trabajos.png" class="zoom" width=130" height=80"/></a></div>
        <?PHP }
              if ($autoricacion->getDoc_3() != '' ) { ?>
            <div title="<?= $autoricacion->getDoc_3()?>"> <p>TARJETA PROFESIONAL</p> <a target="_blank" href="<?= $autoricacion->getDoc_3()?>"><img src="img/icon/card.png" class="zoom" width="90" height="90"/></a></div>
        <?PHP }
              if ($autoricacion->getDoc_4() != '' ) { ?>
            <div title="<?= $autoricacion->getDoc_4()?>"> <p>SITUACIÓN MILITAR</p> <a target="_blank" href="<?= $autoricacion->getDoc_4()?>"><img src="img/icon/militar.png" class="zoom" width=70" height=70"/></a></div>
        <?PHP }
              if ($autoricacion->getDoc_5() != '' ) { ?>
            <div title="<?= $autoricacion->getDoc_5()?>"> <p>RUT ACTUALIZADO</p> <a target="_blank" href="<?= $autoricacion->getDoc_5()?>"><img src="img/icon/certi.png" class="zoom" width=70" height=70"/></a></div>
        <?PHP }
              if ($autoricacion->getDoc_6() != '' ) { ?>
           <div title="<?= $autoricacion->getDoc_6()?>"> <p>AUTORIZACIÓN OBJETOS IGUALES</p> <a target="_blank" href="<?= $autoricacion->getDoc_6()?>"><img src="img/icon/aprobar.png" class="zoom" width=70" height=70"/></a></div>
        <?PHP } ?>
    </section>
    <section class="sombra" style="background: rgba( <?= $style ?> );">
                <div style="width: 100%; height: 20px;"><h3>Solicitud Radicado <?= $autoricacion->getId_radicado() ?> </h3></div>
<?PHP   if( ( $autoricacion->getEstado() == 'D' || $autoricacion->getEstado() == 'B' ) && ( $permisos->getIdTipo() != 'SA' || $permisos->getIdTipo() != 'CA' || $permisos->getIdTipo() != 'VC' || $permisos->getIdTipo() != "AI" ) && $boton_Add == false ){  ?>                
                <div><p>ENVIAR A REVISION</p><input type="button" id="button" name="1" onclick="validarDatos(``, `I=<?= $var_env ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Enviar Elemento del Id_radicado" value="ENVIAR"></div>
                <div><p>MODIFICAR DATOS</p><input type="button" id="button" name="3" onclick="validarDatos(``, `I=<?= $var_mod ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Modificar Elemento del Id_radicado" value="MODIFICAR"></div>
                <div><p>ELIMINAR DATOS</p><input type="button" id="button" name="3" onclick="validarDatos(``, `I=<?= $var_eli ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Eliminar" value="ELIMINAR"></div>
<?PHP   }elseif( $autoricacion->getEstado() == 'C' && ( $permisos->getIdTipo() == 'SA' || $permisos->getIdTipo() == 'CA' || $permisos->getIdTipo() == "AI" ) && $boton_Add == true){  ?>                
                <div><p>ASIGNAR REVISION</p><input type="button" id="button" name="1" onclick="validarDatos(``, `I=<?= $var_del ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Asignar" value="ASIGNAR"></div>
        <?PHP if( $aprobado_R2_2 ==  true && $aprobado_R1_2 == true ){?>       
                <div><p>APROBAR DOCUMENTOS</p><input type="button" id="button" name="1" onclick="validarDatos(``, `I=<?= $var_apr ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Aprobar Elemento del Id_radicado" value="APROBAR"></div>
        <?PHP } if( $aprobado_R2_2 == false ||  $aprobado_R1_2 == false  ){?>       
                <div><p>DEVOLVER A DEPENDENCIA</p><input type="button" id="button" name="3" onclick="validarDatos(``, `I=<?= $var_dev ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)" title="Devolver" value="DEVOLVER"></div>
<?PHP  
              }
        } ?>
             <div><p>ESTUDIOS PREVIOS</p><input type="button" id="button" name="3" onclick="memorandoGestion(<?=$autoricacion->getId_radicado()?> , <?=$_SESSION['user']?> , `<?=$_SESSION['rol']?>`)" title="Generar pdf" value="PDF"></div>
             <div><p>INEXISTENCIA</p><input type="button" id="button" name="3" onclick="memorandoGestion(<?=$autoricacion->getId_radicado()?> , <?=$_SESSION['user']?> , `<?=$_SESSION['rol']?>` , 3 )" title="Generar pdf" value="PDF"></div>
    </section><br>
<?PHP
}
?>
