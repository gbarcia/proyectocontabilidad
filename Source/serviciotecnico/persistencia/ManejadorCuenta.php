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

    function consultarLibroMayor () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe , SUM(r.haber) haber , c.nombre,c.num,c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num =c.num
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.tipo ";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
