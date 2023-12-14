<?php
/**
 * @author Dibier
 */

 namespace Sesion;

 require_once __DIR__ . "/../autoload.php";


 function iniciar($roles) {
    // Inicia sesión
    try {
        session_start();
        $usuario = $_SESSION['user'];
        identificar($usuario);
        verificarAcceso($usuario);
        verificarRol($roles);

        return obtenerVariablesPost();
    } catch (\Exception $e) {
        die("Error al iniciar sesión. " . $e->getMessage());
    }
    
}

function verificarRol($roles) {
    try {
        $usuario = $_SESSION['user'];

        // Llamar roles
        $rolSesion = $_SESSION['rol'];
        $rolBaseDatos = (new \Persona("identificacion", "'$usuario'"))->getIdTipo();

        $ingreso = compararRol($rolSesion, $roles) and compararRol($rolBaseDatos, $roles);

        if ($ingreso === false) {            
            throw new \Exception("En este momento este recurso no se encuentra disponible.");
        }
    } catch (\Exception $e) {
        die("No fue posible verificar rol. " . $e->getMessage());
    }

}

function compararRol($rol, $roles) {
    if ($rol == "SA" or in_array("*", $roles)) {
        return true;
    }
    return in_array($rol, $roles);
}

function identificar($usuario) {
    if (!isset($usuario)) {
        die("No ha iniciado sesión.");
    }
}


function verificarAcceso($usuario) {
    try {
        verificarSesionActiva();

        // Llama sessión guardada
        $session = new \Sesion(" identificacion ", " '$usuario' ");

        // Traer tokenes.
        $token1 = $session->getToken1();
        $token2 = $session->getToken2();
        $token3 = $session->getToken3();

        if (!password_verify(md5($token1 . $token2), $token3)) {
            throw new \Exception("No tiene acceso a este recurso.");
        }
    } catch (\Exception $e) {
        throw new \Exception("No es posible verificar acceso. " . $e->getMessage());
    }
}


function verificarSesionActiva() {
    for ($i = 1; $i <= 2; $i++) {
        if ($_SESSION["token$i"] !== $_COOKIE["token$i"]) {
            die("No tiene permiso para realizar esta acción.");
        }
    }
}


function obtenerVariablesPost() {
    try {
        if (isset($_POST['I'])) {
            $I = $_POST['I'];
            $dec = base64_decode($I);

            if ($dec === false) {
                die("Error al decodificar los datos.");
            }

            parse_str($dec, $arr);

            return $arr;

        } else {
            die("No se ha proporcionado información encriptada 'I' en la solicitud POST.");
        }
    } catch (\Exception $e) {
        die("Error al obtener las variables POST. " . $e->getMessage());
    }
    
}
    


