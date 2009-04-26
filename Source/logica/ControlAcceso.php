<?php

/**
 * Description of ControlAcceso
 *
 * @author gerardobarcia
 */
class ControlAcceso {
    private $clave = 1234;

    private $usuario = 'contador';

    private $claveIntroducida;

    private $usuarioIntroducido;

    function __construct($claveIntroducida, $usuarioIntroducido) {
        $this->claveIntroducida = $claveIntroducida;
        $this->usuarioIntroducido = $usuarioIntroducido;
    }

    public function validarUsuario () {
        if ($this->claveIntroducida == $this->clave
            && $this->usuarioIntroducido == $this->usuario)
        return true;
        else return false;
    }
}
?>
