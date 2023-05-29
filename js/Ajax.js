/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function renderImage()
{
    const form = document.querySelector('#modalesV');
    form.click();
    const formData = new FormData(form);
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });
    if( formData.get('Foto') !== null)
    {
    const file = formData.get('Foto');
    const image = URL.createObjectURL(file);
    document.getElementById('imageNew').setAttribute('src', image);
    }
}

function formFotoDoc( donde , formData, hacer = 'aviso') {
    var xhr = new XMLHttpRequest();
    renderImage( formData )
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var respuesta = this.responseText;
            //console.log(respuesta);
            respuestas( hacer , respuesta ) ;
        }
    };
    xhr.open('POST', donde, true);
    xhr.send(formData);
}

 function idexistentesReCa(id, postcad, donde = 'aviso' , accion , evt , tadId ) {
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function (){
            if(this.readyState==4 && this.status==200){
                   var respuesta=this.responseText;  
                   
               console.log(respuesta);
               respuestas( donde , respuesta ) ;
            }        
        };
        xhr.open('POST',accion, true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send(postcad); 
        action( evt , tadId ) ;
    }
     
    function action( evt = null , tadId = null )
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
    function respuestas( donde = 'aviso' , respuesta )
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


    function validarDatos(id, postcad, donde, accion, eve = null, tab = null){
        if(id !== null && postcad !== null && donde !== null && accion !== null ){
            idexistentesReCa(id, postcad, donde, accion, eve, tab);
        } 
        document.getElementById("modales").style.transform='translateX(0%)';      
        document.getElementById("modales").style.transition="1s"; 
        document.getElementById("formularioDiv").style.width=""; 
    }