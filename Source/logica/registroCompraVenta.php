<?php
    require_once $_SERVER['DOCUMENT_ROOT']. '/com.contabilidad.prj/serviciotecnico/utilidades/TransaccionBD.class.php';

    $idProducto = $_POST[idProducto];
    $rif = $_POST[rif];
    $fecha = $_POST[fecha];
    $costoUnitario = $_POST[costoUnitario];
    $cantidad = $_POST[cantidad];
    $tipo = $_POST[tipo];

    if ($tipo == "compra") {
        $compra = new Insercion($idProducto, $rif, $fecha, $costoUnitario, $cantidad);

        $compra->realizarCompra($idProducto, $rif, $fecha, $costoUnitario, $cantidad);
    }
    else if ($tipo == "venta") {
        $venta = new Insercion($rif, $idProducto, $fecha, $costoUnitario, $cantidad);

        $venta->realizarVenta($rif, $idProducto, $fecha, $costoUnitario, $cantidad);
    }
?>
