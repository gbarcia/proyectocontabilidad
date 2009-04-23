<?php

/**
 * Description of Cuentaclass
 *
 * @author gerardobarcia
 */
class Cuentaclass {
    private $numero;
    private $tipo;
    private $nombre;
    private $descripcion;
    private $cantidadActualDebe;
    private $cantidadActualHaber;

    function __construct() {
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getCantidadActualDebe() {
        return $this->cantidadActualDebe;
    }

    public function setCantidadActualDebe($cantidadActualDebe) {
        $this->cantidadActualDebe = $cantidadActualDebe;
    }

    public function getCantidadActualHaber() {
        return $this->cantidadActualHaber;
    }

    public function setCantidadActualHaber($cantidadActualHaber) {
        $this->cantidadActualHaber = $cantidadActualHaber;
    }
        
}
?>
