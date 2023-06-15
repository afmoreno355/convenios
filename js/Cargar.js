/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function envioNuevo( id  , postcad , donde , accion , nuevo , si )
{
    var des = '' ;
    if( si === true )
    {
       des = atob(postcad) ; 
    }
    else
    {
         des = postcad ; 
    }
    postcad = `I=`+btoa(`${des}&${nuevo}=${id}`) ;
    idexistentesReCa('' , postcad , donde , accion , null , null )
}


function cargar( respuesta = 'aviso' , donde = document.getElementById('donde').value , formulario = '#modalesV' ) 
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

function cargartabla()
{
    var lista = `<tr><td><img class = 'imgBuy' src = '${document.getElementById('imgTable').src}' /></td><td>IMAGEN</td><td>IMAGEN</td><td>IMAGEN</td><td>IMAGEN</td></tr>` ; 
    document.getElementById('tableIntMod').innerHTML += lista ;
}

function barra_progreso( form , hacer = 'aviso' , donde )
{
    let barra_estado = document.getElementById('barra_estado') ;
    let spam = document.getElementById('spam');

        barra_estado.classList.remove('barra_azul' ) ;
        
        let peticion = new XMLHttpRequest();
        
        peticion.upload.addEventListener( "progress" , (event) => 
        {
            let porcentaje = Math.round( event.loaded / event.total * 100 ) ;
            //console.log(porcentaje);
            
            barra_estado.style.width = porcentaje + "%";
            spam.innerHTML =  porcentaje + "%";
            
        });
        
        peticion.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var respuesta = this.responseText;
            console.log(respuesta);
            respuestas( hacer , respuesta ) ;
        }
    };
        
        peticion.addEventListener( "load" , () =>
        { 
            barra_estado.classList.add('barra_azul') ;
            spam.innerHTML =  "CARGA COMPLETA";
        });
    
        peticion.open( 'post' , donde );
        
        peticion.send( new FormData(form) );
}

//para este sistema la redireccion no funciona 
function redireccion( respuesta )
{
    if (document.getElementById(respuesta).innerHTML.includes("Matriz"))
    {
        envioNuevo(document.getElementById('aviso2').innerHTML, 'id=1&accion=ADICIONAR&llave_Primaria=', `modalVentana`, `View/Matrizfactor/MatrizfactorModales.php`, 'id_matrizfactor', false)
    }
}

function reloadInfo( respuesta , form )
{
     var ids = window.setInterval(() => {
            if (document.getElementById(respuesta).innerHTML !== '')
            {
                clearInterval(ids);
                if (document.getElementById(respuesta).innerHTML.includes("Se ha cargado en el módulo"))
                {
                    //form.reset();
                    reload();
                    clearInterval(ids);
                    window.document.getElementById('modales').scroll({
                        top: 20,
                        behavior: 'smooth'
                    });
                    redireccion( respuesta );
                    document.getElementById(respuesta).style.background = 'rgba(172, 255, 51, 0.8)' ;
                } 
                else if (document.getElementById(respuesta).innerHTML.includes("ERROR"))
                {
                    window.document.getElementById('modales').scroll({
                        top: 20,
                        behavior: 'smooth'
                    });
                    clearInterval(ids);
                    document.getElementById(respuesta).style.background = 'rgba(255, 94, 51, 0.8)' ;
                }
            }
        }, 60);
}