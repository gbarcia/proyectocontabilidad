<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/logica/generarEdoResultados.php';

function mostrarer ($datos) {
    $objResponse = new xajaxResponse();
    $er = new EstadoResultados();
    $resultado = $er->mostrarEdoResultados($datos[fechaInicio], $datos[fechaFin]);
    $objResponse->addAssign("librod", "innerHTML", $resultado);
    return $objResponse;
}

?>
