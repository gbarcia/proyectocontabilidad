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
    <h1 align = "center"><b>FICHA&nbsp;DE&nbsp;INVENTARIO</b></h1><br><br>
    <table align = "center" border = "2" cellpadding = "2" cellspacing = "2">
        <thead>
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
        </thead>
    <?php
        require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");

        class Inventario {

            private $consultaCompras;
            private $consultaVentas;
            private $consultaContCompras;
            private $consultaContVentas;

            function __construct(){
                $transaccion = new TransaccionBDclass();

                $this->consultaCompras = $transaccion->realizarTransaccion("select * from compra");
                $this->consultaVentas = $transaccion->realizarTransaccion("select * from venta");

                $this->consultaContCompras = $transaccion->realizarTransaccion("select count(*) from compra");
                $this->consultaContVentas = $transaccion->realizarTransaccion("select count(*) from venta");
            }

            function mostrarFicha(){
                $cantidad = 0;        //Aquí van
                $costoUnitario = 0;   //los valores del
                $total = 0;           //inventario inicial

                $contCompras = mysql_result($this->consultaContCompras, 0, 0);
                $contVentas = mysql_result($this->consultaContVentas, 0, 0);

                while (($rowCompras = mysql_fetch_array($this->consultaCompras))
                        | ($rowVentas = mysql_fetch_array($this->consultaVentas))) {

                    echo "<br>Fecha compra: ".$rowCompras[fecha]." ";
                    echo "Fecha venta: ".$rowVentas[fecha]."<br>";

                    if ($rowCompras[fecha] <= $rowVentas[fecha]) {

                        /*
                         * Colocando valores en ENTRADAS y EXISTENCIAS
                         */

                         $costoUnitario = ($total + ($rowCompras[cantidad] * $rowCompras[costo_unitario]))/($cantidad + $rowCompras[cantidad]);
                         $cantidad += $rowCompras[cantidad];
                         $total += ($rowCompras[cantidad] * $rowCompras[costo_unitario]);

                         printf("<tr align = 'center'>
                                    <td>%s</td>
                                    <td>compra</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%d</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%d</td>
                                 </tr>",

                            $rowCompras[fecha],
                            $rowCompras[cantidad],
                            round($rowCompras[costo_unitario]*100)/100,
                            round($rowCompras[cantidad] * $rowCompras[costo_unitario]),
                            $cantidad, round($costoUnitario*100)/100, round($total));
                    }
                    else {
                        
                        /*
                         * Colocando valores en SALIDAS y EXISTENCIAS
                         */

                         $cantidad -= $rowVentas[cantidad];
                         $total -= ($rowVentas[cantidad] * $costoUnitario);

                         printf("<tr align = 'center'>
                                    <td>%s</td>
                                    <td>venta</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%d</td>
                                    <td>%d</td>
                                    <td>%f</td>
                                    <td>%d</td>
                                </tr>",

                            $rowVentas[fecha],
                            $rowVentas[cantidad], round($costoUnitario*100)/100,
                            round($rowVentas[cantidad] * $costoUnitario),
                            $cantidad, round($costoUnitario*100)/100, round($total));
                    }
                }
            }
        }
    ?>
    </table>
  </body>
</html>
