/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function addform( valor , potcat )
{
    var donde = '' ;
    valor = parseInt(valor);
    switch (valor) 
    {
        case 1:
            var donde = 'View/Convenios/ConveniosModales.php' ;
            break;
        case 2:
            var donde = 'View/BienesServicios/BienesServiciosModales.php' ;
            break;
        case 3:
            var donde = 'View/Contratacion/ContratacionModales.php' ;
            break;
            
        default:
            return ;
            break;
    }
    idexistentesReCa( '' , potcat , 'formularioAdd' , donde , null , null );
    cargarLoad( 'formularioAdd' );
}

