<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <h1 align = "center"><b>FICHA&nbsp;DE&nbsp;INVENTARIO</b></h1><br><br><br>
    <table align = "center" border = "3">
        <tr align = "center">
            <th><font size = "2" face = "Garamond, Comic Sans MS, Arial">FECHA</font></th>
            <th><font size = "2" face = "Garamond, Comic Sans MS, Arial">DESCRIPCI&Oacute;N</font></th>
            <th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">ENTRADAS</font></th>
            <th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">SALIDAS</font></th>
            <th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">EXISTENCIAS</font></th>
        </tr>
        <tr align = "center">
            <td colspan = "2"></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>
            <td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>
        </tr>
    <?php
        require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");

        class Inventario {

            private $consultaCompras;
            private $consultaVentas;

            function __construct(){
                $this->consultaCompras = "select fecha, costo_unitario, cantidad from compra order by fecha";
                $this->consultaVentas = "select fecha, costo_unitario, cantidad from venta order by fecha";
            }

            function mostrarFicha(){
                $transaccion = new TransaccionBDclass();

                $resultadoCompras = $transaccion->realizarTransaccion($this->consultaCompras);
                $resultadoVentas = $transaccion->realizarTransaccion($this->consultaVentas);

                $cantidadUltima = 1;
                $costoUnitarioUltimo = 1;
                $totalUltimo = 1;

                while (($compras = mysql_fetch_array($resultadoCompras)) ||
                            ($ventas = mysql_fetch_array($resultadoVentas))) {

                    if (strtotime($compras["fecha"]) <= strtotime($ventas["fecha"])){
                        
                        /*
                         * Colocando valores en ENTRADAS y EXISTENCIAS
                         */

                        printf("<tr align = 'center'>
                                    <td>%s</td>
                                    <td>compra</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%f</td>
                                    <td colspan = '3'></td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%f</td>
                                </tr>",
                            $compras["fecha"],
                            $compras["cantidad"], $compras["costo_unitario"],
                            $compras["cantidad"] * $compras["costo_unitario"],
                            $cantidadUltima + $compras["cantidad"],
                            ($totalUltimo + ($compras["cantidad"] * $compras["costo_unitario"]))/($cantidadUltima + $compras["cantidad"]),
                            $totalUltimo + ($compras["cantidad"] * $compras["costo_unitario"]));

                        /*
                         * Actualizando útlimos valores del inventario
                        */

                        $costoUnitarioUltimo = ($totalUltimo + ($compras["cantidad"] * $compras["costo_unitario"]))/($cantidadUltima + $compras["cantidad"]);
                        $cantidadUltima += $compras["cantidad"];
                        $totalUltimo += $compras["cantidad"] * $compras["costo_unitario"];
                    }
                    
                    elseif (strtotime($ventas["fecha"]) < strtotime($compras["fecha"])){

                        /*
                         * Colocando valores en SALIDAS y EXISTENCIAS
                         */

                        printf("<tr align = 'center'>
                                    <td>%s</td>
                                    <td>venta</td>
                                    <td colspan = '3'></td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%f</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%f</td>
                                </tr>",
                            $ventas["fecha"],
                            $ventas["cantidad"], $costoUnitarioUltimo,
                            $ventas["cantidad"] * $costoUnitarioUltimo,
                            $cantidadUltima - $ventas["cantidad"],
                            ($totalUltimo - ($ventas["cantidad"] * $costoUnitarioUltimo))/($cantidadUltima - $ventas["cantidad"]),
                            $totalUltimo - ($ventas["cantidad"] * $costoUnitarioUltimo));

                        /*
                         * Actualizando útlimos valores del inventario
                        */

                        $cantidadUltima -= $ventas["cantidad"];
                        $totalUltimo -= $compras["cantidad"] * $costoUnitarioUltimo;
                    }
                }
            }
        }
    ?>
    </table>
  </body>
</html>
