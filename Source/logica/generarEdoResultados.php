<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
        <?php
            require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
            require_once("../serviciotecnico/persistencia/ManejadorCuenta.php");
            
            class EstadoResultados {

                private $transaccion;

                function __construct(){
                    $this->transaccion = new TransaccionBDclass();
                }

                function mostrarEdoResultados($fechaInicio, $fechaFin){

                    $manejador = new ManejadorCuenta();

                    $resultadoIngresos = $manejador->consultarIngresos($fechaInicio, $fechaFin);
                    $resultadoGastos = $manejador->consultarGastos();

                    $impresion = '<h3 align = "center"><b>ESTADO&nbsp;DE&nbsp;RESULTADOS&nbsp;EDUGER,&nbsp;C.&nbsp;A.</b></h3><br><br>';
                    $impresion .= '<table align = "center" border = "2" cellpadding = "4" cellspacing = "2">';
                    $impresion .= '<thead>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">C&iacute;a&nbsp;EDUGER,&nbsp;C.&nbsp;A.</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr>';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">Estado&nbsp;de&nbsp;resultados&nbsp;(Bs.)</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr>';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">del&nbsp;'.$fechaInicio.'&nbsp;al&nbsp;'.$fechaFin.'</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '</thead>';
                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left" colspan = "3"><i><font size = "2" face = "Garamond, Comic Sans MS, Arial"><u>VENTAS</u></font></i></td>';
                    $impresion .= '</tr>';

                    $sumaVentas = 0;
                    $i = 0;
                    while ($row = mysql_fetch_array($resultadoIngresos)) {
                        $impresion .= '<tr>';
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[nombre].'</font></td>';
                        $monto = $row[costo_unitario] * $row[cantidad];
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                        $sumaVentas += $monto;
                        $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $impresion .= '</tr>';
                        $nombreCuentas[$i] = $row[nombre]; $i++;
                    }

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left"><font size = "2" face = "Garamond, Comic Sans MS, Arial"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;VENTAS</b></font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$sumaVentas.'</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left" colspan = "3"><i><font size = "2" face = "Garamond, Comic Sans MS, Arial"><u>COSTOS&nbsp;DE&nbsp;VENTA</u></font></i></td>';
                    $impresion .= '</tr>';

                    $resultadoCostosVenta = $manejador->consultarCostosVenta($nombreCuentas);

                    $sumaCostosVenta = 0;
                    while ($row = mysql_fetch_array($resultadoCostosVenta)) {
                        $impresion .= '<tr>';
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[nombre].'</font></td>';
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[debe].'</font></td>';
                        $sumaCostosVenta += $row[debe];
                        $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $impresion .= '</tr>';
                    }

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left"><font size = "2" face = "Garamond, Comic Sans MS, Arial"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;COSTOS&nbsp;DE&nbsp;VENTA</b></font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">('.$sumaCostosVenta.')</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left"><font size = "2" face = "Garamond, Comic Sans MS, Arial"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UTILIDAD&nbsp;BRUTA&nbsp;EN&nbsp;VENTAS</b></font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $utilidadVentas = $sumaVentas - $sumaCostosVenta;
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$utilidadVentas.'</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left" colspan = "3"><i><font size = "2" face = "Garamond, Comic Sans MS, Arial"><u>GASTOS&nbsp;DE&nbsp;VENTA&nbsp;Y&nbsp;ADMINISTRACI&Oacute;N</u></font></i></td>';
                    $impresion .= '</tr>';

                    $sumaGastos = 0;
                    while ($row = mysql_fetch_array($resultadoGastos)) {
                        $impresion .= '<tr>';
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[nombre].'</font></td>';
                        $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[debe].'</font></td>';
                        $sumaGastos += $row[debe];
                        $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                        $impresion .= '</tr>';
                    }

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left"><font size = "2" face = "Garamond, Comic Sans MS, Arial"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;GASTOS&nbsp;DE&nbsp;VENTA&nbsp;Y&nbsp;ADMINISTRACI&Oacute;N</b></font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">('.$sumaGastos.')</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '<tr>';
                    $impresion .= '<td align = "left"><font size = "2" face = "Garamond, Comic Sans MS, Arial"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UTILIDAD&nbsp;NETA&nbsp;EN&nbsp;OPERACIONES</b></font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $utilidadOperaciones = $utilidadVentas - $sumaGastos;
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$utilidadOperaciones.'</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '</table>';

                    return $impresion;
                }
            }
        ?>
  </body>
</html>