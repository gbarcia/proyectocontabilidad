<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/persistencia/ManejadorHome.php';

function mostrarCompras() {
    $objResponse = new xajaxResponse();
    $controlHome = new ManejadorHome();
    $recursoCompras = $controlHome->obtenerTodasLasCompras();
    $resultado = '<table cellspacing="0" class="" border="1">';
    $resultado.= '<thead>';
    $resultado.= '<tr>';
    $resultado.= '<th>FECHA</th>';
    $resultado.= '<th>PRODUCTO</th>';
    $resultado.= '<th>PROVEEDOR</th>';
    $resultado.= '<th>CU</th>';
    $resultado.= '<th>CANTIDAD</th>';
    $resultado.= '</tr>';
    $resultado.= '</thead>';
    while ($rowCompras = mysql_fetch_array($recursoCompras)) {
        $resultado.= '<td>' . $rowCompras[fecha]. '</td>';
        $resultado.= '<td>' . $rowCompras[nombreProducto]. '</td>';
        $resultado.= '<td>' . $rowCompras[nombreProve]. '</td>';
        $resultado.= '<td>' . $rowCompras[costo_unitario]. '</td>';
        $resultado.= '<td>' . $rowCompras[cantidad]. '</td>';
        $resultado.= '</tr>';
    }
    $resultado.= '</table>';
    $objResponse->addAssign("compras", "innerHTML", $resultado);
    return $objResponse;
}

function mostrarVentas() {
    $objResponse = new xajaxResponse();
    $controlHome = new ManejadorHome();
    $recursoCompras = $controlHome->obtenerTodasLasVentas();
    $resultado = '<table cellspacing="0" class="" border="1">';
    $resultado.= '<thead>';
    $resultado.= '<tr>';
    $resultado.= '<th>FECHA</th>';
    $resultado.= '<th>PRODUCTO</th>';
    $resultado.= '<th>CLIENTE</th>';
    $resultado.= '<th>CU</th>';
    $resultado.= '<th>CANTIDAD</th>';
    $resultado.= '</tr>';
    $resultado.= '</thead>';
    while ($rowCompras = mysql_fetch_array($recursoCompras)) {
        $resultado.= '<td>' . $rowCompras[fecha]. '</td>';
        $resultado.= '<td>' . $rowCompras[nombreProducto]. '</td>';
        $resultado.= '<td>' . $rowCompras[nombreCliente]. '</td>';
        $resultado.= '<td>' . $rowCompras[cu]. '</td>';
        $resultado.= '<td>' . $rowCompras[can]. '</td>';
        $resultado.= '</tr>';
    }
    $resultado.= '</table>';
    $objResponse->addAssign("ventas", "innerHTML", $resultado);
    return $objResponse;
}
?>
