/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sedeGestiones(sede , donde = 'Convenio' )
{
    document.getElementById('formDetalle').innerHTML = `<form method='post' action='#${donde}' onsubmit='${window.open('about:blank','print_popup','scrollbars=no,status=no,toolbar=no,directories=no,location=no,menubar=no')}' target='print_popup'  >`
            + "<input type='hidden' value='" + sede + "' id='sedeGestion' name='sedeGestion' required/>"
            + "<input type='submit' value='accion' id='accionForm' name='accionForm'/> "
            + "</form>";
    document.getElementById('accionForm').click();
}

function sedeReporte( ids , eve , tadId , ruta = `View/Sede/SedeModales.php` )
{
    reporte( '' , `Reporte_total` , ruta , ids , 'tablareporte' , eve , tadId );
}