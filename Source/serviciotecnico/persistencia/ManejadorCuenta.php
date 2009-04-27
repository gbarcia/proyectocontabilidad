<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/utilidades/TransaccionBD.class.php';

/**
 * Description of ManejadorCuenta
 *
 * @author gerardobarcia
 */
class ManejadorCuenta {
    private $transaccion;

    function __construct() {
        $this->transaccion = new TransaccionBDclass();
    }

    function registrarNuevaCuenta ($tipo, $nombre, $descripcion) {
        $resultado = false;
        $query = "INSERT INTO CUENTA VALUES (NULL,'".$tipo."','".$nombre."','".$descripcion."')";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
