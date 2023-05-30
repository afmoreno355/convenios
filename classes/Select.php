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
                return ConectorBD::ejecutarQuery( $query , 'eagle' ) ;
            break; 
            case 3 :
                return ConectorBD::ejecutarQuery( $query , 'secretaria' ) ;
            break; 
            case 4 :
                return array( array('1010','Director(a) Dirección General'), 
                      array('1012','Jefe Oficina de Control Interno'), 
                      array('1013','Jefe Oficina de Control Interno Disciplinario'), 
                      array('1023','Jefe Oficina de Comunicaciones '), 
                      array('1030','Jefe Oficina de Sistemas'), 
                      array('1100','Director(a)  Jurídico'), 
                      array('3030','Director(a)  de Planeación y Direccionamiento Corporativo'), 
                      array('4040','Director(a)  Administrativa y Financiera'), 
                      array('5050','Director(a)  de Empleo y Trabajo'), 
                      array('6060','Director(a)  de Formación Profesional'), 
                      array('7070','Director(a)  Sistema Nacional de Formación para el Trabajo '), 
                      array('8080','Director(a)  de Promoción y Relaciones Corporativas'), 
                      array('2020', 'Secretaría General' ) ) ;
            break; 
<<<<<<< HEAD
            case 5 :
            
                if( $query != null && $query != '' )
                {
                    list( $especial , $programa ) = explode( '<|°|>' , $query );
                    $cadenaSQL = " select nivel_formacion from programas where id_programa  = '$programa' ; " ;
                    $type = ConectorBD::ejecutarQuery( $cadenaSQL , 'eagle' )[0][0];
                }

                $_numeric = array() ;
                
                if( !isset( $type ) || ( isset( $type ) && ( $type == 'OPERARIO' || $type == 'AUXILIAR' ) ) )
                {
                    array_push( $_numeric , array('15' , '15 APREDICES') ) ;
                }
                
                array_push( $_numeric , array('20' , '20 APREDICES') ) ;
                array_push( $_numeric , array('25' , '25 APREDICES') ) ;
                array_push( $_numeric , array('30' , '30 APREDICES') ) ;
                array_push( $_numeric , array('35' , '35 APREDICES') ) ;
               
                if( !isset( $especial ) || ( isset( $especial ) && $type == 'TECNICO' && ( $especial == 2 || $especial == 3 || $especial == 4  )  ) ) 
                {
                    array_push( $_numeric , array('40' , '40 APREDICES') ) ;
                }
                return $_numeric;
            break; 
            case 6 :
                return array( array('s' , 'SI') ,
                              array('n' , 'NO') 
                    ) ;
            break; 
            case 7 :
                date_default_timezone_set('America/Bogota');
            
                $month= date('m', time());
                $months = array() ;

                if( ( $month >= 1 && $month <= 3 && !is_numeric( $query ) ) || ( trim( $query ) != '' && trim( $query ) == 'T' ) || ( is_numeric( $query ) && $query == 1 ) )
                {
                     array_push($months , array('1' , 'ENERO') ) ;
                     array_push($months , array('2' , 'FEBRERO') ) ;
                     array_push($months , array('3' , 'MARZO') ) ;
                }
                if( ( $month >= 4 && $month <= 6 && !is_numeric( $query ) ) || ( trim( $query ) != '' && trim( $query ) == 'T' ) || ( is_numeric( $query ) && $query == 2 ) )
                {
                    array_push($months , array('4' , 'ABRIL') ) ;
                    array_push($months , array('5' , 'MAYO') ) ;
                    array_push($months , array('6' , 'JUNIO') ) ;
                }
                if( ( $month >= 7 && $month <= 9 && !is_numeric( $query ) ) || ( trim( $query ) != '' && trim( $query ) == 'T' ) || ( is_numeric( $query ) && $query == 3 ) )
                {
                    array_push($months , array('7' , 'JULIO') ) ;
                    array_push($months , array('8' , 'AGOSTO') ) ;
                    array_push($months , array('9' , 'SEPTIEMBRE') ) ;

                }
                if( ( $month >= 10 && $month <= 12 && !is_numeric( $query ) ) || ( trim( $query ) != '' && trim( $query ) == 'T' ) || ( is_numeric( $query ) && $query == 4 ) )
                {
                    array_push($months , array('10' , 'OCTUBRE') ) ;
                    array_push($months , array('11' , 'NOVIEMBRE') ) ;
                    array_push($months , array('12' , 'DICIEMBRE') ) ;
                }
                     
                return $months ;
            break;
            case 8 :
                return array( array('MADRUGADA' , 'MADRUGADA') ,
                              array('DIURNA' , 'DIURNA') , 
                              array('NOCTURNA' , 'NOCTURNA') ,
                              array('MIXTA' , 'MIXTA') 
                    ) ;
            break; 
            case 9 :
                return ConectorBD::ejecutarQuery( $query , 'registro' ) ;
            break;
            case 10 :
                return array( array('si' , 'SI') ,
                              array('no' , 'NO') 
                    ) ;
            break;
            case 11 :
                return array( array('A' , 'ACTIVO') ,
                              array('I' , 'INACTIVO') 
                    ) ;
            break;
            case 12 :
                return array( array('1trimestre' , 'PRIMER TRIMESTRE') ,
                              array('2trimestre' , 'SEGUNDO TRIMESTRE') ,
                              array('3trimestre' , 'TERCER TRIMESTRE') ,
                              array('4trimestre' , 'CUARTO TRIMESTRE') ,
                              array('5trimestre' , 'OFERTA ESPECIAL') 
                    ) ;
            break;
=======
>>>>>>> master
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