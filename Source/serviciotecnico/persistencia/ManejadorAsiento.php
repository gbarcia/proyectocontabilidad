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

      function agregarAsiento ($fecha) {
        $resultado = false;
        $query = "INSERT INTO ASIENTO VALUES (NULL,'".$fecha."')";
        $resultado = $this->transaccion->realizarTransaccionInsertId($query);
        return $resultado;
    }

    function agregarRegistro ($idAsiento, $numCuenta,$debe,$haber,$tipo) {
        $resultado = false;
        $query = "INSERT INTO REGISTRO VALUES ($idAsiento,$numCuenta,$debe,$haber,
                  NULL,NULL,NULL,NULL,NULL,NULL,'".$tipo."')";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
