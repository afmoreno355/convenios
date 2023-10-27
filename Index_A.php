<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if( !isset( $sedeGestion ) ) 
{
?>
    <a id="SEDE" onclick="action( event , 'menua' )" class="menua" href="#Sede"><img src="img/icon/todo4.png" style="width: 30px; height: 30px"/>  SEDE</a>
    <a id="CONVENIOS" onclick="action( event , 'menua' )" class="menua" href="#Convenios"><img src="img/icon/CONVENIO.png" style="width: 30px; height: 30px"/>  CONVENIOS</a>
    <a id="BIENES_Y_SERVICIOS" onclick="action( event , 'menua' )" class="menua" href="#BienesServicios"><img src="img/icon/BIENES.png" style="width: 30px; height: 30px"/>  BI Y SE</a>
    <a id="CONTRATACION_SECRETARIA" onclick="action( event , 'menua' )" class="menua" href="#Contratacion"><img src="img/icon/CONTRATO.png" style="width: 30px; height: 30px"/>  CONTRATACION</a>
<?PHP 
}
elseif( isset( $sedeGestion ) ) 
{
    $_SESSION['nSede'] = $sedeGestion ;
?>
    <a id="CONVENIOS" onclick="action( event , 'menua' )" class="menua" href="#Convenios"><img src="img/icon/CONVENIO.png" style="width: 30px; height: 30px"/>  CONVENIOS</a>
    <a id="BIENES_Y_SERVICIOS" onclick="action( event , 'menua' )" class="menua" href="#BienesServicios"><img src="img/icon/BIENES.png" style="width: 30px; height: 30px"/> BI Y SE</a>
    <a id="CONTRATACION_SECRETARIA" onclick="action( event , 'menua' )" class="menua" href="#Contratacion"><img src="img/icon/CONTRATO.png" style="width: 30px; height: 30px"/> CONTRATACION</a>
<?PHP 
}
?>
<script>
    json = eval(<?php print_r( Http::url() ) ?>);
</script>