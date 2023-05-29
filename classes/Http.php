<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of http
 *
 * @author FELIP
 */
class Http {

    //put your code here

    function __construct() {
        
    }

    public static function url() {
        $menu[] = array('URL' => "#Sede", 'DONDE' => 'View/Sede/SedeTabla.php', 'NOMBRE' => 'SEDE');
        $menu[] = array('URL' => "#Convenio", 'DONDE' => 'View/Convenio/ConvenioTabla.php', 'NOMBRE' => 'CONVENIO');
        return json_encode($menu);  
    }

    public static function encryptIt($q) {
        $qEncoded = base64_encode($q);
        return( $qEncoded );
    }

    public static function decryptIt($q) {
        $qDecoded = base64_decode($q);
        $nuevoArray = [];
        $cortarCadena = explode('&', $qDecoded);
        for ($i = 0; $i < count($cortarCadena); $i++) {
            list($nombre, $valor) = explode("=", $cortarCadena[$i]);
            $nuevoArray += [$nombre => $valor];
        }
        return $nuevoArray;
    }
    
    public static function permisos($user , $rol , $url) {
        if( $user == $_SESSION['user'] )
        {
            if( $rol == $_SESSION['rol'])
            {

                if( $rol !== 'SA' )
                {
                    $persona_Menus = new Personamenu( 'identificacion' , "'$user'" );
                    if( !empty($persona_Menus) )
                    {
                        $menus_Permisos = explode( '<|' , $persona_Menus->getPersonamenu() );
                        if(count($menus_Permisos) > 0)
                        {
                            foreach ($menus_Permisos as $key => $value) 
                            {
                                if( (new Menu( ' id ' , $value ))->getNombre() === $url )
                                {
                                    return true;
                                }
                            }
                        }  
                    }
                }
                elseif ( $rol === 'SA' ) 
                {
                     return true;
                }
            }
        }
        return false;
    }
    
    public static function js() {
        $javascript = '' ;
        $JS = scandir(dirname(__FILE__).'../../Resources/js');
        for ($i = 0; $i < count($JS); $i++) {
            if( $JS[$i] !== '.'  && $JS[$i] !== '..'  )
            {
                $javascript .= "<script src='./Resources/js/{$JS[$i]}'></script>";
            }
            
        }
        return $javascript;
    }
}
