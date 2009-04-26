<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/utilidades/TransaccionBD.class.php';
/**
 * Description of ManejadorAsiento
 *
 * @author gerardobarcia
 */
class ManejadorAsiento {
    private $transaccion;

    function __construct() {
        $this->transaccion = new TransaccionBDclass();
    }

    function obtenerTodosLosProveedores () {
        $resultado = false;
        $query = "SELECT * FROM PROVEEDOR";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function obtenerTodosLosClientes() {
        $resultado = false;
        $query = "SELECT * FROM CLIENTE";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function obtenerTodosLosProductos () {
        $resultado = false;
        $query = "SELECT * FROM PRODUCTO";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function obtenerTodasLasCuentas () {
        $resultado = false;
        $query = "SELECT * FROM CUENTA";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
