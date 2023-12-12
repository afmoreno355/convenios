/**
 * @author Dibier
 */

function enviarSolicitudConvenios(post, url, idElementoInformacion = 'aviso') {
    setContenidoEncriptado(post);
    enviarPostConvenios(url, (res, err) => {
        if (err) {
            console.error(`No es posible enviar el formulario. ${err}`);
        }
        console.log(res);
    });   
}

function descargarConvenios(post, url, nombre = 'archivoConvenios', idElementoInformacion = 'aviso') {
    setContenidoEncriptado(post);
    enviarPostConvenios(url, (res, err) => {
        if (err) {
            console.error(err);
            return;
        }
        var blobUrl = URL.createObjectURL(res);
        descargarArchivo(blobUrl, nombre);
    }, 'blob');
}


function descargarArchivo(ruta, nombre) {
    var elemento = document.createElement('a');
    elemento.href = ruta;
    elemento.download = nombre;
    elemento.style.display = 'none';
    document.body.appendChild(elemento);
    elemento.click();
    document.body.removeChild(elemento);
}


function generarConvenios(post, url) {
    setContenidoEncriptado(post)
    enviarPostConvenios(url, (ruta, err) => {
        if (err) {
            console.error(err);
            return;
        }
        visualizarArchivo(ruta);
    });
}

function visualizarConvenios(post, url) {
    setContenidoEncriptado(post);
    enviarPostConvenios(url, (res, err) => {
        if (err) {
            console.log(err);
            return ;
        }

        var blobUrl = URL.createObjectURL(res);
        visualizarArchivo(blobUrl);       
    }, 'blob');
}

function setContenidoEncriptado(post) {
    var elemento = document.getElementById('I');
    elemento.value = post;
}

function visualizarArchivo(ruta) {
    var nuevaVentana = window.open(ruta, '_blank');
    if (nuevaVentana) {
        nuevaVentana.focus(); // Simula clic
    }
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

function adicionarTabContenido(url) {

    //setContenidoEncriptado(post);

    if (url === '') {
        return;
    }
    enviarPostConvenios(url, (res, err) => {
        if (err) {
            console.error(err);
            return;
        }
        actualizarHtmlPorId('tabContenido', res);
    });
}

function setContenidoEncriptado(post) {
    var elemento = document.getElementById('I');
    elemento.value = post;
}

function actualizarHtmlPorId(id, html) {
    var elemento = document.getElementById(id);
    if (elemento) {
        console.log(html);
        elemento.innerHTML = html;
    }
}

function enviarPostConvenios(url, callback, tipoRespuesta = '', tipoContenido = '', formularioId = 'modalesV') {
    var datos = getDatosPorFormularioId(formularioId);
    var xhr = getXhrPost(url, callback, tipoRespuesta, tipoContenido);
    xhr.send(datos);
}

function getDatosPorFormularioId(formularioId) {
    var formulario = document.getElementById(formularioId);
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
    })
    var datos = new FormData(formulario);

    return datos;
}

function getXhrPost(url, callback, tipoRespuesta = '', tipoContenido = '') {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.responseType = tipoRespuesta;

    if (tipoContenido) {
        xhr.setRequestHeader('Content-Type', tipoContenido);
    }

    xhr.onload = () => {
        if (xhr.status === 200) {
            callback(xhr.response, null);
        } else {
            callback(null, new Error(`Error: ${xhr.status}.`));
        }
    }

    xhr.onerror = () => {
        callback(null, new Error(`Error de conexión a la red.`));
    }

    return xhr;
}