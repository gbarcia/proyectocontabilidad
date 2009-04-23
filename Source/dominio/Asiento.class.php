<?php

/**
 * Description of Asientoclass
 *
 * @author gerardobarcia
 */
class Asientoclass {
    private $numero;
    private $fecha;

    function __construct() {
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
?>
