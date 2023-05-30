<?PHP
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

// require auntomatico encuentra todas las clases/Model qeu se solicitan en el Controlador
require_once dirname(__FILE__) . "/../../autoload.php";

// filtro se usa para realizar las consultas de busqueda 
$filtro = " radicado.id_radicado = idoneidad.id_radicado ";
// bucarPalabraClave palabra clave que se busca asociada a ajax
$bucarPalabraClave = "";
$envioSA='';

// verificar los permisos del usuario

$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$boton_Add = true;
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), "Contratacion");

if ( $ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "CA" && $_SESSION["token1"] !== $_COOKIE["token1"] && $_SESSION["token2"] !== $_COOKIE["token2"]) {
    print_r("NO TIENE PERMISO PARA ESTE MENU");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"]) {
    // variable variable trae las variables que trae POST
    foreach ($_POST as $key => $value)
        ${$key} = $value;

    // Evita que ingresen ' a la base de datos
    $bucarPalabraClave = str_replace("'", "", $bucarPalabraClave);
    if($permisos->getIdTipo() != 'CA' && $permisos->getIdTipo() != 'SA' && $permisos->getIdTipo() != "AI")
    {
         $filtro .= " and centro = '{$_SESSION['sede']}' ";   
         $sedeGestion = $_SESSION['sede'] ;   
         $boton_Add = false ;
    }
    elseif ( $permisos->getIdTipo() == 'SA' || $permisos->getIdTipo() == 'CA' || $permisos->getIdTipo() == "AI") 
    {
        $filtro .= " and centro = '$sedeGestion' "; 
        if ( $permisos->getIdTipo() == 'SA' )
        {
           $_SESSION['sede']=$sedeGestion; 
        }
    }
    // evalua si existe bucarPalabraClave y nos crea la cadena de busqueda
    if ($bucarPalabraClave != "") {
        if( is_numeric($bucarPalabraClave) )
        {
             $filtro.=" and radicado.id_radicado = $bucarPalabraClave ";
        }
        elseif ( $bucarPalabraClave == "*APROBADO*" ) 
        {
            $filtro .= " AND estado = 'S' " ;
        }
        elseif ( $bucarPalabraClave == "*RECHAZADO*" ) 
        {
            $filtro .= " AND estado = 'D' " ;
        }
        elseif ( $bucarPalabraClave == "*SINASIGNAR*" ) 
        {
            $filtro .= " AND revisor_1 is null " ;
        }
        else 
        {
            $filtro.=" and ( nombre like '%". strtoupper($bucarPalabraClave)."%' )";
        }
    }

    // obj para llenar las tablas
    $autorizacion = Autorizacion::datosobjetos($filtro , $pagina, 20);
    // numero de paginas para la paginacion
    $numeroPaginas = ceil(Autorizacion::count($filtro)[0][0] / 20);
    // ecrypt codifica lo que enviamos por javascript    
    $var_add = Http::encryptIt("id=1&llave_Primaria=&user={$_SESSION["user"]}&accion=ADICIONAR$envioSA");
    $var_doc = Http::encryptIt("id=4&llave_Primaria=&user={$_SESSION["user"]}");
    $var_ayu = Http::encryptIt("id=5&llave_Primaria=&user={$_SESSION["user"]}");
   //        <button type='button' id='button' class="ele"  title='Tutoriales y manuales' onclick="validarDatos(``, `I=<?= $var_ayu >`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`)"><img src="img/icon/ayu.png"/> GUIA<br>USUARIO</button>
 
?> 
    <!-- Inicio de html tablas -->
    <div class="botonMenu" style="font-weight: bolder; font-size: 2em; ">
    <button type='button' id='button' class="ele"  title='Buscar' ><img src="img/icon/lupa.png"/> BUSCAR<br><select onchange="BuscarElementos( this.value )"><option value="">Buscar</option><option value="">Todo</option><option value="*RECHAZADO*">Rechazado</option><option value="*APROBADO*">Aprobado</option><option value="*SINASIGNAR*">Sin asignar</option></select></button>
<?PHP   
if( ($permisos->getIdTipo() != 'CA' && $permisos->getIdTipo() != 'VC' && $permisos->getIdTipo() != 'A' && $permisos->getIdTipo() != 'AI') || $boton_Add == false ){  ?> 
        <button type='button' id='button' class="ele"  title='Adicionar un nuevo elemento' title="Adicionar" value="ADICIONAR" onclick="validarDatos(``, `I=<?= $var_add ?>`, `modalVentana`, `View/Autorizacion/AutorizacionModales.php`, event, 'ele')"><img src="img/icon/adds.png"/> CREAR<br>PROCESO</button>
<?PHP       } 
if( $permisos->getIdTipo() == 'RM' ){
?>
           <button type='button' id='button' class="ele"  title="Revisor" value="REVISOR" onclick="idexistentesReCa('',`pagina=0&tipo=revisor`,'tableIntT','View/Revisor/RevisorTabla.php' , event, 'ele')"><img src="img/icon/rol.png"/> ROL<br>REVISOR</button>
<?PHP                    
}  
?>
   </div>
   <div id="conte_seccion" class="conte_seccion tableIntT">
<?PHP
    for ($i = 0; $i < count($autorizacion); $i++) {
        $style = '229, 231, 233' ;
        $aprobado_R1 = '' ;
        $aprobado_R2 = '' ;
        $aprobado_R3 = '' ;
        if($i % 2 == 0)
        {
            $style = '229, 231, 233, 0.5' ;
        }
        else 
        {
            $style = '213, 219, 219, 1' ;
        }
        
        $objet = $autorizacion[$i];

        $aprobado_R1_2 = false ;
        $aprobado_R2_2 = false ;
        
        $var_his = Http::encryptIt("id=6&llave_Primaria={$objet->getId_radicado()}&user={$_SESSION["user"]}&accion=HISTORIAL&sedeGestion=$sedeGestion");
        
        if( !empty( $ap = ConectorBD::ejecutarQuery(" select estado from aprobado where id_radicado = {$objet->getId_radicado()} and estado = 'A'  and identificacion = '{$objet->getRevisor_1()}' limit 1;  ", null) ) && $ap[0][0]  == 'A' )
        {
            $aprobado_R1 = " <br><br><i class='far fa-thumbs-up'></i> " ;
            $aprobado_R1_2 = true ;
        }
        elseif ( !empty( $ap = ConectorBD::ejecutarQuery(" select estado , motivo from aprobado where id_radicado = {$objet->getId_radicado()} and estado = 'D'  and identificacion = '{$objet->getRevisor_1()}' limit 1;  ", null) ) && $ap[0][0]  == 'D' )
        {
            $aprobado_R1 = " <br><br><i title='{$ap[0][1]}' class='far fa-thumbs-down' onclick='validarDatos(this.id, `I=<?= $var_his ?>`, `modales`, `View/Autorizacion/AutorizacionModales.php`, null, null)'></i>" ;
            $aprobado_R1_2 = false ;
        }
        if( !empty( $ap = ConectorBD::ejecutarQuery(" select estado from aprobado where id_radicado = {$objet->getId_radicado()} and estado = 'A'  and identificacion = '{$objet->getRevisor_2()}' limit 1;  ", null) ) && $ap[0][0]  == 'A' )
        {
            $aprobado_R2 = " <br><br><i class='far fa-thumbs-up'></i> " ;
            $aprobado_R2_2 = true ;
        }
        elseif ( !empty( $ap = ConectorBD::ejecutarQuery(" select estado , motivo from aprobado where id_radicado = {$objet->getId_radicado()} and estado = 'D'  and identificacion = '{$objet->getRevisor_2()}' limit 1;  ", null) ) && $ap[0][0]  == 'D' )
        {
            $aprobado_R2 = " <br><br><i title='{$ap[0][1]}' class='far fa-thumbs-down' onclick='validarDatos(this.id, `I=<?= $var_his ?>`, `modales`, `View/Autorizacion/AutorizacionModales.php`, null, null)'></i>" ;
            $aprobado_R2_2 = false ;
        }
        if( !empty( $firma_vb = ConectorBD::ejecutarQuery( " select aprobar from vb where id_radicado = {$objet->getId_radicado()} and aprobar = 'A' " , null ) ) )
        {
            $aprobado_R3 = " <br><br><i class='far fa-thumbs-up'></i> " ;
        }
        elseif( !empty( $firma_vb = ConectorBD::ejecutarQuery( " select aprobar from vb where id_radicado = {$objet->getId_radicado()} and aprobar = 'N' " , null ) ) )
        {
            $aprobado_R3 = " <br><br><i class='far fa-thumbs-down' onclick='validarDatos(this.id, `I=<?= $var_his ?>`, `modales`, `View/Autorizacion/AutorizacionModales.php`, null, null)'></i> " ;
        }
        
        $titulo = 'PROCESO '.$objet->getId_radicado() ;
        if( isset($sedeGestion) )
        {
            $sedeGestion = "&sedeGestion=$sedeGestion";
        }
        else
        {
            $sedeGestion = "";
        }
        $var_inf = Http::encryptIt("id=7&llave_Primaria={$objet->getId_radicado()}&user={$_SESSION["user"]}&accion=INFORMACION&aprobado_R1_2=$aprobado_R1_2&aprobado_R2_2=$aprobado_R2_2&style=$style&titulo=$titulo&boton_Add=$boton_Add$sedeGestion");
?>              
    <div>                
        <section class="sombra" style="background: rgba( <?= $style ?> );">
            <div style="width: 100%; height: 20px;"><h3>Estado Solicitud con ID <?= $objet->getId_radicado() ?> <?= $objet->getContratista() ?> </h3></div>   
            <div> <p>ID RADICADO</p> <?= $objet->getId_radicado() ?> </div>
            <div> <p>DETALLE DE REGISTRO</p> <?= $objet->getFecha_sistema() ?> </div>
            <div> <p>ESTADO</p> <?PHP if( $objet->getEstado() == 'C' ) {print_r('ENVIADO A SECRETARIA GENERAL');}elseif( $objet->getEstado() == 'B' ) {print_r('PENDIENTE DE ENVIO');}elseif( $objet->getEstado() == 'D' ) {print_r('RECHAZADO POR EL REVISOR');}elseif( $objet->getEstado() == 'S' ) {print_r('APROBADO SECRETARIA GENERAL');} ?></div>
            <div> <p>ANALISTA SECRETARIA</p> <?PHP $del_Jur = new Persona( ' identificacion ', " '{$objet->getRevisor_1()}' " ); print_r( " {$del_Jur->getNombre()} {$del_Jur->getApellido()} " ) ?> <?=$aprobado_R1?></div>
            <div> <p>ASESOR SECRETARIA GENERAL</p> <?PHP $del_Tec = new Persona( ' identificacion ', " '{$objet->getRevisor_2()}' " ); print_r( " {$del_Tec->getNombre()} {$del_Tec->getApellido()} " ) ?> <?=$aprobado_R2?></div>
            <div> <p>COOR. RELACIONES LAB.</p> <?PHP $del_Su_Tec = new Persona( ' idtipo ', " 'VB' " ); print_r( " {$del_Su_Tec->getNombre()} {$del_Su_Tec->getApellido()} " ) ?><?=$aprobado_R3?></div>
            <div class="botonMenu" style="font-weight: bolder; font-size: 2em; ">
                <button type='button' style='width:100px;height:55px;font-size:0.4rem' id='buttoninfo<?=$i?>' class="ele"  title='Ver mas información' onclick="informacion(this.id, `I=<?= $var_inf ?>`, `informacion<?=$i?>`, `View/Autorizacion/AutorizacionModales.php`, event, 'ele')">VER<br>DETALLE</button>  
            </div>            
        </section>
        <p id="informacion<?=$i?>" ></p>
    </div> 
<?PHP
    }
?> 
        <div id='formDetalle' style="display: none"></div>
        <input type="hidden" id="donde" value="Autorizacion">
        <input type="hidden" id="numeroPaginas" value="<?= $numeroPaginas ?>">
        <input type="hidden" id="bucarPalabraClave" value="<?= $bucarPalabraClave ?>">
        <input type="hidden" id="sedeGestion" value="<?= $sedeGestion ?>">
    <!-- Fin de Html -->
</div> 
<?PHP
}
?>