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
            private $inventarioFinal;

            function __construct(){
                $this->manejadorHome = new ManejadorHome();
                $this->manejadorProducto = new ManejadorProducto();
            }

            function mostrarFicha($nombreProducto, $flagImpresion) {
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

                $i = 0;
                $j = 0;
                $flag = true;
                while ($flag == true) {
                    $impresionEncabezado = '<h3 align = "center"><b>FICHA&nbsp;DE&nbsp;INVENTARIO '.$nombreProducto.'</b></h3><br><br>';
                    $impresionEncabezado .= '<table align = "center" border = "2" cellpadding = "4" cellspacing = "2">';
                    $impresionEncabezado .= '<thead>';
                    $impresionEncabezado .= '<tr align = "center">';
                    $impresionEncabezado .= '<th><font size = "2" face = "Garamond, Comic Sans MS, Arial">FECHA</font></th>';
                    $impresionEncabezado .= '<th><font size = "2" face = "Garamond, Comic Sans MS, Arial">DESCRIPCI&Oacute;N</font></th>';
                    $impresionEncabezado .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">ENTRADAS</font></th>';
                    $impresionEncabezado .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">SALIDAS</font></th>';
                    $impresionEncabezado .= '<th colspan = "3"><font size = "2" face = "Garamond, Comic Sans MS, Arial">EXISTENCIAS</font></th>';
                    $impresionEncabezado .= '</tr>';
                    $impresionEncabezado .= '<tr align = "center">';
                    $impresionEncabezado .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresionEncabezado .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">CANTIDAD</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">COSTO&nbsp;UNITARIO</font></i></td>';
                    $impresionEncabezado .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">TOTAL</font></i></td>';
                    $impresionEncabezado .= '</tr>';
                    $impresionEncabezado .= '</thead>';

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

                    if ($comp == 1) {
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
                            $impresion .= '<td>compra</td>';
                            $impresion .= '<td>'.$rowC[cantidad].'</td>';
                            $cu = round($rowC[costo_unitario]*100)/100;
                            $impresion .= '<td>'.$cu.'</td>';
                            $tot = round($rowC[cantidad] * $rowC[costo_unitario]);
                            $impresion .= '<td>'.$tot.'</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>'.$cantidad.'</td>';
                            $cUnitario = round($costoUnitario*100)/100;
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            $redTotal = round($total);
                            $impresion .= '<td>'.$redTotal.'</td>';
                            $this->setInventarioFinal($redTotal);
                            $impresion .= '</tr>';
                         }

                         $i++;
                         
                    }
                    else if ($comp == 0) {
                        $consultaVentasPorFecha = $this->manejadorHome->obtenerTodasLasVentasPorFecha($fechasVentas[$j]);
                        /*
                         * Colocando valores en SALIDAS y EXISTENCIAS
                         */
                         while ($rowV = mysql_fetch_array($consultaVentasPorFecha)) {
                            $cantidad -= $rowV[cantidad];
                            $total -= ($rowV[cantidad] * $costoUnitario);

                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td>'.$rowV[fecha].'</td>';
                            $impresion .= '<td>venta</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>'.$rowV[cantidad].'</td>';
                            $cUnitario = round($costoUnitario*100)/100;
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            $tot = round($rowV[cantidad] * $costoUnitario);
                            $impresion .= '<td>'.$tot.'</td>';
                            $impresion .= '<td>'.$cantidad.'</td>';
                            $impresion .= '<td>'.$cUnitario.'</td>';
                            $redTotal = round($total);
                            $impresion .= '<td>'.$redTotal.'</td>';
                            $this->setInventarioFinal($redTotal);
                            $impresion .= '</tr>';
                        }

                        $j++;
                        
                    }
                    else if ($comp == -1) {
                        $flag = false;
                    }
                }
                
                $impresion .= '</table>';

                if ($flagImpresion == true) {
                    echo $impresionEncabezado.$impresion;
                }
            }

            function setInventarioFinal($inventario){
                $this->inventarioFinal = $inventario;
            }

            function getInventarioFinal(){
                return $this->inventarioFinal;
            }
        }
    ?>
  </body>
</html>
