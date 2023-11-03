/**
 * @author Dibier
 */




function visualizarConvenios(post, url) {
    // Datos para enviar al servidor para generar el PDF
    postConveniosBlob(post, url, (res, err) => {
        if (res) {
            var resUrl = URL.createObjectURL(res);

            // Abrir una nueva ventana y cargar la URL del PDF
            var nuevaVentana = window.open(resUrl, "_blank");

            // Liberar la URL creada cuando la ventana se carga o se cierra
            if (nuevaVentana) {
                nuevaVentana.focus(); // Simula clic
            }
        } else if (err) {
            console.log(err);
            return ;        }
        
    });
}


function postConveniosBlob(datos, url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.responseType = "blob"; // Solicitar la respuesta como Blob
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            try {
                if (xhr.status === 200) {
                    if (xhr.response instanceof Blob) {
                        // La respuesta es un Blob
                        callback(xhr.response, null);
                    } else {
                        // La respuesta no es un Blob
                        callback(null, new Error("Error: " + xhr.status));
                    }
                } else {
                    // Manejo de error en caso de que la solicitud no sea exitosa
                    callback(null, new Error("Error: " + xhr.status));
                }
            } catch (error) {
                // Manejo de excepciones en caso de un error inesperado
                callback(null, error);
            }
        }
    };
    xhr.send(datos);
}

function generarConvenios(ruta, id, post, url) {
    postConvenios(post, url, (res, err) => {
        if (err) {
            console.error(err);
            return; // Detiene la ejecución del código
        }

        actualizarHtmlPorId(id, res);
        visualizarArchivo(ruta);
    });
}

function visualizarArchivo(ruta) {
    var nuevaVentana = window.open(ruta, '_blank');
    if (nuevaVentana) {
        nuevaVentana.focus(); // Simula clic
    }
}

function descargarConvenios(nombre, ruta, id, post, url) {
    postConvenios(post, url, (res, err) => {
        if (err) {
            console.error(err);
            return; // Detiene la ejecución en caso de error
        }

        actualizarHtmlPorId(id, res);        
        descargarArchivo(nombre, ruta);
    });
}


function descargarArchivo(nombre, ruta) {
    var elemento = document.createElement('a');
    elemento.href = ruta;
    elemento.download = nombre;
    elemento.style.display = 'none';
    document.body.appendChild(elemento);
    elemento.click();
    document.body.removeChild(elemento);
}

function actualizarHtmlPorId(id, html) {
    var elemento = document.getElementById(id);
    if (elemento) {
        console.log(html);
        elemento.innerHTML = html;
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

function adicionarTabContenido(donde , potcat) {
    if(donde === '') {
        return;
    }
    idexistentesReCa( '' , potcat , 'tabContenido' , donde , null , null );
    cargarLoad( 'tabContenido' );
}


function postConvenios(datos, url, callback) {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var respuesta = xhr.responseText;
                callback(respuesta, null); // Llama al callback con la respuesta exitosa
            } else {
                callback(null, new Error("Error: " + xhr.status)); // Llama al callback con un error
            }
        }
    };

    xhr.send(datos);
}

function enviarFormularioConvenios() {

}