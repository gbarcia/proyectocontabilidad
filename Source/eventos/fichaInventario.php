<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/logica/Ficha.php';

function mostrarFichaInventario ($nombreProducto) {
    $objResponse = new xajaxResponse();
    $ficha = new Inventario();
    $resultado = $ficha->mostrarFicha($nombreProducto,false);
    $objResponse->addAssign("control", "innerHTML", $resultado);
    return $objResponse;
}


?>
