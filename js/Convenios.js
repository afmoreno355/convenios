/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function descargarConvenios(postcat, donde, accion, ruta, titulo) {    
        
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



function xhrConvenio(postcad, donde, accion) {
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
