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
$URL = "View/Contratacion/ContratacionModales.php";
$numeroPaginas = 0 ;
$year= date('Y', time());
$month= date('m', time());
$date_ap= date('Y-m-d', time());
$boton_interno = false ;

// verificar los permisos del usuario

$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), "convenios_contratos");

if ( $ingreso === false && $permisos->getIdTipo() !== "SA" && $_SESSION["rol"] !== "CA" && $_SESSION["token1"] !== $_COOKIE["token1"] && $_SESSION["token2"] !== $_COOKIE["token2"]) {
    print_r("NO TIENE PERMISO PARA ESTE MENU");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"]) {
    // variable variable trae las variables que trae POST
    foreach ($_POST as $key => $value)
        ${$key} = $value;

    // Evita que ingresen ' a la base de datos
    $bucarPalabraClave = str_replace("'", "", $bucarPalabraClave);
    if($permisos->getIdTipo() != 'CA' && $permisos->getIdTipo() != 'SA' )
    {
         $filtro .= " and centro = '{$_SESSION['sede']}' ";   
         $sedeGestion = $_SESSION['sede'] ;   
         $boton_Add = false ;
    }
    elseif ( $permisos->getIdTipo() == 'SA' || $permisos->getIdTipo() == 'CA' ) 
    {
        if( !empty( $_GET) )
        {
            foreach ($_GET as $key => $value)
            ${$key} = $value;

            $sedeGestion = $sede_gestion ; 
            $filtro .= " and centro = '$sedeGestion' ";
        }
        else 
        {
            $sedeGestion = '' ;
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
    $var_add = Http::encryptIt("id=1&llave_Primaria=&user={$_SESSION["user"]}&accion=ADICIONAR&sedeGestion=$sedeGestion");
    $var_doc = Http::encryptIt("id=4&llave_Primaria=&user={$_SESSION["user"]}");
    $var_ayu = Http::encryptIt("id=5&llave_Primaria=&user={$_SESSION["user"]}");
?> 
    <!-- Inicio de html tablas -->
    <div class="botonMenu" style="font-weight: bolder; font-size: 2em; ">
        <!-- botones que pueda ver los diferentes usuarios del sistema-->
        <button type='button' id='button' class="ele" title='Adicionar Elemento' value="ADICIONAR" onclick="validarDatos(``, `I=<?= $var_add ?>`, `modalVentana`, `<?= $URL ?>`, event, 'ele')"><img src="img/icon/adds.png"/> ADICIONAR<br>ELEMENTO</button>
        <button type='button' id='button' class="ele" title='Ayuda del sistema' onclick="validarDatos(``, `I=<?= $var_ayu ?>`, `modalVentana`, `<?= $URL ?>`, event, 'ele')"><img src="img/icon/ayu.png"/> AYUDA<br>MÓDULO</button>
    </div>  
         <table id="tableIntD" class="tableIntT sombra tableIntTa">
            <tr>
                <th>ID RADICADO </th>
                <th class="noDisplay">CODIGO DIRECCION </th>
                <th>CONTRATISTA</th>
                <th>CARGADO POR</th>
                <th>ANALISTA SECRETARIA</th>
                <th>ASESOR SECRETARIA GENERAL</th>
                <th>COOR. RELACIONES LAB.</th>
                <th class="noDisplay">FECHA </th>
                <th colspan="2" >ACCIÓN</th> 
            </tr> 
<?PHP      
    $del_Su_Tec = ( $__VD = new Persona( ' idtipo ', " 'VB' " ) )->getApellido() ;
    $del_Su_Tec .= $__VD->getNombre() ;
    
    for ($j = 0; $j < count($autorizacion); $j++) 
    {
        $objetos = $autorizacion[$j];
        $var_mod = Http::encryptIt("id=1&llave_Primaria={$objetos->getId_radicado()}&user={$_SESSION["user"]}&accion=MODIFICAR&sedeGestion=$sedeGestion");
        $var_eli = Http::encryptIt("id=2&llave_Primaria={$objetos->getId_radicado()}&user={$_SESSION["user"]}&accion=ELIMINAR");
        $var_inf = Http::encryptIt("id=4&llave_Primaria={$objetos->getId_radicado()}&user={$_SESSION["user"]}&accion=INFORMACION");
        /*if( empty( ConectorBD::ejecutarQuery( " select * from movilidadsolicitud where id_movilidad = '{$objetos->getId_movilidad()}' ; " , null ) ) ) 
        {
            $_estado = 'SIN APROBADAR' ;
            $back = '' ;   
            $__aprobado = false ;
        } 
        else
        {   
            $_estado = 'SOLICITUD APROBADA' ;
            $back = ' style = "background: #37B2B098" ' ;
            $__aprobado = true ;
        }*/
?>
            <tr <?= ''//$back?> >
                <td><?= $objetos->getId_radicado() ?></td>
                <td class='noDisplay' ><?= $objetos->getCentro() ?></td>
                <td><?= $objetos->getContratista() ?></td>
                <td><?= $objetos->getResponsable() ?></td>
                <td><?= ( $__jur =new Persona( ' identificacion ', " '{$objetos->getRevisor_1()}' " ) )->getApellido()." ".$__jur->getNombre() ?>
                <td><?= ( $__ase =new Persona( ' identificacion ', " '{$objetos->getRevisor_2()}' " ) )->getApellido()." ".$__ase->getNombre() ?>
                <td><?= $del_Su_Tec ?></td>
                <td class='noDisplay'><?= $objetos->getFecha_sistema() ?></td>
                <td>
                    <input type="button" id="button" name="1" onclick="validarDatos(``, `I=<?= $var_inf ?>`, `modalVentana`, `<?= $URL ?>`)" title="Información Elemento" value="INFORMACIÓN">
                </td>
                <td>  
                    <input type="button" id="button" name="3" onclick="validarDatos(``, `I=<?= $var_mod ?>`, `modalVentana`, `<?= $URL ?>`)" title="Modificar Elemento" value="MODIFICAR">
                    <input type="button" id="button" name="3" onclick="validarDatos(``, `I=<?= $var_eli ?>`, `modalVentana`, `<?= $URL ?>`)" title="Eliminar" value="ELIMINAR">
                </td>
            </tr> 
         
<?php
    }
?>   
        </table>     
    
        <div id='formDetalle' style="display: none"></div>
        <input type="hidden" id="donde" value="Contratacion">
        <input type="hidden" id="numeroPaginas" value="<?= $numeroPaginas ?>">
        <input type="hidden" id="bucarPalabraClave" value="<?= $bucarPalabraClave ?>">
        <input type="hidden" id="sedeGestion" value="<?= $sedeGestion ?>">
    <!-- Fin de Html -->
</div> 
<?PHP
}
?>