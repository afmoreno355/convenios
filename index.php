<?php

//error_reporting(0);
session_start();
date_default_timezone_set('America/Bogota');
$ir = 'admin' ;
$id_espe = '' ;

foreach ($_POST as $key => $value) ${$key}=  $value;

require_once __DIR__.'/autoload.php';



$permisos = new Persona(' identificacion ', "'".$_SESSION['user']."'");
$ingreso = Http::permisos($permisos->getId(), $permisos->getIdTipo(), "eagle_admin");
if( $permisos->getIdTipo()!='SA' && $ingreso==false ){   
       header("location: http://dfp.senaedu.edu.co/modulos_gestion");
}
elseif ( $permisos->getIdTipo()=='SA') 
{
    $require = './Index_A.php';
}

?>
 <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="css/formulario.css?1">
        <link rel="stylesheet" href="css/tablas.css">
        <link rel="stylesheet" href="css/buscar.css">
        <link rel="stylesheet" href="css/modal.css?1">
        <link rel="stylesheet" href="css/body.css">
        <link rel="stylesheet" href="css/menu.css?1">
        <link rel="stylesheet" href="css/tabs.css">
        <link rel="stylesheet" href="css/seccion.css?1">
        <link rel="stylesheet" href="css/submenu.css">
        <link rel="stylesheet" href="css/titulo.css">
        <link rel="stylesheet" href="css/tituloPag.css">
        <link rel="stylesheet" href="css/tablaCompras.css">
        <link rel="stylesheet" href="css/estado.css">
        <link rel="icon" type="image/png" href="img/logo/sena.png" />  
        <title>CONVENIOS Y CONTRATOS</title>        
        <meta charset="UTF-8">
</head>
<body onload="">
    <div class="modales" id="modales">
        <button class="fas fa-times-circle salir" onclick="cerrarventana()"></button>
        <div class="formularioDiv" id="formularioDiv">              
            <form class="modalesV" id="modalesV" action="" method="POST" enctype='multipart/form-data'>                 
                <p id="modalVentana"></p>                           
            </form>
        </div>
    </div>
    
    <div class="cargar_load" id="cargar_load" style="margin-top: 150px; margin-left: 45%;background: transparent; position: fixed; width: auto; height: auto;"></div>
    
    <label class="fas fa-bars menuI" for="chequear"></label>
    <input type="checkbox" name="chek" id='chequear' onclick='menudes();' style="display: none">
    <div class="menu" id="divmenu" style=" margin-top: 0px;">
        <nav id="nav" class="navDisplay">
            <a href="http://dfp.senaedu.edu.co/modulos_gestion/inicio.php?CONTENIDO=view/Usuario/Usuario.php"><img src="img/icon/user.webp" style="width: 30px; height: 30px"/> MI USUARIO  </a>
            <?PHP include_once $require  ?>
            <a id="CERRAR" onclick="validarDatos('','','modalVentana','View/Menu/MenuFormulario.php' , event , 'menua' )"><img src="img/icon/cerrar.ico" style="width: 30px; height: 30px"/>  CERRAR SESION</a>
        </nav>
    </div>
      
    <div style=" width : 100% ; height : 250px ; overflow: hidden ">
        <div id="buscar" class="buscar">
            <div id="fecha" class="fecha"><?= $_SESSION['ultima_sesion']?></div><br>
            <form method="post" id="formBuscar">
                <input type="serch" name="bucarPalabraClave" onkeyup="BuscarElementos()" id="bucarPalabraClave" class="bucarPalabraClave" placeholder=" BUSCADOR" />
            </form>     
        </div>
        <img src="img/banner2.jpg" style=" width : 100% ; height : 800px ; margin-top: -400px; "/>
    </div>
    
    <div class="contenido">              
        <div class="tituloDonde">
            <div>ROL :: <?= !empty( ( $_rol = ConectorBD::ejecutarQuery( " select nombrecargo from cargo where codigocargo = '{$permisos->getIdTipo()}' " , null ) ) ) ? $_rol[0][0] : 'SUPER ADMIN' ?></div><br> 
            <label style="color: white"><b>USUARIO::<?= $_SESSION['user']?> </b></label> <br>
            <label style="color: white"><b>MODULO > CONVENIOS Y CONTRATOS > <span id="sections" ></span><?PHP if( isset( $sedeGestion ) ) {  echo " > <span id = 'sede_gestion' >$sedeGestion</span>"; } ?> </b></label>  
        </div>
        <table class="tableIntT c">   
            <tr>
                <td  colspan="3" class="noHover">
                    <button class="fas fa-angle-double-left" name="Atras" id="Atras" title="Pag Atras" onclick="anterior()"></button>
                    <label class="pag" name="pag" id="pag">1</label>
                    <button class="fas fa-angle-double-right" name="Adelante" id="Adelante" title="Pag Adelante" onclick="siguiente()"></button>
                </td>  
            </tr>       
        </table>
        <div id="tableIntT"></div>  
    </div>
    <div id='formDetalle' style="display: none"></div>
    <a id='botonE'  title='Descargar Excel' style="display: none"></a>    
    <div id='tablareporte' class="tableIntT tableIntTa" style="display: none;  border: 1px solid black;"></div>
</body>
    
    <script src="js/Http.js?1"> </script>
    <script src="js/encry.js?1"> </script>
    <script src="js/Menu.js?1"> </script>
    <script src="js/Ajax.js?1"> </script>
    <script src="js/Reporte.js?1"> </script>
    <script src="js/sede.js?2"> </script>
    <script src="js/Paginas.js?1"> </script>
    <script src="js/Buscar.js?1"> </script>
    <script src="js/Ventana.js?1"> </script>
    <script src="js/Cargar.js?2"> </script>
    <script src="js/Eliminar.js?1"> </script>
    <script src="js/Boton.js?1"> </script>
    <script src="js/Validar.js?1"> </script>
    <script src="js/check.js?1"> </script>
    <script src="js/cerrar.js?1"> </script>
    <script src="js/Contratacion.js?1"> </script>
    <script src="js/Convenios.js?1"> </script>


