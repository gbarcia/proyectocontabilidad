<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/logica/ControlAcceso.php';

function IniciarSession ($datos) {
    $resultado = false;
    $controlAcceso = new ControlAcceso($datos[clave],$datos[usuario]);
    $resultado = $controlAcceso->validarUsuario();
    $objResponse = new xajaxResponse();
    if ($resultado){
        $objResponse->addRedirect('presentacion/home.php');
    }
    else {
        $objResponse->addAssign("mensaje", "innerHTML", "Acceso no autorizado");
    }
    return $objResponse;
}
?>
