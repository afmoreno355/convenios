<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . "/../../autoload.php";
//
// Iniciamos sesion para tener las variables
if( !isset($_SESSION["user"]) )
{
    session_start();
}

date_default_timezone_set("America/Bogota");
$fecha = date("YmdHis");
$fechaS = date("YmdHis");
$fecha_autorizacion = date("Y-m-d H:i:s");
$validar_experiencia = 'Experiencia relacionada' ;

// variable variable trae las variables que trae POST
foreach ($_POST as $key => $value)
    ${$key} = $value;

$session = new Sesion(" identificacion ", "'{$_SESSION["user"]}'");
$persona = new Persona( " identificacion ", "'{$_SESSION["user"]}'" );
$token1 = $session->getToken1();
$token2 = $session->getToken2();

if ($_SESSION["token1"] !== $_COOKIE["token1"] && $_SESSION["token2"] !== $_COOKIE["token2"]) {
    print_r("NO TIENE PERMISO PARA REALIZAR ESTA ACCION");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"] && password_verify(md5($token1 . $token2), $session->getToken3())) {
    if (isset($accion)) {
        if( $id != '' )
        {
            $v1_A = ' id_radicado ' ;
            $v1_A_A = ' radicado.id_radicado ' ;
            $v2_A = $id ;
        }
        else
        {
            $v1_A = null ;
            $v1_A_A = null ;
            $v2_A = null ; 
        }
        $autorizacion = new Autorizacion($v1_A_A, $v2_A );
        $estudio = new Estudio($v1_A, $v2_A );
        $justificacion = new Justificacion($v1_A, $v2_A );
        $obligaciones = new Obligaciones($v1_A, $v2_A );
        $idoneidad = new Idoneidad($v1_A, $v2_A );
        $pago = new Pago($v1_A, $v2_A );
        $pension = new Pensionado($v1_A, $v2_A );
        if ($accion == "ADICIONAR" || $accion == "MODIFICAR") {
            if ( !isset($_FILES['archivo1']) || pathinfo(strtoupper($_FILES['archivo1']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                if ( !isset($_FILES['archivo1']) || copy($_FILES['archivo1']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/DOCUMENTOS_ACADEMICO_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo1']['name']), PATHINFO_EXTENSION) ) ) {
                    if( isset($_FILES['archivo1'] ) )
                    {
                        $autorizacion->setDoc_1("Archivos/DOCUMENTOS_ACADEMICO_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo1']['name']), PATHINFO_EXTENSION));
                    }
                    elseif( $accion == 'MODIFICAR' )
                    {
                        $autorizacion->setDoc_1($autorizacion->getDoc_1());
                    }
                    else 
                    {
                        $autorizacion->setDoc_1('');
                    }
                    if ( !isset($_FILES['archivo2'] ) || pathinfo(strtoupper($_FILES['archivo2']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                        if ( !isset($_FILES['archivo2'] ) || copy($_FILES['archivo2']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/EXPERIENCIA_LABORAL_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo2']['name']), PATHINFO_EXTENSION) ) ) {
                            if( isset($_FILES['archivo2'] ) )
                            {
                                 $autorizacion->setDoc_2("Archivos/EXPERIENCIA_LABORAL_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo2']['name']), PATHINFO_EXTENSION));
                            }
                            else
                            {
                                $autorizacion->setDoc_2($autorizacion->getDoc_2());
                            }
                            if ( !isset($_FILES['archivo3'] ) || pathinfo(strtoupper($_FILES['archivo3']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                                if ( !isset($_FILES['archivo3'] ) || copy($_FILES['archivo3']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/TARJETA_PROFESIONA_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo3']['name']), PATHINFO_EXTENSION) ) ) {
                                    if( isset($_FILES['archivo3'] ) )
                                    {
                                        $autorizacion->setDoc_3("Archivos/TARJETA_PROFESIONA_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo3']['name']), PATHINFO_EXTENSION));
                                    }
                                    else
                                    {
                                        $autorizacion->setDoc_3($autorizacion->getDoc_3());
                                    }                                    
                                    if ( !isset($_FILES['archivo4'] ) || pathinfo(strtoupper($_FILES['archivo4']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                                        if ( !isset($_FILES['archivo4'] ) || copy($_FILES['archivo4']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/SITUACION_MILITAR_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo4']['name']), PATHINFO_EXTENSION) ) ) {
                                            if( isset($_FILES['archivo4'] ) )
                                            {
                                                $autorizacion->setDoc_4("Archivos/SITUACION_MILITAR_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo4']['name']), PATHINFO_EXTENSION));
                                            }
                                            else
                                            {
                                                $autorizacion->setDoc_4($autorizacion->getDoc_4());
                                            } 
                                            if ( !isset($_FILES['archivo5'] ) || pathinfo(strtoupper($_FILES['archivo5']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                                                if ( !isset($_FILES['archivo5'] ) || copy($_FILES['archivo5']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/RUT_ACTUALIZADO_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo5']['name']), PATHINFO_EXTENSION) ) ) {
                                                    if( isset($_FILES['archivo5'] ) )
                                                    {
                                                        $autorizacion->setDoc_5("Archivos/RUT_ACTUALIZADO_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo5']['name']), PATHINFO_EXTENSION));
                                                    }
                                                    else
                                                    {
                                                        $autorizacion->setDoc_5($autorizacion->getDoc_5());
                                                    } 
                                                     if ( !isset($_FILES['archivo6'] ) || pathinfo(strtoupper($_FILES['archivo6']['name']), PATHINFO_EXTENSION) == 'PDF' ) {
                                                        if ( !isset($_FILES['archivo6'] ) || copy($_FILES['archivo6']['tmp_name'], "F:/wamp64/www/secretaria/Archivos/OBJETOS_IGUALES_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo6']['name']), PATHINFO_EXTENSION) ) ) {
                                                            if( isset($_FILES['archivo6'] ) )
                                                            {
                                                                $autorizacion->setDoc_6("Archivos/OBJETOS_IGUALES_" . $_SESSION['sede'] . "_" . $fechaS . "." . pathinfo(strtolower($_FILES['archivo6']['name']), PATHINFO_EXTENSION));
                                                            }
                                                            else
                                                            {
                                                                $autorizacion->setDoc_6($autorizacion->getDoc_6());
                                                            } 
                                                            if( ( !isset($objeto) || $objeto != '' ) && strlen($objeto) <= 1500 )
                                                            {
                                                                if( isset($objeto) && $objeto != '' )
                                                                {
                                                                    $estudio->setObjeto($objeto);
                                                                }
                                                                else
                                                                {
                                                                    $estudio->setObjeto('');
                                                                }
                                                                if( $educacion != "" && strlen($educacion) <= 1500 )
                                                                {
                                                                    $estudio->setEducacion($educacion);
                                                                    if( $directivo != "" )
                                                                    {
                                                                        $estudio->setDirectivo($directivo); 
                                                                        if( $experiencia != "" && strlen($experiencia) <= 1500 )
                                                                        {
                                                                            $estudio->setExperiencia($experiencia);
                                                                            if( $valor != "" && is_numeric($valor) && $valor <= 200000000 && $valor >= 1)
                                                                            {
                                                                                $estudio->setValor($valor);
                                                                                if( $ordenador != "")
                                                                                {
                                                                                    $estudio->setOrdenador($ordenador);
                                                                                    if( $fecha != '' )
                                                                                    {
                                                                                        $estudio->setFecha($fecha);                                     
                                                                                        if( $generador != '' && $estudio->_validar($generador, 1) )
                                                                                        {
                                                                                            $estudio->setGenerador($generador);                                        
                                                                                            if( $justificaciones != '' && strlen($justificaciones) <= 100000 )
                                                                                            {
                                                                                                $justificacion->setJustificacion( $justificaciones ) ;
                                                                                                if( $obligacion != '' && strlen($obligacion) <= 25000 )
                                                                                                {
                                                                                                    $obligaciones->setObligacion( $obligacion ) ;
                                                                                                    if( $nombre != '' )
                                                                                                    {
                                                                                                        $idoneidad->setNombre( strtoupper($nombre) );
                                                                                                        if( $cumple != '' && ( $cumple == 'S' || $cumple == 'N') )
                                                                                                        {
                                                                                                            $idoneidad->setCumple($cumple);
                                                                                                            if( $TP != "" && ( $TP == 'PAGOS IGUALES' || $TP == 'PRIMER PAGOS DIFERENTE' || $TP == 'PRIMER Y ULTIMO PAGO DIFERENTE' | $TP == 'ULTIMO PAGO DIFERENTE' ) )
                                                                                                            {
                                                                                                                if( is_numeric($duracion) && $duracion >= 1 && $duracion <=12 )
                                                                                                                {
                                                                                                                    $pago->setDuracion($duracion);
                                                                                                                    if( is_numeric($mes_inicio) && $mes_inicio >= 1 && $mes_inicio <=12 )
                                                                                                                    {
                                                                                                                        $pago->setMes_inicio($mes_inicio);
                                                                                                                        if( is_numeric($v_pago) && $v_pago >= 1 && $v_pago <= 100000000 )
                                                                                                                        {
                                                                                                                            $pago->setV_pago($v_pago);
                                                                                                                            if( $TP == 'PRIMER PAGOS DIFERENTE' )
                                                                                                                            {
                                                                                                                                $pago->setV_p_pago($v_p_pago);    
                                                                                                                                $pago->setV_u_pago(0);  
                                                                                                                                $igual_Pago = $pago->getV_p_pago()+$pago->getV_u_pago()+( $pago->getV_pago()*( $duracion - 1 ) ) ;
                                                                                                                            }   
                                                                                                                            elseif( $TP == 'ULTIMO PAGO DIFERENTE' )
                                                                                                                            {
                                                                                                                                $pago->setV_p_pago(0);    
                                                                                                                                $pago->setV_u_pago($v_u_pago);  
                                                                                                                                $igual_Pago = $pago->getV_p_pago()+$pago->getV_u_pago()+( $pago->getV_pago()*( $duracion - 1 ) ) ;
                                                                                                                            }
                                                                                                                            elseif( $TP == 'PRIMER Y ULTIMO PAGO DIFERENTE' )
                                                                                                                            {
                                                                                                                                $pago->setV_p_pago($v_p_pago);    
                                                                                                                                $pago->setV_u_pago($v_u_pago);    
                                                                                                                                $igual_Pago = $pago->getV_p_pago()+$pago->getV_u_pago()+( $pago->getV_pago()*( $duracion - 2 ) ) ;
                                                                                                                            }
                                                                                                                            else
                                                                                                                            {
                                                                                                                                $pago->setV_p_pago(0);    
                                                                                                                                $pago->setV_u_pago(0); 
                                                                                                                                $igual_Pago = $pago->getV_p_pago()+$pago->getV_u_pago()+($pago->getV_pago() * $duracion) ;
                                                                                                                            }
                                                                                                                            if( $igual_Pago == $valor )
                                                                                                                            {
                                                                                                                                if( isset($empresa) &&
                                                                                                                                isset($fecha_in) &&
                                                                                                                                isset($fecha_fi) &&
                                                                                                                                !empty($empresa) &&
                                                                                                                                !empty($fecha_in) &&
                                                                                                                                !empty($fecha_fi) &&
                                                                                                                                count($empresa) == count($fecha_fi) && count($fecha_fi) == count($fecha_in) )
                                                                                                                                {
                                                                                                                                    if( ( isset($contratos) &&
                                                                                                                                    isset($objetosa) &&
                                                                                                                                    !empty($contratos) &&
                                                                                                                                    !empty($objetosa) &&
                                                                                                                                    count($contratos) == count($objetosa) ) ||
                                                                                                                                    ( !isset($contratos) &&
                                                                                                                                     !isset($objetosa) ) )
                                                                                                                                    {
                                                                                                                                    if( $pensionado != '' && ( strtoupper($pensionado) == 'S'|| strtoupper($pensionado) == 'N' ) )
                                                                                                                                        {
                                                                                                                                            $pension->setPensionado($pensionado);
                                                                                                                                            if ($accion == "ADICIONAR")
                                                                                                                                            {
                                                                                                                                                $autorizacion->setFecha_sistema($fecha_autorizacion);
                                                                                                                                                $autorizacion->setResponsable($_SESSION['user']);
                                                                                                                                                $autorizacion->setEstado('B');
                                                                                                                                                $autorizacion->setCentro($_SESSION['sede']);
                                                                                                                                                if ($autorizacion->grabar()) 
                                                                                                                                                {
                                                                                                                                                    $radicado_Numero = ConectorBD::ejecutarQuery("select  id_radicado from radicado where fecha_sistema = '$fecha_autorizacion' and responsable = '{$_SESSION['user']}' and centro = '{$_SESSION['sede']}' ", null)[0][0];
                                                                                                                                                    print_r("Se ha cargado su solicitud con el radicado número $radicado_Numero el $fecha_autorizacion <br>'No olvide ver el detalle de su solicitud y enviarla para revisión, dando click en el botón <b>ENVIAR</b>'<br>");
                                                                                                                                                    $id = $radicado_Numero ; 
                                                                                                                                                    $estudio->setMunicipio($municipios);
                                                                                                                                                    $estudio->setId_radicado($id);
                                                                                                                                                    $estudio->grabar();
                                                                                                                                                    $justificacion->setId_radicado($id);
                                                                                                                                                    $justificacion->grabar();
                                                                                                                                                    $obligaciones->setId_radicado($id);
                                                                                                                                                    $obligaciones->grabar();                                                                                                    
                                                                                                                                                    $idoneidad->setFecha_sistema($fecha_autorizacion);
                                                                                                                                                    $idoneidad->setId_radicado($id);
                                                                                                                                                    $idoneidad->grabar(); 
                                                                                                                                                    $pago->setId_radicado($id);                                                                                                                              
                                                                                                                                                    $pago->grabar();   
                                                                                                                                                    $pension->setId_radicado($id);                                                                                                                              
                                                                                                                                                    $pension->grabar();   
                                                                                                                                                    Experiencia::validar( $empresa , $fecha_in , $fecha_fi , $accion , $fecha_autorizacion , $id );
                                                                                                                                                    if( isset( $contratos ) )
                                                                                                                                                    {
                                                                                                                                                        Autorizacion::validar( $contratos , $objetosa , $accion , $fecha_autorizacion , $id , $valorc );
                                                                                                                                                    }
                                                                                                                                                    if($C_C == 'S' || $C_C == 'N' )
                                                                                                                                                    {
                                                                                                                                                        ConectorBD::ejecutarQuery(" insert into contratacion_cobijado (marcado,id_radicado) values ('$C_C','$id')", null ) ;
                                                                                                                                                    }
                                                                                                                                                    if($C_I == 'S' || $C_I == 'N')
                                                                                                                                                    {
                                                                                                                                                        ConectorBD::ejecutarQuery(" insert into contratacion_incluido (marcado,id_radicado) values ('$C_I','$id')", null ) ;
                                                                                                                                                    }
                                                                                                                                                    $_envio = true ;
                                                                                                                                                }
                                                                                                                                                else
                                                                                                                                                {
                                                                                                                                                    print_r("** ERROR INESPERADO VUELVE A INTENTAR **");
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            elseif ($accion == "MODIFICAR") 
                                                                                                                                            {
                                                                                                                                                if ($autorizacion->modificar($id))
                                                                                                                                                {
                                                                                                                                                    $estudio->setMunicipio($municipios);
                                                                                                                                                    $estudio->setId_radicado($id);
                                                                                                                                                    $estudio->modificar($id);
                                                                                                                                                    $justificacion->setId_radicado($id);
                                                                                                                                                    $justificacion->modificar($id);
                                                                                                                                                    $obligaciones->setId_radicado($id);
                                                                                                                                                    $obligaciones->modificar($id);
                                                                                                                                                    $idoneidad->setFecha_sistema($fecha_autorizacion);
                                                                                                                                                    $idoneidad->setId_radicado($id);
                                                                                                                                                    $idoneidad->modificar($id); 
                                                                                                                                                    $pago->setId_radicado($id);    
                                                                                                                                                    $pago->modificar($id);  
                                                                                                                                                    $pension->setId_radicado($id);    
                                                                                                                                                    $pension->modificar($id);  
                                                                                                                                                    Experiencia::validar($empresa , $fecha_in , $fecha_fi , $accion , $fecha_autorizacion , $id );
                                                                                                                                                    if( isset( $contratos ) )
                                                                                                                                                    {
                                                                                                                                                        Autorizacion::validar( $contratos , $objetosa , $accion , $fecha_autorizacion , $id , $valorc );
                                                                                                                                                    }
                                                                                                                                                    if($C_C == 'S' || $C_C == 'N' )
                                                                                                                                                    {
                                                                                                                                                        ConectorBD::ejecutarQuery(" update contratacion_cobijado set marcado = '$C_C' where id_radicado = '$id' ", null ) ;
                                                                                                                                                    }
                                                                                                                                                    if($C_I == 'S' || $C_I == 'N')
                                                                                                                                                    {
                                                                                                                                                        ConectorBD::ejecutarQuery(" update contratacion_incluido set marcado = '$C_I' where id_radicado = '$id'", null ) ;
                                                                                                                                                    }
                                                                                                                                                    $_envio = true ;
                                                                                                                                                    print_r("Se ha cargado su solicitud con el radicado número $id el $fecha_autorizacion <br>'No olvide ver el detalle de su solicitud y enviarla para revisión, dando click en el botón <b>ENVIAR</b>'<br>");
                                                                                                                                                } 
                                                                                                                                                else 
                                                                                                                                                {
                                                                                                                                                     print_r("** ERROR INESPERADO VUELVE A INTENTAR :´( **");
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            if( isset($_envio) )
                                                                                                                                            {
                                                                                                                                                $_informacion = " De manera atenta, le notificamos que se asignó el proceso contractual de la Dependencia {$_SESSION['sede']}, con radicado No. $id a través del sistema de información.  " ;
                                                                                                                                                $_descripcion = " No olvide ver el detalle de su solicitud y enviarla para revisión a la Secretaría General, dando click en el botón ENVIAR.";
                                                                                                                                                require './../Mail/Mail.php';
                                                                                                                                                mailer("{$persona->getCorreo()}", // cambiar por una variable de los correos
                                                                                                                                                                    "<body style='width: 100%; height: auto; position: absolute;'>
                                                                                                                                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;font-weight: bold; margin-left: 5%;'>
                                                                                                                                                                    Estimado Usuario Cordial Saludo,
                                                                                                                                                                    </p>
                                                                                                                                                                    <br>
                                                                                                                                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                                                                                                                                         $_informacion
                                                                                                                                                                    </p>
                                                                                                                                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                                                                                                                                     Acción  $accion: <br>    
                                                                                                                                                                        $_descripcion
                                                                                                                                                                    </p>
                                                                                                                                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                                                                                                                                        Cordialmente,
                                                                                                                                                                    </p>
                                                                                                                                                                    <div style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                                                                                                                                          <table style='border-collapse: collapse;'>
                                                                                                                                                                                <tr>
                                                                                                                                                                                   <td rowspan='3' ><img src='https://ci6.googleusercontent.com/proxy/w5tmDxdrznIEn-19skJuYtYPgr31tuYkJUzpvzKVtG2lt_Jlvc17aieJrsOH5MjTEu4efJwsZuAdNWAbultq0IOQjBgHAxCiAg=s0-d-e1-ft#http://dfp.senaedu.edu.co/indicativa/img/logo/sena.png' width='100px' height='100px'></td><td style='border-right: 1px solid orange; color:  orange; font-weight: bold; font-size: 1.4em;'>Sistema de Gestion   </td><td> Secretaria General</td>
                                                                                                                                                                                </tr>
                                                                                                                                                                               <tr>
                                                                                                                                                                                    <td style='border-right: 1px solid orange'>De Información - DFP   </td><td style='color:  orange; font-weight: bold; font-size: 1.4em; text-decoration:none;'> www.sena.edu.co</td>
                                                                                                                                                                                </tr>		
                                                                                                                                                                            </table>		
                                                                                                                                                                    </div>
                                                                                                                                                                    </body>",
                                                                                                                                                                     " Proceso Creado ");
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        else
                                                                                                                                        {
                                                                                                                                            print_r("'Este proceso no contiene Estudio de la demanda relacionada'");
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    else
                                                                                                                                    {

                                                                                                                                    }
                                                                                                                                }
                                                                                                                                else
                                                                                                                                {
                                                                                                                                    print_r("'Este proceso no contiene Experiencia relacionada'");
                                                                                                                                }
                                                                                                                            }
                                                                                                                             else
                                                                                                                            {
                                                                                                                                print_r(' ERROR EN EL VALOR DE LOS PAGOS DEBE CORRESPONDER AL TOTAL DEL CONTRATO');
                                                                                                                            }
                                                                                                                        }
                                                                                                                        else
                                                                                                                        {
                                                                                                                            print_r(' ERROR EN EL VALOR A PAGAR VERIFICAR LA INFORMACION');
                                                                                                                        }
                                                                                                                    }
                                                                                                                    else
                                                                                                                    {
                                                                                                                        print_r(' ERROR EN EL MES DE INICIO VERIFICAR LA INFORMACION');
                                                                                                                    }
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                    print_r(' ERROR EN EL DURACION CONTRATO VERIFICAR LA INFORMACION');
                                                                                                                }
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                print_r(' ERROR NO CORRESPONDE A UN TIPO DE PAGO VERIFICAR LA INFORMACION');
                                                                                                            }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            print_r(' ERROR EN EL CAMPO NOMBRE CONTRATISTA VERIFICAR LA INFORMACION');
                                                                                                        }
                                                                                                    }
                                                                                                    else 
                                                                                                    {
                                                                                                        print_r(' ERROR EN EL CAMPO NOMBRE CONTRATISTA VERIFICAR LA INFORMACION');
                                                                                                    }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    print_r(' ERROR EN EL CAMPO OBLIGACIONES ESPECIFICA VERIFICAR LA INFORMACION');
                                                                                                }
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                 print_r(' ERROR EN EL CAMPO JUSTIFICACION DE CONTRATOS VERIFICAR LA INFORMACION');
                                                                                            }
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            print_r(' ERROR EN EL CAMPO ORDENADOR DEL PAGO VERIFICAR LA INFORMACION');
                                                                                        }
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                         print_r(' ERROR EN EL CAMPO FECHA PLAZO VERIFICAR LA INFORMACION');
                                                                                    }
                                                                                }    
                                                                                else
                                                                                {
                                                                                     print_r(' ERROR EN EL CAMPO SUPERVISOR DE CONTRATOS VERIFICAR LA INFORMACION');
                                                                                } 
                                                                            }
                                                                            else
                                                                            {
                                                                                 print_r(' ERROR EN EL CAMPO VALOR DE CONTRATOS VERIFICAR LA INFORMACION');
                                                                            } 
                                                                        }
                                                                        else
                                                                        {
                                                                             print_r(' ERROR EN EL CAMPO FORMACION VERIFICAR LA INFORMACION');
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                         print_r(' ERROR EN EL CAMPO DIRECTIVO VERIFICAR LA INFORMACION');
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                     print_r(' ERROR EN EL CAMPO EDUCACION Y O FORMACION VERIFICAR LA INFORMACION');
                                                                }
                                                            }
                                                            else
                                                            {
                                                                print_r(' ERROR EN EL OBJETO NO PUEDE ESTAR SIN INFORMACION');
                                                            }
                                                        } 
                                                        else
                                                        {
                                                            print_r(' ERROR EN EL ARCHIVO AUTORIZACION OBJEOS IGUALES CARGADO VERIFICAR LA EXTENCION');
                                                        }
                                                    }
                                                } else {
                                                     print_r(' ERROR EN EL ARCHIVO RUT ACTUALIZADO CARGADO VERIFICAR LA EXTENCION');
                                                }
                                            }
                                        } else {
                                             print_r(' ERROR EN EL ARCHIVO SITUACION MILITAR CARGADO VERIFICAR LA EXTENCION');
                                        }
                                    } 
                                } else {
                                     print_r(' ERROR EN EL ARCHIVO TARJETA PROFESIONAL CARGADO VERIFICAR LA EXTENCION');
                                }
                            }                               
                        } else {
                             print_r(' ERROR EN EL ARCHIVO EXPERIENCIA LABORAL CARGADO VERIFICAR LA EXTENCION');
                        }
                    }  
                } else {
                    print_r(' ERROR EN EL ARCHIVO DOCUMENTOS ACADEMICOS CARGADO VERIFICAR LA EXTENCION');
                }
            }                      
        }
        
        if ($accion == "ELIMINAR") {
            $autorizacion->setId_radicado($id);
            if ($autorizacion->borrar()) {
                print_r("** LA AUTORIZACION FUE ELIMINADA :( **");
            } else {
                print_r("** LA AUTORIZACION DIMENSION NO SE PUDO ELIMINAR **");
            }
        }
        
        if ($accion == "ASIGNAR") {
            require './../Mail/Mail.php';
            $autorizacion->setId_radicado($id);
            if(  !empty( ConectorBD::ejecutarQuery("select * from persona where identificacion='$responsableJ' and ( idtipo = 'RA' OR idtipo = 'RM' ) ", null ) ) )
            {
               $autorizacion->setRevisor_1($responsableJ); 
               if(  !empty( ConectorBD::ejecutarQuery("select * from persona where identificacion='$responsableT' and ( idtipo = 'RS' OR idtipo = 'RM' ) ", null ) ) )
               {
                   $autorizacion->setRevisor_2($responsableT);
                   if ($autorizacion->asignar()) {
                       
                        $responsable = ConectorBD::ejecutarQuery(" select responsable,centro from radicado where id_radicado = $id ; ", null ) ;
                        $envio_Email_Persona = Persona::datosobjetos( " AND identificacion  =  '{$responsable[0][0]}' ", null, null);
                        $_obj = $envio_Email_Persona[0];
                        for ($f = 0; $f < 4; $f++) 
                        {
                            if( $f == 0)
                            {
                                $_persona_Juridica = new Persona( " identificacion " , "'$responsableJ'"); // cambiar el numero de id
                                $_informacion = "De manera atenta, le notificamos que se asignó el proceso contractual de la Dependencia {$responsable[0][1]}, con radicado No. $id a través del sistema de información " ;
                                $_descripcion = "Acción Asignación Proceso: .";
                                $_correo =  $_persona_Juridica->getCorreo() ;
                            }  
                            elseif ($f == 1) 
                            {
                                $_persona_Tecnico = new Persona( " identificacion " , "'$responsableT'"); // cambiar el numero de id
                                $_informacion = "De manera atenta, le notificamos que se asignó el proceso contractual de la Dependencia {$responsable[0][1]}, con radicado No. $id a través del sistema de información " ;
                                $_descripcion = "Acción Asignación Proceso: ";
                                $_correo = $_persona_Tecnico->getCorreo() ;
                            }
                            elseif ($f == 2) 
                            {
                                $_persona_Visto_Bueno = new Persona( " idtipo " , "'VB'"); // cambiar el numero de id
                                $_informacion = "Señores Coordinación de Relaciones Laborales, de manera atenta se informa que Se informa que se le ha asignado el proceso con radicado $id enviada por el la Dependencia {$responsable[0][1]} a través del sistema de información. " ;
                                $_descripcion = "Acción Asignación Proceso: ";
                                $_correo = $_persona_Visto_Bueno->getCorreo() ;
                            }
                            elseif ($f == 3) 
                            {
                                $_informacion = "La Secretaria General le informa que la solicitud del proceso Contractual $id a sido asignado ;" ;
                                $_descripcion = "Aval Analista: {$_persona_Juridica->getNombre()} {$_persona_Juridica->getApellido()}<br>";
                                $_descripcion .= "Aval Asesor: {$_persona_Tecnico->getNombre()} {$_persona_Tecnico->getApellido()}<br>";
                                $_correo = $_obj->getCorreo() ;
                            }
                            mailer("$_correo", // cambiar por una variable de los correos
                                "<body style='width: 100%; height: auto; position: absolute;'>
                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;font-weight: bold; margin-left: 5%;'>
                                                            Estimado Usuario cordial saludo,
                                                    </p>
                                                    <br>
                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                        $_informacion
                                                    </p>
                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                        Acción  $accion: <br>    
                                                        $_descripcion
                                                    </p>
                                                    <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                        Cordialmente,
                                                    </p>
                                                    <div style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                            <table style='border-collapse: collapse;'>
                                                                            <tr>
                                                                                    <td rowspan='3' ><img src='https://ci6.googleusercontent.com/proxy/w5tmDxdrznIEn-19skJuYtYPgr31tuYkJUzpvzKVtG2lt_Jlvc17aieJrsOH5MjTEu4efJwsZuAdNWAbultq0IOQjBgHAxCiAg=s0-d-e1-ft#http://dfp.senaedu.edu.co/indicativa/img/logo/sena.png' width='100px' height='100px'></td><td style='border-right: 1px solid orange; color:  orange; font-weight: bold; font-size: 1.4em;'>Sistema de Gestion   </td><td> Secretaria General</td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td style='border-right: 1px solid orange'>De Información - DFP   </td><td style='color:  orange; font-weight: bold; font-size: 1.4em; text-decoration:none;'> www.sena.edu.co</td>
                                                                            </tr>		
                                                            </table>		
                                                    </div>
                                            </body>",
                                " Asignación de Proceso ");
                        }                      
                        print_r("** LOS REVISORES FUERON ASIGNADOS **");
                    } else {
                        print_r("** LOS REVISORES NO PUDIERON SER ASIGNADOS **");
                    }
               }
               else
               {
                     print_r("EL USUARIO TECNICO NO CORRESPONDE");
               }
            }
            else
            {
                print_r("EL USUARIO JURIDICO NO CORRESPONDE");
            }            
        }
        if ($accion == "ENVIAR" || $accion == "APROBAR" || $accion == "DEVOLVER") {
            require './../Mail/Mail.php';
            $autorizacion->setId_radicado($id);
            switch ($accion) {
                case 'ENVIAR':
                    $autorizacion->setEstado('C');
                    $email_Envio = true;
                    $_informacion = " Se informa que la Dependencia {$_SESSION['sede']} ha radicado la solicitud de Proceso Contractual con Número $id a través del sistema de información. " ;
                    $_descripcion = "Es importante que  se realice la asignación al Analista y Asesor de la Secretaría General.";
                    $envio_Email_Persona = Persona::datosobjetos( " AND identificacion = '20202021' ", null, null);
                    break;
                case 'APROBAR':
                    $autorizacion->setEstado('S');
                    $email_Envio = true;
                    $responsable = ConectorBD::ejecutarQuery(" select responsable,centro from radicado where id_radicado = $id ; ", null ) ;
                    $_descripcion = "El estado de este proceso pasa a aprobado.";
                    $envio_Email_Persona = Persona::datosobjetos( " AND identificacion  =  '{$responsable[0][0]}' ", null, null);
                    $_obj = $envio_Email_Persona[0];
                    $_informacion = " Autorizacion de la Dependencia {$responsable[0][1]} enviada por el usuario NOMBRE {$_obj->getNombre()} {$_obj->getApellido()} CC {$_obj->getId()} con Radicado $id . " ;             
                    break;
                case 'DEVOLVER':
                    $responsable = ConectorBD::ejecutarQuery(" select responsable,centro from radicado where id_radicado = $id ; ", null ) ;
                    $envio_Email_Persona = Persona::datosobjetos( " AND identificacion  =  '{$responsable[0][0]}' ", null, null);
                    $_obj = $envio_Email_Persona[0];
                    $_informacion = " De manera atenta, le notificamos que se devolvió el proceso contractual de la {$responsable[0][1]}, con radicado No. $id a través del sistema de información " ;
                    $email_Envio = true;
                    $_descripcion = "El estado de este proceso pasa a gestion del usuario para respectivos cambios.";
                    $autorizacion->setEstado('D');
                    break;
            }
            if ($autorizacion->estado()) {
                print_r("** LA AUTORIZACION FUE $accion :) **");    
                if (isset($email_Envio) && $email_Envio == true)
                {
                    for ($f = 0; $f < count($envio_Email_Persona); $f++) {
                        $obj = $envio_Email_Persona[$f];
                        mailer("{$obj->getCorreo()}",
                            "<body style='width: 100%; height: auto; position: absolute;'>
                                                <p style='width: 90%;height: auto;position: relative;padding: 5px;font-weight: bold; margin-left: 5%;'>
                                                        Estimado Usuario cordial saludo,
                                                </p>
                                                <br>
                                                <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                    $_informacion
                                                </p>
                                                <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                    Acción  $accion: <br>    
                                                    $_descripcion
                                                </p>
                                                <p style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                    Cordialmente,
                                                </p>
                                                <div style='width: 90%;height: auto;position: relative;padding: 5px;margin-left: 5%;'>
                                                        <table style='border-collapse: collapse;'>
                                                                        <tr>
                                                                                <td rowspan='3' ><img src='https://ci6.googleusercontent.com/proxy/w5tmDxdrznIEn-19skJuYtYPgr31tuYkJUzpvzKVtG2lt_Jlvc17aieJrsOH5MjTEu4efJwsZuAdNWAbultq0IOQjBgHAxCiAg=s0-d-e1-ft#http://dfp.senaedu.edu.co/indicativa/img/logo/sena.png' width='100px' height='100px'></td><td style='border-right: 1px solid orange; color:  orange; font-weight: bold; font-size: 1.4em;'>Sistema de Gestion   </td><td>Secretaria General</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td style='border-right: 1px solid orange'>De Información - DFP   </td><td style='color:  orange; font-weight: bold; font-size: 1.4em; text-decoration:none;'> www.sena.edu.co</td>
                                                                        </tr>		
                                                        </table>		
                                                </div>
                                        </body>",
                            "$accion Autorizacion Usuario {$_SESSION['user']}");
                    }
                }
            } else {
                print_r("** LA AUTORIZACION NO SE PUDO $accion **");
            }
        }
    }
}
?>
        