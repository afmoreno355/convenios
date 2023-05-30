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
$filtro = " codigosede  IN ('1010', '1012','1013','1023','1032','1100','2020','3030','4040','5050','7070','8080')";
$year= date('Y', time());

// bucarPalabraClave palabra clave que se busca asociada a ajax
$bucarPalabraClave = "";

// verificar los permisos del usuario

$permisos = new Persona(" identificacion ", "'" . $_SESSION['user'] . "'");

// permisos desde Http validando los permisos de un usuario segun la tabla personamenu
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), 'eagle_admin');

if ($ingreso === false && $permisos->getIdTipo() !== "SA" ) {
    print_r("NO TIENE PERMISO PARA ESTE MENU");
    //header("Location: index");
} elseif ($_SESSION["token1"] === $_COOKIE["token1"] && $_SESSION["token2"] === $_COOKIE["token2"]) {
    // variable variable trae las variables que trae POST
    foreach ($_POST as $key => $value)
        ${$key} = $value;
        
    // Evita que ingresen ' a la base de datos
    $bucarPalabraClave = str_replace("'", "", $bucarPalabraClave);
       
    // evalua si existe bucarPalabraClave y nos crea la cadena de busqueda
    if ($bucarPalabraClave != "") {
       $filtro.=" ( codigosede like '%". strtoupper($bucarPalabraClave)."%' or  nombresede like '%". strtoupper($bucarPalabraClave)."%' or  nom_departamento like '%". strtoupper($bucarPalabraClave)."%' )";
    }

    // obj para llenar las tablas
    $sede = Sede::datosobjetos($filtro , $pagina, 20);
    // numero de paginas para la paginacion
    $numeroPaginas = ceil(Sede::count($filtro)[0][0] / 20);
    // ecrypt codifica lo que enviamos por javascript   
    $var_add = Http::encryptIt("id=1&llave_Primaria=&user={$_SESSION["user"]}&accion=ADICIONAR");
    $var_ayu = Http::encryptIt("id=4&llave_Primaria=&user={$_SESSION["user"]}&accion=AYUDA");

?> 
     <div class="botonMenu" style="font-weight: bolder; font-size: 2em; ">
        <button type='button' id='button' class="ele" title='Adicionar nuevo'  onclick="validarDatos(``, `I=<?= $var_add ?>`, `modalVentana`, `View/Sede/SedeModales.php`, event, 'ele')"><img src="img/icon/adds.png"/> ADICIONAR<br>RADICADO</button>
        <button type='button' id='button' class="ele" title='Ayuda'  onclick="validarDatos(``, `I=<?= $var_ayu ?>`, `modalVentana`, `View/Sede/SedeModales.php`, event, 'ele')"><img src="img/icon/ayu.png"/> AYUDA<br>MODULO</button>
    </div>  
    <!-- Inicio de html tablas -->
    <table id="tableIntD" class="tableIntT sombra tableIntTa">
        <tr>
            <th>CÓDIGO CENTRO</th>
            <th>NOMBRES REGIONAL</th>
            <th>NOMBRES CENTRO</th> 
            <th>ACCION</th>           
        </tr>
<?PHP
    for ($i = 0; $i < count($sede); $i++) {
        $objet = $sede[$i];
        $var_mod = Http::encryptIt("id=1&llave_Primaria={$objet->getCod()}&user={$_SESSION["user"]}&accion=MODIFICAR");
        $var_eli = Http::encryptIt("id=2&llave_Primaria={$objet->getCod()}&user={$_SESSION["user"]}&accion=ELIMINAR");
        $var_inf = Http::encryptIt("id=3&llave_Primaria={$objet->getCod()}&user={$_SESSION["user"]}&accion=INFORMACION");
?> 
            <tr>
                <td><?= $objet->getCod() ?></td>
                <td> <?= $objet->getDepartamento() ?></td>
                <td> <?= $objet->getNombre() ?></td>
                <td>
                   <a onclick="sedeGestiones(`<?= $objet->getCod() ?>`, `Convenios`)" title="Convenio de las direcciones" ><img src="img/icon/CONVENIO.png" style="width: 30px; height: 30px"/></a>
                   <a onclick="sedeGestiones(`<?= $objet->getCod() ?>`, `BienesServicios`)" title="Contratacion de bienes y servicios" ><img src="img/icon/BIENES.png" style="width: 30px; height: 30px"/></a>
                   <a onclick="sedeGestiones(`<?= $objet->getCod() ?>`, `Contratacion`)" title="Contratratación secretaria general" ><img src="img/icon/CONTRATO.png" style="width: 45px; height: 30px"/></a>
                </td>
            </tr>
<?PHP
    }
?>
        <input type="hidden" id="donde" value="Sede">
        <input type="hidden" id="id_espe" value="">
        <input type="hidden" id="numeroPaginas" value="<?= $numeroPaginas ?>">
        <input type="hidden" id="sedeGestion" value="">
        <input type="hidden" id="bucarPalabraClave" value="<?= $bucarPalabraClave ?>">
    </table>  
    
    <div id='formDetalle' style="display: none"></div>
    <!-- Fin de Html -->
<?PHP
}
?>