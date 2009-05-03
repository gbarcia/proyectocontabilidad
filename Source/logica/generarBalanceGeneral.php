<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
        <?php
            require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
            require_once("../serviciotecnico/persistencia/ManejadorCuenta.php");
            /*require_once("../serviciotecnico/persistencia/ManejadorHome.php");
            require_once("../serviciotecnico/utilidades/xajax/xajaxResponse.inc.php");*/

            class Balance {

                private $transaccion;

                function __construct(){
                    $this->transaccion = new TransaccionBDclass();
                }

                function mostrarBalance(){

                    $manejador = new ManejadorCuenta();

                    $resultado = $manejador->consultarActivosPasivos();
                    
                    //$objResponse = new xajaxResponse();

                    $impresion = '<h1 align = "center"><b>BALANCE&nbsp;GENERAL</b></h1><br><br>';
                    $impresion .= '<table align = "center" border = "2" cellpadding = "2" cellspacing = "0">';
                    $impresion .= '<thead>';
                    $impresion .= '<tr align = "center">';
                    $impresion .= '<th colspan = "6"><font size = "2" face = "Garamond, Comic Sans MS, Arial">Cía UCAB, C. A.</font></th>';
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
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $monto = $row[debe] - $row[haber];
                            $sumaActivos += $monto;
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            $ultimoTipoCuenta = 'A';
                        }
                        elseif ($ultimoTipoCuenta == 'A'){
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[nombre].'</font></td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $monto = $row[haber] - $row[debe];
                            $sumaPasivos += $monto;
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            $impresion .= '</tr>';
                            $ultimoTipoCuenta = 'P';
                        }
                        else {
                            $impresion .= '<tr align = "center">';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$row[nombre].'</font></td>';
                            $monto = $row[haber] - $row[debe];
                            $sumaPasivos += $monto;
                            $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$monto.'</font></td>';
                            $impresion .= '</tr>';
                            $ultimoTipoCuenta = 'P';
                        }
                    }

                    $impresion .= '<tr>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">Total&nbsp;activos</font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$sumaActivos.'</font></td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">Total&nbsp;pasivos</font></td>';
                    $impresion .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                    $impresion .= '<td><font size = "2" face = "Garamond, Comic Sans MS, Arial">'.$sumaPasivos.'</font></td>';
                    $impresion .= '</tr>';

                    $impresion .= '</table>';

                    printf($impresion);

                    //$objResponse->addAssign("Balance General", "innerHTML", $impresion);
                }
            }
        ?>    
  </body>
</html>
