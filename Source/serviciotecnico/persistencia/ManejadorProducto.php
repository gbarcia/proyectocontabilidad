<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/utilidades/TransaccionBD.class.php';

require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
/**
 * Description of ManejadorHome
 *
 * @author gerardobarcia
 */
class ManejadorProducto {

    private $transaccion;

    function __construct() {
        $this->transaccion = new TransaccionBDclass();
    }

    function obtenerIdProducto ($nombreProducto) {
        $resultado = false;
        $query = "SELECT id FROM producto
                  WHERE nombre = '$nombreProducto'";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
