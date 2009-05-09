<?php
    class CargaInterfaz {

        function verificacionResolucionPantalla($cuadroActivo, $cuadroPorCargar){
            if ($cuadroActivo < $cuadroPorCargar) {
                $cuadroActivo += ($cuadroPorCargar - $cuadroActivo);
                return $cuadroActivo;
            }
            elseif ($cuadroActivo > $cuadroPorCargar) {
                $cuadroPorCargar += ($cuadroActivo - $cuadroPorCargar);
                return $cuadroActivo;
            }
            else {
                return $cuadroActivo;
            }
        }
    }
?>
