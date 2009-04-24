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
                $this->consultaCompras = "select * from compra order by fecha";
                $this->consultaVentas = "select * from venta order by fecha";
            }

            function mostrarFicha(){
                $compras = $this->realizarTransaccion($this->consultaCompras);
                $ventas = $this->realizarTransaccion($this->consultaVentas);

                echo $compras["costo_unitario"];
            }
        }
    ?>
    </table>
  </body>
</html>
