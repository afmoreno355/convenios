/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Descarga un archivo a partir de un contenido HTML obtenido mediante una solicitud AJAX.
 *
 * @param {Object} postcat - Datos que se enviarán al servidor mediante una solicitud AJAX.
 * @param {string} donde - ID del elemento HTML donde se mostrará el contenido antes de la descarga.
 * @param {string} accion - URL o ruta del servidor para la solicitud AJAX que obtendrá el contenido HTML.
 * @param {string} ruta - URL o ruta del archivo a descargar.
 * @param {string} titulo - Nombre que se asignará al archivo descargado.
 */
function descargarConvenios(postcat, donde, accion, ruta, titulo) {
    // Realiza una solicitud AJAX para obtener el contenido HTML.
    xhrConvenios(postcat, donde, accion);

    // Espera hasta que el contenido HTML se haya cargado en el elemento especificado.
    var id = window.setInterval(function () {
        if (document.getElementById(donde).innerHTML !== '') {
            var tmpElemento = document.getElementById('botonE');
            
            // Asigna la URL del archivo a descargar y su nombre.
            tmpElemento.href = ruta;
            tmpElemento.download = titulo;
            
            // Simula el clic en el elemento creado para descargar el archivo.
            tmpElemento.click();
            clearInterval(id);
        }
    }, 100);
    
    // Limpia el contenido del elemento especificado.
    //document.getElementById(donde).innerHTML = '';
}


function xhrConvenios(postcad, donde, accion) {
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function (){
        if(this.readyState==4 && this.status==200){
            var respuesta=this.responseText;  
            console.log(respuesta);
            document.getElementById(donde).innerHTML = respuesta;
        }        
    };
    xhr.open('POST',accion, true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send(postcad);
}

function tabConvenios() {
    const tabs = document.querySelectorAll('.convenios-tab');
    const bloques = document.querySelectorAll('.convenios-bloque');
    tabs.forEach((cadaTab, i) => {
        tabs[i].addEventListener('click', () => {
            tabs.forEach((cadaTab, i) => {
                tabs[i].classList.remove('activo');
                bloques[i].classList.remove('activo');             
            });
            tabs[i].classList.add('activo');
            bloques[i].classList.add('activo');
        });
    });    
}

function validarDatosConvenios(id, postcad, donde, accion, eve = null, tab = null){
    if(id !== null && postcad !== null && donde !== null && accion !== null ){
        idexistentesReCa(id, postcad, donde, accion, eve, tab);
    } 
    document.getElementById("modales").style.transform='translateX(0%)';      
    document.getElementById("modales").style.transition="1s"; 
    document.getElementById("formularioDiv").style.width="";
}



/*window.addEventListener("load", (event) => {

    let elemento = document.getElementById('formularioDiv');
    elemento.addEventListener('loadstart', (e) => {
        alert("Hola mundo");
    })

    console.log(elemento);
});/** */


function adicionarTabContenido(donde , potcat) {
    if(donde === '') {
        return;
    }
    idexistentesReCa( '' , potcat , 'tabContenido' , donde , null , null );
    cargarLoad( 'tabContenido' );
}
