<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/persistencia/ManejadorCuenta.php';

function nuevaCuenta ($datos) {
$objResponse = new xajaxResponse();
$controlCuenta = new ManejadorCuenta();
$resultado = $controlCuenta->registrarNuevaCuenta($datos[select], $datos[nombre], $datos[des]);
if ($resultado)
$objResponse->addAlert("Nueva Cuenta registrada con exito");
else
$objResponse->addAlert("Error: La cuenta ya existe");
return $objResponse;
}
?>
