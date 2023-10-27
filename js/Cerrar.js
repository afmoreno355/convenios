/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function cerrar( respuesta = 'aviso' , donde = document.getElementById('donde').value , formulario = '#modalesV' , modalidad )
{
    let date = new Date()

    let day = parseInt( date.getDate() ) - 1 ;
    let month = date.getMonth() + 1 ;
    let year = date.getFullYear() ;
    
    var fecha = '' ;

    if(month < 10){
      fecha = `${year}-0${month}-${day}` ;
    }else{
      fecha = `${year}-${month}-${day}` ;
    }
    //console.log(fecha);
    
    let checked = ( modalidad !== 'presencial' ) ? document.getElementById('Modalidad_1') : document.getElementById('Modalidad_2') ;
    
    checked.checked = !checked.checked ;
    
    if( modalidad === 'presencial' )
    {
        document.getElementById('fecha_inicio_').value = fecha ;
        document.getElementById('fecha_fin_').value = fecha ;
    }
    else if( modalidad === 'virtual' )
    {
        document.getElementById('fecha_inicio').value = fecha ;
        document.getElementById('fecha_fin').value = fecha ;
    }
    cargar( respuesta , donde , formulario );
}