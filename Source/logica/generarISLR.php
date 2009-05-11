<html>
    <head><title>Impuesto&nbsp;sobre&nbsp;la&nbsp;Renta</title></head>
<body>
    <?php
        require_once("../serviciotecnico/utilidades/TransaccionBD.class.php");
        require_once("../serviciotecnico/persistencia/ManejadorCuenta.php");

        class ImpuestoSobreLaRenta {
            private $transaccion;

            function __construct(){
                $this->transaccion = new TransaccionBDclass();
            }

            function mostrarISLR($porcentajeUtilidad){
                $manejador = new ManejadorCuenta();

                $resultadoIngresos = $manejador->consultarSumaIngresos();
                $ingresos = round(mysql_result($resultadoIngresos, 0, 0));

                $resultadoEgresos = $manejador->consultarSumaEgresos();
                $egresos = round(mysql_result($resultadoEgresos, 0, 0));

                $utilidadesISLR = round($ingresos - $egresos);
                $islrPorPagar = round($utilidadesISLR * $porcentajeUtilidad);
                $utilidadDespuesISLR = round($utilidadesISLR - $islrPorPagar);

                $impresion = '<h3 align = "center"><b>IMPUESTO&nbsp;SOBRE&nbsp;LA&nbsp;RENTA&nbsp;EDUGER,&nbsp;C.&nbsp;A.</b></h3><br><br>';
                $impresion .= '<table align = "center" border = "2" cellpadding = "4" cellspacing = "2">';
                $impresion .= '<thead>';
                $impresion .= '<tr align = "center">';
                $impresion .= '<th colspan = "5"><font size = "2" face = "Garamond, Comic Sans MS, Arial">Impuesto&nbsp;sobre&nbsp;la&nbsp;Renta&nbsp;por&nbsp;pagar</font></th>';
                $impresion .= '</tr>';
                $impresion .= '<tr align = "center">';
                $fechaActual = date("d/m/Y");
                $impresion .= '<th colspan = "5"><font size = "2" face = "Garamond, Comic Sans MS, Arial">al&nbsp;'.$fechaActual.'</font></th>';
                $impresion .= '</tr>';
                $impresion .= '<tr align = "center">';
                $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">INGRESOS&nbsp;TOTALES</font></i></td>';
                $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">EGRESOS&nbsp;TOTALES</font></i></td>';
                $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">UTILIDADES&nbsp;ISLR</font></i></td>';
                $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">ISLR&nbsp;POR&nbsp;PAGAR</font></i></td>';
                $impresion .= '<td><i><font size = "2" face = "Garamond, Comic Sans MS, Arial">UTILIDAD&nbsp;DESPU&Eacute;S&nbsp;DEL&nbsp;ISLR</font></i></td>';
                $impresion .= '</tr>';
                $impresion .= '</thead>';
                $impresion .= '<tr align = "center">';
                $impresion .= '<td>'.$ingresos.'</td>';
                $impresion .= '<td>'.$egresos.'</td>';
                $impresion .= '<td>'.$utilidadesISLR.'</td>';
                $impresion .= '<td>'.$islrPorPagar.'</td>';
                $impresion .= '<td>'.$utilidadDespuesISLR.'</td>';
                $impresion .= '</tr>';

                $impresion .= '</table>';

                printf($impresion);
            }
        }
    ?>
</body>
</html>