/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function descargarConvenio(ids, postcat , donde, ruta, eve, tadId, titulo, recargar = null) {    
    
    console.log(document.getElementById('aviso'));
    
    const fechaActual = new Date();
    if( recargar === null )
    {
        cargarLoad(donde);
    }
    idexistentesReCa( ids , postcat , `${donde}` ,`${ruta}` , eve , tadId );
     
    var id  =  window.setInterval(function(){
    
        if(document.getElementById(donde).innerHTML!=='')
        { 
            var data_type = 'application/zip';
            var tmpElemento = document.getElementById('botonE');
            var tabla_div = document.getElementById(donde).innerHTML;
            tmpElemento.href = data_type + ', ' + tabla_div;
            //Asignamos el nombre a nuestro EXCEL
            tmpElemento.download= `${titulo} ${fechaActual}.zip`;
            // Simulamos el click al elemento creado para descargarlo
            tmpElemento.click();
            clearInterval(id);
        }
     },100); 
    document.getElementById(donde).innerHTML='';
}


function cargarConvenio( respuesta = 'aviso' , donde = document.getElementById('donde').value , formulario = '#modalesV' ) 
{
    formValue = true;
    i = 0;

    const form = document.querySelector(formulario);
    const formData = new FormData(form);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });

    if( formValue === true )
    {
        document.getElementById(respuesta).innerHTML = "";
        
        if( document.getElementById('barra_estado') !== null)
        {
            barra_progreso( form  , respuesta , `View/${donde}/${donde}Crud.php` ) ;
            reloadInfo( respuesta , form ) ;
        }
        else
        {
            cargarLoad(respuesta);
            formFotoDoc(`View/${donde}/${donde}Crud.php`, formData, respuesta);
            reloadInfo( respuesta , form ) ;
        }
    }
}
