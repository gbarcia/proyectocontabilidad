<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/com.contabilidad.prj/serviciotecnico/utilidades/TransaccionBD.class.class.php';

class Insercion {

    function realizarCompra($nombre, $costoUnitario) {
        $query = "insert into compra (nombre, costo_unitario) values 
            ('$nombre', $costoUnitario)";

        $this->realizarTransaccion($query);
    }

    function realizarVenta($rifCliente, $idProducto, $fecha, $costoUnitario, $cantidad) {
        $query = "insert into venta (CLIENTE_rif, PRODUCTO_id, fecha, costo_unitario, cantidad)
                     values ('$rifCliente', '$idProducto', '$fecha', $costoUnitario, $cantidad)";

        $this->realizarTransaccion($query);
    }
}
?>
