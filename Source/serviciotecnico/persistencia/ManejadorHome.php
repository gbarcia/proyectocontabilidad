<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/utilidades/TransaccionBD.class.php';


/**
 * Description of ManejadorHome
 *
 * @author gerardobarcia
 */
class ManejadorHome {

    private $transaccion;

    function __construct() {
        $this->transaccion = new TransaccionBDclass();
    }

    function obtenerTodasLasCompras () {
        $resultado = false;
        $query = "SELECT c.id, p.nombre nombreProducto , pr.nombre nombreProve, c.fecha,c.costo_unitario, c.cantidad
                  FROM COMPRA c, PRODUCTO p, PROVEEDOR pr
                  WHERE c.PRODUCTO_id = p.id
                  AND c.PROVEEDOR_rif = pr.rif
                  GROUP BY c.id
                  ORDER BY c.fecha LIMIT 10";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
