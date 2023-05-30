<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Select
 *
 * @author FELIPE
 */
class Select {
    //put your code here
    public static function listaopciones( $id , $select = '' , $query = null ){ 
        $lista='<option value="" > OPCIONES </option>';
        $seleccion='';
        $si = self::listas( $id , $query );
        for ($i = 0; $i < count($si); $i++) {
            if( $si[$i][0]==$select && $select != '' )
            {
                $seleccion='selected';
            }
            else
            {
                $seleccion='';
            }
            $lista.="<option value='{$si[$i][0]}' $seleccion> {$si[$i][1]} </option>";
        }
    return $lista;
    } 
     public static function listas( $id , $query = null ){
        switch ( $id )
        {
            case 1 :
                return ConectorBD::ejecutarQuery( $query , null ) ;
            break; 
            case 2 :
                return ConectorBD::ejecutarQuery( $query , 'eagle_admin' ) ;
            break; 
            case 3 :
                return ConectorBD::ejecutarQuery( $query , 'secretaria' ) ;
            break; 
        }
    } 
    public static function validar( $variable /*VARIABLE QUE LLEGA*/ ,
                                    $tipo /*TIPO DE VARIABLE QUE LLEGA*/ , 
                                    $tamanio = 250 /*TAMAÑO DEL TEXTO LLEGA*/,
                                    $nombre /*NOMBRE PARA DAR RESPUESTA*/ , 
                                    $array = null /*SI NO ES NULO BUSCA EN EL ARRAY DE ESTE ARCHIVO O COMODIN PARA COMPARAR*/,
                                    $bd = '' /*BASE DE DATOS DE BUSQUEDA*/,
                                    $tabla = '' /*SI NO ES NULO BUSCA EN EL ARRAY DE ESTE ARCHIVO*/) 
    {
        switch (strtoupper( $tipo ) )
        {
            case 'TEXT' ;
                if( $variable  != '' && strlen( $variable ) <= $tamanio )
                {
                    return true;
                }
                else
                {
                    print_r(strtoupper( "  ERROR EN $nombre NO DEBE ESTAR VACIO Y MINIMO DE CARACTERES $tamanio<br> " ) );
                    return false;
                }
            break;    
            case 'NUMERIC' ;
                if( is_numeric( $variable ) )
                {
                    return true;
                }
                else
                {
                    print_r(strtoupper( "  ERROR EN $nombre DEBE SER NUMERICO<br> " ) );
                    return false;
                }
            break;    
            case 'ARRAY' ;
                if( $variable != '' || is_array( $variable ) ) 
                {
                    if( $variable != '' && !is_array( $variable ) && $bd === '' ) 
                    {
                        $lista = self::listas( $array , $tabla ) ;
                        for ($i = 0; $i < count($lista); $i++) 
                        {
                            if( $lista[$i][0] == $variable )
                            {
                                return true;
                            }
                        }
                        print_r(strtoupper( "  ERROR EN $nombre NO VALIDO<br> " ) );
                    }
                    elseif( $variable != '' && !is_array( $variable ) && $bd !== '' )
                    {
                        //print_r(" select  * from $tabla where $array ");
                        if ( !empty( ConectorBD::ejecutarQuery( " select  * from $tabla where $array " , $bd ) ) )
                        {
                            return true ;
                        }
                        else 
                        {
                            print_r(strtoupper( "  ERROR EN $nombre NO EXISTE<br> " ) );
                            return false ;
                        }       
                    }
                }
                else
                {
                    print_r(strtoupper( "  ERROR EN $nombre VALIDAR INFORMACION<br> " ) );
                    return false;
                }
            break;    
            case 'DATE' ;
                if( $variable != '' )
                {
                    try  
                    {
                        list( $anio , $mes , $dia ) = explode( '-' , $variable ) ;
                        if( strlen($anio) == 4 && strlen($mes) <= 2 && strlen($dia) <= 2 )
                        {
                            if( $variable >= $array )
                            {
                                return true;
                            }
                            else  
                            {
                                print_r(strtoupper( "  ERROR EN $nombre VALIDAR INFORMACION<br> " ) );
                                return false;
                            }
                        }
                        else  
                        {
                            print_r(strtoupper( "  ERROR EN $nombre VALIDAR INFORMACION<br> " ) );
                            return false;
                        }
                    }
                    catch ( Exception $exc ) 
                    {
                        print_r(strtoupper( "  ERROR EN $nombre VALIDAR INFORMACION<br> " ) );
                        return false;
                    }
                }
                else  
                {
                    print_r(strtoupper( "  ERROR EN $nombre VALIDAR INFORMACION<br> " ) );
                    return false;
                }
            break;    
            case 'FILE' ;
                if( isset( $variable ) && $variable['name'] != '' )
                {
                    if( pathinfo(strtoupper($variable['name']), PATHINFO_EXTENSION) == strtoupper($array) ) 
                    {
                        return true;
                    }
                    else 
                    {
                        print_r(strtoupper( "  ERROR EN $nombre EXTENCION DEL ARCHIVO NO CORRESPONDE<br> " ) );
                        return false;
                    }
                }
                else
                {
                    print_r(strtoupper( "  ERROR EN $nombre SE ENCIUENTRA SIN INFORMACION<br>" ) );
                    return false ;
                }    
            break;    
        }        
    }
    
    public static function consultaId( $identificador , $tabla , $datos , $db )
    {
        $id = ConectorBD::ejecutarQuery( " select $identificador from $tabla where $datos " , $db )[0][0] ;
        return $id;
    }
}