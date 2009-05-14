<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/logica/generarBalanceGeneral.php';

function mostrarBalance () {
    $objResponse = new xajaxResponse();
    $balance = new Balance();
    $resultado = $balance->mostrarBalance();
    $objResponse->addAssign("librom", "innerHTML", $resultado);
    return $objResponse;
}

?>
