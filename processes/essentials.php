<?php

/**
 * Regresa la respuesta a Ajax.
 * Se creó para evitar reiteración de código.
 * @param bool $success Un booleano que representa el exito o no de la operación.
 * @param string|array $mensaje El mensaje de salida que se le mostrará al usuario.
 */
function return_response($success, $mensaje){
    $response['success'] = $success;
    $response['mensaje'] = $mensaje;
    $jsonResponse = json_encode($response);
    header('Content-Type: application/json');
    exit($jsonResponse);
}

?>