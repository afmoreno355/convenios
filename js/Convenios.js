/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Adaptación de la función cargar() en Cargar.js 
 */
 function conveniosCargar( respuesta = "aviso" , donde = document.getElementById("donde").value , carpeta = donde , formulario = "#modalesV" ) 
 {
    formValue = true;
    i = 0;
    const form = document.querySelector(formulario);
    const formData = new FormData(form);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });
    
    while ( formValue ===  true && i < form.length-1 )
    {
        formValue = valido(form[i]);
        if(formValue === false )
        {
            form[i].focus();
        }
        else
        {
            i = i+1;
        }
    }

    if( formValue === true )
    {
        document.getElementById(respuesta).innerHTML = "";
        
        if( document.getElementById('barra_estado') !== null)
        {
            barra_progreso( form  , respuesta , `View/${carpeta}/${donde}Crud.php` ) ;
            reloadInfo( respuesta , form ) ;
        }
        else
        {
            cargarLoad(respuesta);
            formFotoDoc(`View/${carpeta}/${donde}Crud.php`, formData, respuesta);
            reloadInfo( respuesta , form ) ;
        }
    }
}


function conveniosFormFotoDoc( donde , formData, hacer = 'aviso') {
    var xhr = new XMLHttpRequest();
    
   
    xhr.open('POST', donde, true);
    console.log(formData.values());
    xhr.onload = function (evento) {
        if (xhr.status == 200) {
            console.log(xhr.status);
        } else {
            console.log("Error "+xhr.status+" obtenido")
        }
    }; 
    xhr.send(formData);
}