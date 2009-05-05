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
    <?php
        require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
        require_once("../serviciotecnico/persistencia/ManejadorHome.php");
        require_once("../serviciotecnico/persistencia/ManejadorProducto.php");

        class Inventario {

            private $manejadorHome;
            private $manejadorProducto;

            function __construct(){
                $this->manejadorHome = new ManejadorHome();
                $this->manejadorProducto = new ManejadorProducto();
            }

            function mostrarFicha($nombreProducto) {
                $cantidad = 0;        //Aquí van
                $costoUnitario = 0;   //los valores del
                $total = 0;           //inventario inicial

                $consultaIdProducto = $this->manejadorProducto->obtenerIdProducto($nombreProducto);

                $idProducto = mysql_result($consultaIdProducto, 0, 0);

                $consultaCompras = $this->manejadorHome->obtenerTodasLasComprasPorIdProducto($idProducto);
                $consultaVentas = $this->manejadorHome->obtenerTodasLasVentasPorIdProducto($idProducto);

                $i = 0;
                while ($rowCompras = mysql_fetch_array($consultaCompras)) {
                    $fechasCompras[$i] = $rowCompras[fecha]; $i++;
                }

                $j = 0;
                while ($rowVentas = mysql_fetch_array($consultaVentas)) {
                    $fechasVentas[$j] = $rowVentas[fecha]; $j++;
                }

                /*for ($j = 0; $j < count($fechasVentas); $j++) {
                    $consultaVentasPorFecha = $this->manejadorHome->obtenerTodasLasVentasPorFecha($fechasVentas[$j]);

                    while ($rowV = mysql_fetch_array($consultaVentasPorFecha)) {
                        echo "Fecha venta: ".$rowV[fecha]." ";
                        echo "Costo unitario: ".$rowV[costo_unitario]." ";
                        echo "Cantidad: ".$rowV[cantidad]."<br>";
                    }
                }

                echo "<br>";
                for ($i = 0; $i < count($fechasCompras); $i++) {
                    $consultaComprasPorFecha = $this->manejadorHome->obtenerTodasLasComprasPorFecha($fechasCompras[$i]);

                    while ($rowC = mysql_fetch_array($consultaComprasPorFecha)) {
                        echo "Fecha compra: ".$rowC[fecha]." ";
                        echo "Costo unitario: ".$rowC[costo_unitario]." ";
                        echo "Cantidad: ".$rowC[cantidad]."<br>";
                    }
                }*/

                $i = 0;
                $j = 0;
                $flag = true;
                while ($flag == true) {
                    $impresion = '<h1 align = "center"><b>FICHA&nbsp;DE&nbsp;INVENTARIO</b></h1><br><br>';
                    $impresion .= '<table align = "center" border = "2" cellpadding = "2" cellspacing = "2">';
                    $impresion .= '<thead>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<th><font size = "2" face = "Garamond, Comic Sans MS, Arial">FECHA</font></th>';
                    $impresion .= '<th><font size = "2" face = "Garamond, Comic Sans MS, Arial">DESCRIPCI&Oacute;N</font></th>';
                    $impresion .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">ENTRADAS</font></th>';
                    $impresion .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">SALIDAS</font></th>';
                    $impresion .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">EXISTENCIAS</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresion .= '</tr>';
                    $impresion .= '</thead>';

                    if (($i < count($fechasCompras)) && ($j < count($fechasVentas))) {
                        if ($fechasCompras[$i] <= $fechasVentas[$j]) {
                            $comp = 1;
                        }
                        else {
                            $comp = 0;
                        }
                    }
                    else if (($i == count($fechasCompras)) && ($j == count($fechasVentas))) {
                        $comp = -1;
                        $i++;
                        $j++;
                    }
                    else if ($i == count($fechasCompras)) {
                        $comp = 0;
                    }
                    else if ($j == count($fechasVentas)) {
                        $comp = 1;
                    }

/****************************** BIEN HASTA AQUÍ ******************************/

                    if ($comp == 1) {
                        //echo "<br>Fecha compra: ".$fechasCompras[$i]."<br>";
                        
                        $consultaComprasPorFecha = $this->manejadorHome->obtenerTodasLasComprasPorFecha($fechasCompras[$i]);
                        /*
                         * Colocando valores en ENTRADAS y EXISTENCIAS
                         */
                         while ($rowC = mysql_fetch_array($consultaComprasPorFecha)) {
                            $costoUnitario = ($total + ($rowC[cantidad] * $rowC[costo_unitario]))/($cantidad + $rowC[cantidad]);
                            $cantidad += $rowC[cantidad];
                            $total += ($rowC[cantidad] * $rowC[costo_unitario]);

                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td>'.$rowC[fecha].'</td>';
                            echo $rowC[fecha]." ";
                            $impresion .= '<td>compra</td>';
                            echo "compra ";
                            $impresion .= '<td>'.$rowC[cantidad].'</td>';
                            echo $rowC[cantidad]." ";
                            $cu = round($rowC[costo_unitario]*100)/100;
                            $impresion .= '<td>'.$cu.'</td>';
                            echo $cu." ";
                            $tot = round($rowC[cantidad] * $rowC[costo_unitario]);
                            $impresion .= '<td>'.$tot.'</td>';
                            echo $tot." ";
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>'.$cantidad.'</td>';
                            echo $cantidad." ";
                            $cUnitario = round($costoUnitario*100)/100;
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            echo $cUnitario." ";
                            $redTotal = round($total);
                            $impresion .= '<td>'.$redTotal.'</td>';
                            echo $redTotal."<br><br>";
                            $impresion .= '</tr>';
                         }

                         $i++;
                         
                    }
                    else if ($comp == 0) {
                        //echo "<br>Fecha venta: ".$fechasVentas[$j]."<br>";
                        
                        $consultaVentasPorFecha = $this->manejadorHome->obtenerTodasLasVentasPorFecha($fechasVentas[$j]);
                        /*
                         * Colocando valores en SALIDAS y EXISTENCIAS
                         */
                         while ($rowV = mysql_fetch_array($consultaVentasPorFecha)) {
                            $cantidad -= $rowV[cantidad];
                            $total -= ($rowV[cantidad] * $costoUnitario);

                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td>'.$rowV[fecha].'</td>';
                            echo $rowV[fecha]." ";
                            $impresion .= '<td>venta</td>';
                            echo "venta ";
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>'.$rowV[cantidad].'</td>';
                            echo $rowV[cantidad]." ";
                            $cUnitario = round($costoUnitario*100)/100;
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            echo $cUnitario." ";
                            $tot = round($rowV[cantidad] * $costoUnitario);
                            $impresion .= '<td>'.$tot.'</td>';
                            echo $tot." ";
                            $impresion .= '<td>'.$cantidad.'</td>';
                            echo $cantidad." ";
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            echo $cUnitario." ";
                            $redTotal = round($total);
                            $impresion .= '<td>'.$redTotal.'</td>';
                            echo $redTotal."<br><br>";
                            $impresion .= '</tr>';
                        }

                        $j++;
                        
                    }
                    else if ($comp == -1) {
                        echo "No hay más compras ni ventas";
                        $flag = false;
                    }
                }
                
                $impresion .= '</table>';

                printf($impresion);
            }
        }
    ?>
  </body>
</html>
