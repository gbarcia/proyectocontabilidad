<?php
    require_once("generarEdoResultados.php");

    $estado = new EstadoResultados();

    $estado->mostrarEdoResultados('2009-01-01', '2009-01-31');
?>
