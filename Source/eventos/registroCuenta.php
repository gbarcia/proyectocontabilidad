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

function mostrarLibroMayor() {
    $objResponse = new xajaxResponse();
    $controlCuenta = new ManejadorCuenta();
    $recurso = $controlCuenta->consultarLibroMayor();
    $resultado = '<table cellspacing="0" class="scrollTable">';
    $resultado.= '<thead>';
    $resultado.= '<tr>';
    $resultado.= '<th>NUM</th>';
    $resultado.= '<th>NOMBRE</th>';
    $resultado.= '<th>DEBE</th>';
    $resultado.= '<th>HABER</th>';
    $resultado.= '<th>TOTAL</th>';
    $resultado.= '</tr>';
    $resultado.= '</thead>';
    while ($row = mysql_fetch_array($recurso)) {
        $total = 0;
        if ($row[tipo] == 'A' || $row[tipo] == 'E'){
            $total = $row[debe] - $row[haber];
        }
        else {
            $total = $row[haber] - $row[debe];
        }
        $resultado.= '<td>' . $row[num]. '</td>';
        $resultado.= '<td>' . $row[nombre]. '</td>';
        $resultado.= '<td>' . $row[debe]. '</td>';
        $resultado.= '<td>' . $row[haber]. '</td>';
        $resultado.= '<td>' . $total. '</td>';
        $resultado.= '</tr>';
    }
    $resultado.= '</table>';
    $objResponse->addAssign("librom", "innerHTML", $resultado);
    return $objResponse;
}

?>
