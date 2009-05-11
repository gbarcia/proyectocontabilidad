<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/utilidades/TransaccionBD.class.php';

require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
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

    function registrarUND ($monto) {
        $resultado = false;
        $query = "UPDATE REGISTRO SET haber = $monto
                  WHERE ASIENTO_num = 12 AND CUENTA_num = 9";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function registrarGananciasPerdidas ($monto) {
        $resultado = false;
        $query = "UPDATE REGISTRO SET haber = $monto
                  WHERE ASIENTO_num = 11 AND CUENTA_num = 8";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarLibroMayor () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe , SUM(r.haber) haber , c.nombre,c.num,c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num = c.num
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.tipo";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarActivosPasivos () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe , SUM(r.haber) haber , c.nombre,c.num,c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num = c.num and c.tipo in ('A', 'P')
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.nombre";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarActivoDepreciable ($subcadena) {
        $resultado = false;
        $subcadena .= "%";
        $query = "SELECT c.nombre, r.debe
                  FROM cuenta c, registro r
                  WHERE c.num = r.CUENTA_num AND c.nombre like '$subcadena'";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarIngresos ($fechaInicio, $fechaFin) {
        $resultado = false;
        $query = "SELECT v.fecha, v.costo_unitario, v.cantidad, c.nombre
        FROM REGISTRO r, VENTA v, CUENTA c
        WHERE v.id = r.VENTA_id AND r.CUENTA_num = c.num
        AND v.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarSumaIngresos () {
        $resultado = false;
        $query = "SELECT SUM(r.haber) haber FROM REGISTRO r, VENTA v
                  WHERE v.id = r.VENTA_id";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarCostosVenta ($nombreCuentas) {
        $resultado = false;

        $query = "SELECT r.debe, r.haber, c.nombre, c.num, c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num = c.num AND c.nombre IN (";
        for ($i = 0; $i < count($nombreCuentas)-1; $i++) {
            $nombre = "'COSTO ".$nombreCuentas[$i];
            $query .= "$nombre', ";
        }
        $nombre = "'COSTO ".$nombreCuentas[count($nombreCuentas)-1];
        $query .= "$nombre')
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.nombre";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarGastos () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe , SUM(r.haber) haber , c.nombre,c.num,c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num = c.num and c.tipo = 'E'
                        and c.nombre not like 'COMPRA%' and c.nombre not like 'COSTO VENTA%'
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.nombre";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarEgresos () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe , SUM(r.haber) haber , c.nombre,c.num,c.tipo
                  FROM REGISTRO r, CUENTA c
                  WHERE r.CUENTA_num = c.num and c.tipo = 'E'
                        and c.nombre not like 'COMPRA%'
                  GROUP BY c.num HAVING debe >= 0
                  ORDER BY c.nombre";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }

    function consultarSumaEgresos () {
        $resultado = false;
        $query = "SELECT SUM(r.debe) debe FROM REGISTRO r, CUENTA c
                  WHERE c.num = r.CUENTA_num AND c.tipo = 'E' AND c.nombre NOT LIKE 'COMPRA%'";
        $resultado = $this->transaccion->realizarTransaccion($query);
        return $resultado;
    }
}
?>
