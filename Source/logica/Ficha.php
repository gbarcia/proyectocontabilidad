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
    <table align = "center" border = "2" cellpadding = "2" cellspacing = "2">
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
        require_once("../serviciotecnico/utilidades/Conexion.class.php");

        class Inventario {

            private $consultaFechasCompras;
            private $consultaFechasVentas;
            private $fechasCompras;
            private $fechasVentas;

            function __construct(){
                $this->consultaFechasCompras = "select fecha from compra order by fecha";
                $this->consultaFechasVentas = "select fecha from venta order by fecha";
            }

            function compras(){
                $transaccion = new TransaccionBDclass();

                $resultadoFechasCompras = $transaccion->realizarTransaccion($this->consultaFechasCompras);

                while ($row = mysql_fetch_array($resultadoFechasCompras)){
                    $this->fechasCompras[] = $row["fecha"];
                }
            }

            function ventas(){
                $transaccion = new TransaccionBDclass();

                $resultadoFechasVentas = $transaccion->realizarTransaccion($this->consultaFechasVentas);

                while ($row = mysql_fetch_array($resultadoFechasVentas)){
                    $this->fechasVentas[] = $row["fecha"];
                }
            }

            function mostrarFicha(){
                $this->compras();
                $this->ventas();

                $transaccion = new TransaccionBDclass();
                
                $cantidad = 0;        //Aquí van
                $costoUnitario = 0;   //los valores del
                $total = 0;           //inventario inicial

                $i = 0;
                $j = 0;
                $flagCompras = true;
                $flagVentas = true;

                while (($i < count($this->fechasCompras)) || ($j < count($this->fechasVentas))) {

                    
                    if ((!$flagVentas) || ($this->fechasCompras[$i] <= $this->fechasVentas[$j])) {
                        
                        $fecha = $this->fechasCompras[$i];

                        $consultaCompras = "select fecha, costo_unitario, cantidad from compra where fecha = '$fecha'";

                        $resultadoCompras = $transaccion->realizarTransaccion($consultaCompras);

                        /*
                         * Colocando valores en ENTRADAS y EXISTENCIAS
                         */

                        while ($compras = mysql_fetch_array($resultadoCompras)) {

                            $costoUnitario = ($total + ($compras["cantidad"] * $compras["costo_unitario"]))/($cantidad + $compras["cantidad"]);
                            $cantidad += $compras["cantidad"];
                            $total += ($compras["cantidad"] * $compras["costo_unitario"]);

                            printf("<tr align = 'center'>
                                        <td>%s</td>
                                        <td>compra</td>
                                        <td>%d</td>
                                        <td>%f</td>
                                        <td>%d</td>
                                        <td colspan = '3'></td>
                                        <td>%d</td>
                                        <td>%f</td>
                                        <td>%d</td>
                                    </tr>",
                                
                                $compras["fecha"],
                                $compras["cantidad"],
                                round($compras["costo_unitario"]*100)/100,
                                round($compras["cantidad"] * $compras["costo_unitario"]),
                                $cantidad, round($costoUnitario*100)/100, round($total));

                            $i++;

                            if ($i >= count($this->fechasCompras)){
                                $flagCompras = false;
                            }
                        }
                    }
                    
                    elseif ((!$flagCompras) || (($this->fechasCompras[$i] > $this->fechasVentas[$j]))) {

                        $fecha = $this->fechasVentas[$j];

                        $consultaVentas = "select * from venta where fecha = $fecha";

                        $resultadoVentas = $transaccion->realizarTransaccion($consultaVentas);

                        /*
                         * Colocando valores en SALIDAS y EXISTENCIAS
                         */

                        while ($ventas = mysql_fetch_array($resultadoVentas)) {

                            $cantidad -= $ventas["cantidad"];
                            $total -= ($ventas["cantidad"] * $costoUnitario);

                            printf("<tr align = 'center'>
                                        <td>%s</td>
                                        <td>venta</td>
                                        <td colspan = '3'></td>
                                        <td>%d</td>
                                        <td>%f</td>
                                        <td>%d</td>
                                        <td>%d</td>
                                        <td>%f</td>
                                        <td>%d</td>
                                    </tr>",

                                $ventas["fecha"],
                                $ventas["cantidad"], round($costoUnitario*100)/100,
                                round($ventas["cantidad"] * $costoUnitario),
                                $cantidad, round($costoUnitario*100)/100, round($total));

                            $j++;

                            if ($j >= count($this->fechasVentas)){
                                $flagVentas = false;
                            }
                        }
                    }
                }
            }
        }
    ?>
    </table>
  </body>
</html>
