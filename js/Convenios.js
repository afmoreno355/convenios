/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function descargarConvenio(postcat, donde, accion, ruta, titulo) {    
        
    xhrConvenio(postcat , `${donde}` ,`${accion}`);
     
    var id  =  window.setInterval(function(){
    
        if(document.getElementById(donde).innerHTML!=='') { 
            var tmpElemento = document.getElementById('botonE');
            var tabla_div = document.getElementById(donde).innerHTML;
            tmpElemento.href = ruta;
            // Asignamos el nombre a nuestro documento
            tmpElemento.download= `${titulo}`;
            // Simulamos el click al elemento creado para descargarlo
            tmpElemento.click();
            clearInterval(id);
        }
     },100); 
    document.getElementById(donde).innerHTML='';
}



function xhrConvenio(postcad, donde, accion, evt, tadId) {
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function (){
        if(this.readyState==4 && this.status==200){
            var respuesta=this.responseText;  
            console.log(respuesta);
            respuestas2(donde , respuesta) ;
        }        
    };
    xhr.open('POST',accion, true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send(postcad); 
    action2( evt, tadId ) ;
}
 
function action2( evt = null , tadId = null )
{
    if(evt !== null && tadId !== null)
    {
    document.getElementById('pag').innerHTML = 1;
    var i, tablinks;
    tablinks = document.getElementsByClassName(tadId);
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" color", "");
    }

    evt.currentTarget.className += " color";
    }
}

function respuestas2( donde = 'aviso' , respuesta )
{
    if( ( datos = respuesta.split('<|>') ).length >= 2)
    {
            for (var i = 0; i < document.getElementsByClassName(donde).length; i++)
            {
                document.getElementsByClassName(donde)[i].innerHTML = datos[i];
            }
    } 
    else
    {
        document.getElementById(donde).innerHTML = respuesta;
    }
}