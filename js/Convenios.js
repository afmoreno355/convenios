/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function descargar( ids , postcat , donde , ruta , eve , tadId , titulo , recargar = null  )
{    
    const fechaActual = new Date();
    if( recargar === null )
    {
        cargarLoad(donde);
    }
    idexistentesReCa( ids , postcat , `${donde}` ,`${ruta}` , eve , tadId );
     
    var id  =  window.setInterval(function(){
    
        if(document.getElementById(donde).innerHTML!=='')
        { 
            var data_type = 'data:text/csv;charset=utf-8';
            var tmpElemento = document.getElementById('botonE');
            var tabla_div = document.getElementById(donde).innerHTML;
            tmpElemento.href = data_type + ', ' + tabla_div;
            //Asignamos el nombre a nuestro EXCEL
            tmpElemento.download= `${titulo} ${fechaActual}.csv`;
            // Simulamos el click al elemento creado para descargarlo
            tmpElemento.click();
            clearInterval(id);
        }
     },100); 
    document.getElementById(donde).innerHTML='';
}

function validarExportar( centro = null, donde = null, date = null ){
    var where='';
    var modalidadREP='';
    var NuevoId=null;
    var datos_Centro = (centro != null) ?  centro  : '' ;
    hoy = new Date().getFullYear();
    fechaActual = new Date();
    cadena  = ( centro != null || (document.getElementById('id_indicativa')!==null && document.getElementById('id_indicativa').checked)) ? 'id_indicativa, ': ' ';
    cadena += ( centro != null || (document.getElementById('nom_departamento')!==null && document.getElementById('nom_departamento').checked)) ? 'nom_departamento, ': '';
    cadena += ( centro != null || (document.getElementById('cod_centro')!==null && document.getElementById('cod_centro').checked)) ? 'cod_centro, ': '';
    cadena += ( centro != null || (document.getElementById('nombresede')!==null && document.getElementById('nombresede').checked)) ? 'nombresede, ': '';
    cadena += ( centro != null || (document.getElementById('vigencia')!==null && document.getElementById('vigencia').checked)) ? 'vigencia, ': '';
    cadena += ( centro != null || (document.getElementById('oferta')!==null && document.getElementById('oferta').checked)) ? 'oferta, ': '';
    cadena += ( centro != null || (document.getElementById('id_programa')!==null && document.getElementById('id_programa').checked)) ? 'indicativa.id_programa, ': '';
    cadena += ( centro != null || (document.getElementById('nombre_programa')!==null && document.getElementById('nombre_programa').checked)) ? 'nombre_programa, ': '';
    cadena += ( centro != null || (document.getElementById('nivel_formacion')!==null && document.getElementById('nivel_formacion').checked)) ? 'nivel_formacion, ': '';
    cadena += ( centro != null || (document.getElementById('id_modalidad')!==null && document.getElementById('id_modalidad').checked)) ? 't6.metodologia, ': '';
    cadena += ( centro != null || (document.getElementById('red')!==null && document.getElementById('red').checked)) ? 't4.red, ': '';
    cadena += ( centro != null || (document.getElementById('n_p_especial')!==null && document.getElementById('n_p_especial').checked)) ? 'n_p_especial, ': '';
    cadena += ( centro != null || (document.getElementById('segmento')!==null && document.getElementById('segmento').checked)) ? 'segmento, ': '';
    cadena += ( centro != null || (document.getElementById('enfoque')!==null && document.getElementById('enfoque').checked)) ? 'pnd, ': '';
    cadena += ( centro != null || (document.getElementById('inicio')!==null && document.getElementById('inicio').checked)) ? 'inicio, ': '';
    cadena += ( centro != null || (document.getElementById('cupos')!==null && document.getElementById('cupos').checked)) ? 'cupos, ': '';
    cadena += ( centro != null || (document.getElementById('anio_termina')!==null && document.getElementById('anio_termina').checked)) ? 'anio_termina, ': '';
    cadena += ( centro != null || (document.getElementById('municipio')!==null && document.getElementById('municipio').checked)) ? 't5.municipio, ': '';
    cadena += ( centro != null || (document.getElementById('dane')!==null && document.getElementById('dane').checked)) ? 't5.dane, ': '';
    cadena += ( centro != null || (document.getElementById('codigo_municipio')!==null && document.getElementById('codigo_municipio').checked)) ? 't5.codigo_municipio, ': '';
    cadena += ( centro != null || (document.getElementById('cod_dpto_mpio')!==null && document.getElementById('cod_dpto_mpio').checked)) ? "concat(t3.id,'-',t5.codigo_municipio,'.'), ": '';
    cadena += ( centro != null || (document.getElementById('ambiente_requiere')!==null && document.getElementById('ambiente_requiere').checked)) ? 'ambiente_requiere, ': '';
    cadena += ( centro != null || (document.getElementById('gira_tecnica')!==null && document.getElementById('gira_tecnica').checked)) ? 'gira_tecnica, ': '';
    cadena += ( centro != null || (document.getElementById('programa_fic')!==null && document.getElementById('programa_fic').checked)) ? 'programa_fic, ': '';
    cadena += ( centro != null || (document.getElementById('formacion')!==null && document.getElementById('formacion').checked)) ? 'formacion, ': '';
    cadena += ( centro != null || (document.getElementById('identificacion')!==null && document.getElementById('identificacion').checked)) ? 'identificacion, ': '';
    cadena += ( centro != null || (document.getElementById('validar')!==null && document.getElementById('validar').checked)) ? 'validar, ': '';
    cadena += ( centro != null || (document.getElementById('fecha')!==null && document.getElementById('fecha').checked)) ? 'fecha, ': '';
     
    if( centro == null )
    {
        NuevoId = 2;
        modalidadREP = ( document.getElementById('modalidadREP')!==null ) ? `&modalidadREP=${document.getElementById('modalidadREP').value}` : '';
    }
    else
    {
        NuevoId = 8;
    }
    idexistentesReCa('','I='+btoa('id='+NuevoId+'&cadena='+cadena+'&nombre=INDICATIVA&where='+where+"&llave_Primaria=&datos_Centro="+datos_Centro+modalidadREP), 'tablareporte',`${donde}`);
    document.getElementById('cargar_load').innerHTML="<div class='circular-progress' id='carga'> </div>";
    document.getElementById('cargar_load').style.zIndex = "1000000";
    document.getElementById('cargar_load').style.display = "block";
    if( document.getElementById('accionU') != null )
    {
        document.getElementById('accionU').style.display = "none";
    }
    
    vuelta=1;
    var id  =  window.setInterval(function(){
    document.getElementById('carga').style.transform="rotate("+45*vuelta+"deg)";

        if((15*vuelta)==360){
            vuelta=0;
        }  
        vuelta=vuelta+1;
        if(document.getElementById('tablareporte').innerHTML!=='')
        { 
            var data_type = 'data:text/csv;charset=utf-8';
            var tmpElemento = document.getElementById('botonE');
            var tabla_div = document.getElementById('tablareporte').innerHTML;
            tmpElemento.href = data_type + ', ' + tabla_div;
            //Asignamos el nombre a nuestro EXCEL
            tmpElemento.download= `REPORTE INDICATIVA ${fechaActual}.csv`;
            // Simulamos el click al elemento creado para descargarlo
            tmpElemento.click();
            clearInterval(id);
            document.getElementById('cargar_load').style.zIndex = "0";
            document.getElementById('cargar_load').style.display = "none";
        }
     },100); 
    document.getElementById('tablareporte').innerHTML='';
}