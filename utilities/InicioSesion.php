<?php
/**
 * @author Dibier
 */

 namespace InicioSesion;

 require_once __DIR__ . "/../autoload.php";


 function iniciar() {
    // Inicia sesión
    try {
        session_start();
        $usuario = $_SESSION['user'];
        identificar($usuario);
        verificarAcceso($usuario);

        return obtenerVariablesPost();
    } catch (Exception $e) {
        die("Error al iniciar sesión. " . $e->getMessage());
    }
    
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
            throw new Exception("No tiene acceso a este recurso.");
        }
    } catch (Exception $e) {
        throw new Exception("No es posible verificar acceso. " . $e->getMessage());
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
    } catch (Exception $e) {
        die("Error al obtener las variables post. " . $e->getMessage());
    }
    
}
    


