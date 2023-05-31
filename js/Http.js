/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.addEventListener('load', () =>
{
    evaluar();
});
  
window.addEventListener("hashchange", (ev) =>
{
     for (var i = 0; i < document.getElementsByClassName('color').length; i++)
    {
       document.getElementsByClassName('color')[i].className = 'menua'; 
    }  
    evaluar(); 
});
    
function evaluar( id = '' ) 
{
    var donde = '';
    var nombre = '';
    var location = window.location.toString();
    for (var i = 0; i < json.length; i++)
    {
        if (location.includes(json[i]['URL']))
        {
            donde = json[i]['DONDE'];
            nombre = json[i]['NOMBRE'];
        }
    }
    if (document.getElementById(nombre).className !== 'menua color')
    {
        document.getElementById(nombre).className += " color";
    }
    document.querySelector('#sections').innerHTML = nombre.replace( '_' , ' ' ) ;
    id = ( document.getElementById('sede_gestion') !== null ) ? `?sede_gestion=${document.getElementById('sede_gestion').innerHTML}` : '' ;
    idexistentesReCa('',`pagina=0`,'tableIntT',donde+id, null, null);
}