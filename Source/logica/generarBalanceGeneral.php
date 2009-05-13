<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
        <?php
            require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
            require_once("../serviciotecnico/persistencia/ManejadorCuenta.php");
            require_once("../presentacion/SpryAssets/InicializacionProcesosConcurrentesInterfaz.php");

            class Balance {

                private $transaccion;

                function __construct(){
                    $this->transaccion = new TransaccionBDclass();
                }

                function mostrarBalance(){

                    $manejador = new ManejadorCuenta();

                    $resultado = $manejador->consultarActivosPasivos();

                    $resultadoSumaIngresos = $manejador->consultarSumaIngresos();
                    $sumaIngresos = mysql_result($resultadoSumaIngresos, 0, 0);

                    $resultadoSumaEgresos = $manejador->consultarSumaEgresos();
                    $sumaEgresos = mysql_result($resultadoSumaEgresos, 0, 0);

                    $und = $sumaIngresos - $sumaEgresos;

                    $manejador->registrarUND($und);
                    $manejador->registrarGananciasPerdidas($und);

                    $impresion = '<h3 align = "center"><b>BALANCE&nbsp;GENERAL&nbsp;EDUGER,&nbsp;C.&nbsp;A.</b></h3><br><br>';
                    $impresion .= '<table align = "center" border = "2" cellpadding = "4" cellspacing = "2">';
                    $impresion .= '<thead>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">C&iacute;a&nbsp;EDUGER,&nbsp;C.&nbsp;A.</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr>';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">Balance&nbsp;general&nbsp;(Bs.)</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr>';
                    $fechaActual = date("d/m/Y");
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">al&nbsp;'.$fechaActual.'</font></th>';
                    $impresion .= '</tr>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<td colspan = "3"><i><font size = "2" face = "Garamond, Comic Sans MS, Arial"><u>ACTIVOS</u></font></i></td>';
                    $impresion .= '<td colspan = "3"><i><font size = "2" face = "Garamond, Comic Sans MS, Arial"><u>PASIVOS</u></font></i></td>';
                    $impresion .= '</tr>';
                    $impresion .= '</thead>';

                    $sumaActivos = 0;
                    $sumaPasivos = 0;
                    while ($row = mysql_fetch_array($resultado)) {

                        if ($row[tipo] == 'A') {
                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[nombre].'</font></td>';

                            if (($row[nombre] != "BANCO") && (substr($row[nombre], 0, 10) != "INVENTARIO") && (substr($row[nombre], 0, 18) != "CUENTAS POR COBRAR")) {
                                if (substr($row[nombre], 0, 8) == "DEP ACUM") {
                                    $monto = $row[debe] - $row[haber];                                    
                                    $monto *= -1;
                                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">('.$monto.')</font></td>';
                                    $subcadena = substr($row[nombre], 9, 3);
                                    $resultadoActivoDepreciable = $manejador->consultarActivoDepreciable($subcadena);
                                    $rowA = mysql_fetch_array($resultadoActivoDepreciable);
                                    $totalActivoDepreciable = $rowA[debe] - $monto;
                                    $sumaActivos += $totalActivoDepreciable;
                                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$totalActivoDepreciable.'</font></td>';
                                }
                                else {
                                    $monto = $row[debe] - $row[haber];
                                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                                }
                            }
                            else {
                                $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                                $monto = $row[debe] - $row[haber];
                                $sumaActivos += $monto;
                                $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            }
                            
                            $ultimoTipoCuenta = 'A';
                        }
                        elseif (($ultimoTipoCuenta == 'A') && ($row[nombre] != "GANANCIAS Y PERDIDAS")) {
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[nombre].'</font></td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $monto = $row[haber] - $row[debe];
                            $sumaPasivos += $monto;
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            $impresion .= '</tr>';
                            $ultimoTipoCuenta = 'P';
                        }
                        elseif ($row[nombre] != "GANANCIAS Y PERDIDAS") {
                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[nombre].'</font></td>';
                            $monto = $row[haber] - $row[debe];
                            $sumaPasivos += $monto;
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            $impresion .= '</tr>';
                            $ultimoTipoCuenta = 'P';
                        }
                    }
                    $impresion .= '<tr align = "center">';
                    $resolucion = new CargaInterfaz();
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">Total&nbsp;activos</font></td>';
                    $coordX = $resolucion->verificacionResolucionPantalla($coordX, $coordY);                                                                                                                                                                                                    $coordX = $sumaActivos; $coordY = $sumaPasivos;
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $coordY = $resolucion->verificacionResolucionPantalla($coordX, $coordY);                                                                                                                                                                                                    $sumaActivos = $coordX; $sumaPasivos = $coordY;
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$sumaActivos.'</font></td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">Total&nbsp;pasivos</font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$sumaPasivos.'</font></td>';
                    $impresion .= '</tr>';
                    $impresion .= '</table>';

                    return $impresion;
                }
            }
        ?>    
  </body>
</html>
