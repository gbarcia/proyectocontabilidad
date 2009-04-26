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

    }

    function obtenerTodosLosClientes() {

    }

    function obtenerTodosLosProductos () {
        
    }
}
?>
