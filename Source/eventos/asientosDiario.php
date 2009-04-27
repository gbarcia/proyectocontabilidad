<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/persistencia/ManejadorAsiento.php';


function mostrarLibroDiario ($datos) {
    $controlAsiento = new ManejadorAsiento();
    $recurso = $controlAsiento->obtenerLibroDiario($datos[fechaInicio], $datos[fechaFin]);
    $objResponse = new xajaxResponse();
    $resultado = '<table cellspacing="0" class="" border="1">';
    $resultado.= '<thead>';
    $resultado.= '<tr>';
    $resultado.= '<th>NUM</th>';
    $resultado.= '<th>FECHA</th>';
    $resultado.= '<th>CUENTA</th>';
    $resultado.= '<th>DEBE</th>';
    $resultado.= '<th>HABER</th>';
    $resultado.= '</tr>';
    $resultado.= '</thead>';
    while ($row = mysql_fetch_array($recurso)) {
        $resultado.= '<td>' . $row[num]. '</td>';
        $resultado.= '<td>' . $row[fecha]. '</td>';
        $resultado.= '<td>' . $row[nombreCuenta]. '</td>';
        $resultado.= '<td>' . $row[debe]. '</td>';
        $resultado.= '<td>' . $row[haber]. '</td>';
        $resultado.= '</tr>';
    }
    $resultado.= '</table>';
    $objResponse->addAssign("librod", "innerHTML", $resultado);
    return $objResponse;
}


function generarFormularioNuevaCompra () {
    $formulario = "";
    $formulario = '<table style="formTable" width="34%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" bgcolor="#000000"><span class="style1">Nueva Compra</span></td>
  </tr><input type="hidden" name="tipo" id="tipo" value="0" />
  <tr>
    <td width="42%">Fecha:</td>
    <td width="58%"><label>
        <input type="text" name="fecha" id="f_date_c" readonly="1" size="15" /><img src="jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"</td>
  </tr>
  <tr>
    <td>Proveedor:</td>
    <td><select name="proveedor" id="select">
        <option value="J-1248931-5">Epson </option>
        <option value="J-3466793-1">HP </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Producto:</td>
    <td><select name="producto" id="select2">
        <option value="1">Mouse Optico </option>
        <option value="2">Mouse Laser </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Cantidad:</td>
    <td><input name="cantidad" type="text" id="textfield2" size="20" /></td>
  </tr>
  <tr>
    <td>Costo Unitario:</td>
    <td><input name="costo" type="text" id="textfield3" size="20" /></td>
  </tr>
<tr>
      <td height="26" colspan="2"><div align="center">
        <input name="button" type="button" id="button" value="REGISTRAR" onclick= "xajax_procesarAsiento(xajax.getFormValues(\'formControl\'))" />
      </div></td>
    </tr>
</table>';
    $objResponse = new xajaxResponse();
    $objResponse->addAssign("control", "innerHTML", $formulario);
    $objResponse->addScript('
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });');
    return $objResponse;
}

function CambiarFormulario ($datos) {
    $formulario = "";
    $objResponse = new xajaxResponse();
    if ($datos[tipoAsiento] == 0) {
        $formulario = '<table style="formTable" width="34%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" bgcolor="#000000"><span class="style1">Nueva Compra</span></td>
  </tr>
  <tr><input type="hidden" name="tipo" id="tipo" value="0"/>
    <td width="42%">Fecha:</td>
    <td width="58%"><label>
        <input type="text" name="fecha" id="f_date_c" readonly="1" size="15" /><img src="jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"</td>
  </tr>
  <tr>
    <td>Proveedor:</td>
    <td><select name="proveedor" id="select">
        <option value="J-1248931-5">Epson </option>
        <option value="J-3466793-1">HP </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Producto:</td>
    <td><select name="producto" id="select2">
        <option value="1">Mouse Optico </option>
        <option value="2">Mouse Laser </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Cantidad:</td>
    <td><input name="cantidad" type="text" id="textfield2" size="20" /></td>
  </tr>
  <tr>
    <td>Costo Unitario:</td>
    <td><input name="costo" type="text" id="textfield3" size="20" /></td>
  </tr>
<tr>
      <td height="26" colspan="2"><div align="center">
        <input name="button" type="button" id="button" value="REGISTRAR" onclick= "xajax_procesarAsiento(xajax.getFormValues(\'formControl\'))" />
      </div></td>
    </tr>
</table>';
    }
    else if ($datos[tipoAsiento] == 1) {
        $formulario = '<table style="formTable" width="34%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" bgcolor="#000000"><span class="style1">Nueva Venta</span></td>
  </tr>
  <tr><input type="hidden" name="tipo" id="tipo" value="1" />
    <td width="42%">Fecha:</td>
    <td width="58%"><label>
        <input type="text" name="fecha" id="f_date_c" readonly="1" size="15" /><img src="jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"</td>
  </tr>
  <tr>
    <td>Cliente:</td>
    <td><select name="cliente" id="select">
        <option value="J-30667580-9">Compu Parts </option>
        <option value="J-30877383-2">Abi Computer </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Producto:</td>
    <td><select name="producto" id="select2">
        <option value="1">Mouse Optico </option>
        <option value="2">Mouse Laser </option>
    </select>
    </td>
  </tr>
  <tr>
    <td>Cantidad:</td>
    <td><input name="cantidad" type="text" id="textfield2" size="20" /></td>
  </tr>
  <tr>
    <td>Costo Unitario:</td>
    <td><input name="costo" type="text" id="textfield3" size="20" /></td>
  </tr>
<tr>
      <td height="26" colspan="2"><div align="center">
        <input name="button" type="button" id="button" value="REGISTRAR" onclick= "xajax_procesarAsiento(xajax.getFormValues(\'formControl\'))" />
      </div></td>
    </tr>
</table>';
    }
    else if ($datos[tipoAsiento] == 2) {
        $controlCuenta = new ManejadorAsiento();
        $recursoCuenta = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta2 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta3 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta4 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta5 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta6 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta7 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta8 = $controlCuenta->obtenerTodasLasCuentas();
        $recursoCuenta9 = $controlCuenta->obtenerTodasLasCuentas();
        $formulario = '<table width="79%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8" bgcolor="#000000"><span class="style1">Nuevo Asiento Contable General</span></td>
  </tr>
  <tr>
    <td width="3%">&nbsp;</td>
    <td>Fecha:</td>
    <td colspan="3"><label>
        <input type="text" name="fecha" id="f_date_c" readonly="1" size="15" /><img src="jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="tipo" type="hidden" id="tipo" value="2" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="uno" type="checkbox" id="uno" checked="checked" />
    </div></td>
    <td width="8%">Cuenta:</td>
    <td width="13%"><select name="cuenta1" id="select">
    ';
        while ($row1 = mysql_fetch_array($recursoCuenta)) {
            $formulario .= "<option value='".$row1[num]."'>".'('.$row1[tipo].')'.$row1[nombre]." </option>";
        }

    $formulario .= '</select>    </td>
    <td width="9%">Debitar:</td>
    <td width="15%"><input name="d1" type="text" id="d1" size="10" /></td>
    <td width="6%">&nbsp;</td>
    <td width="13%">Acreditar:</td>
    <td width="33%"><input name="h1" type="text" id="h1" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="dos" type="checkbox" id="dos" checked="checked" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta2" id="select">';
        while ($row2 = mysql_fetch_array($recursoCuenta2)) {
            $formulario .= "<option value='".$row2[num]."'>".'('.$row2[tipo].')'.$row2[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d2" type="text" id="d2" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h2" type="text" id="h2" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="tres" id="tres" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta3" id="select">';
        while ($row3 = mysql_fetch_array($recursoCuenta3)) {
            $formulario .= "<option value='".$row3[num]."'>".'('.$row3[tipo].')'.$row3[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d3" type="text" id="d3" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h3" type="text" id="h3" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="cuatro" id="cuatro" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta4" id="select">';
        while ($row4 = mysql_fetch_array($recursoCuenta4)) {
            $formulario .= "<option value='".$row4[num]."'>".'('.$row4[tipo].')'.$row4[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d4" type="text" id="d4" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h4" type="text" id="h4" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="cinco" id="cinco" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta5" id="select">';
      while ($row5 = mysql_fetch_array($recursoCuenta5)) {
            $formulario .= "<option value='".$row5[num]."'>".'('.$row5[tipo].')'.$row5[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d5" type="text" id="d5" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h5" type="text" id="h5" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="seis" id="seis" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta6" id="select">';
        while ($row6 = mysql_fetch_array($recursoCuenta6)) {
            $formulario .= "<option value='".$row6[num]."'>".'('.$row6[tipo].')'.$row6[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d6" type="text" id="d6" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h6" type="text" id="h6" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="siete" id="siete" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta7" id="select">';
        while ($row7 = mysql_fetch_array($recursoCuenta7)) {
            $formulario .= "<option value='".$row7[num]."'>".'('.$row7[tipo].')'.$row7[nombre]." </option>";
        }
      $formulario .='</select>    </td>
    <td>Debitar:</td>
    <td><input name="d7" type="text" id="d7" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h7" type="text" id="h7" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="ocho" id="ocho" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta8" id="select">';
       while ($row8 = mysql_fetch_array($recursoCuenta8)) {
            $formulario .= "<option value='".$row8[num]."'>".'('.$row8[tipo].')'.$row8[nombre]." </option>";
        }
      $formulario .= '</select>    </td>
    <td>Debitar:</td>
    <td><input name="d8" type="text" id="d8" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h8" type="text" id="h8" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="nueve" id="nueve" /></td>
    <td>Cuenta:</td>
    <td><select name="cuenta9" id="select">';
         while ($row9 = mysql_fetch_array($recursoCuenta9)) {
            $formulario .= "<option value='".$row9[num]."'>".'('.$row9[tipo].')'.$row9[nombre]." </option>";
        }
      $formulario .= '</select>
    </td>
    <td>Debitar:</td>
    <td><input name="d9" type="text" id="d9" size="10" /></td>
    <td>&nbsp;</td>
    <td>Acreditar:</td>
    <td><input name="h9" type="text" id="h9" size="10" /></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
<tr>
      <td height="26" colspan="2"><div align="center">
        <input name="button" type="button" id="button" value="REGISTRAR" onclick= "xajax_procesarAsiento(xajax.getFormValues(\'formControl\'))" />
      </div></td>
    </tr>
</table>';
    }
    $objResponse->addAssign("control", "innerHTML", $formulario);
    $objResponse->addScript('
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });');
    return $objResponse;
}

function procesarAsiento ($datos) {
    $objResponse = new xajaxResponse();
    if ($datos[tipo] == 0) {
        //REGISTRAR COMPRA
        $controlAsiento = new ManejadorAsiento();
        $numAsiento = $controlAsiento->agregarAsiento($datos[fecha]);
        if ($datos[producto] == 1) $cuentaEgreso = 12;
        else if ($datos[producto] == 2) $cuentaEgreso = 13;
        $montoTotal = $datos[cantidad] * $datos[costo];
        $resultado = $controlAsiento->agregarRegistro($numAsiento, 1, 0, $montoTotal, 'C');
        $resultado = $controlAsiento->agregarRegistro($numAsiento, $cuentaEgreso, $montoTotal,0, 'C');
    }
    else if ($datos[tipo] == 1) {
        //REGISTRAR VENTA
        $controlAsiento = new ManejadorAsiento();
        $numAsiento = $controlAsiento->agregarAsiento($datos[fecha]);
        if ($datos[producto] == 1) $cuentaIngreso = 10;
        else if ($datos[producto] == 2) $cuentaIngreso = 11;
        $montoTotal = $datos[cantidad] * $datos[costo];
        $resultado = $controlAsiento->agregarRegistro($numAsiento, 1, $montoTotal,0 , 'V');
        $resultado = $controlAsiento->agregarRegistro($numAsiento, $cuentaIngreso,0,$montoTotal, 'V');
    }
    else if ($datos[tipo] == 2) {
        // OTRO ASIENTO
        $controlAsiento = new ManejadorAsiento();
        $numAsiento = $controlAsiento->agregarAsiento($datos[fecha]);
        if ($datos[uno] == true) {
            $debe = $datos[d1];
             $haber = $datos[h1];
            if ($datos[d1] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta1], $debe,$haber , 'O');
        }
        if ($datos[dos] == true && $datos[uno] == true) {
             $debe = $datos[d2];
             $haber = $datos[h2];
             if ($datos[d2] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta2], $debe,$haber , 'O');
        }
        if ($datos[tres] == true && $datos[tres] == true) {
             $debe = $datos[d3];
             $haber = $datos[h3];
             if ($datos[d3] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta3], $debe,$haber , 'O');
        }
        if ($datos[cuatro] == true && $datos[cuatro] == true) {
             $debe = $datos[d4];
             $haber = $datos[h4];
             if ($datos[d4] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta4], $debe,$haber , 'O');
        }
        if ($datos[cinco] == true && $datos[cinco] == true) {
             $debe = $datos[d5];
             $haber = $datos[h5];
             if ($datos[d5] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta5], $debe,$haber , 'O');
        }
        if ($datos[seis] == true && $datos[seis] == true) {
             $debe = $datos[d6];
             $haber = $datos[h6];
             if ($datos[d6] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta6], $debe,$haber , 'O');
        }
        if ($datos[siete] == true && $datos[siete] == true) {
             $debe = $datos[d7];
             $haber = $datos[h7];
             if ($datos[d7] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta7], $debe,$haber , 'O');
        }
        if ($datos[ocho] == true && $datos[ocho] == true) {
             $debe = $datos[d8];
             $haber = $datos[h8];
             if ($datos[d8] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta8], $debe,$haber , 'O');
        }
        if ($datos[nueve] == true && $datos[nueve] == true) {
             $debe = $datos[d9];
             $haber = $datos[h9];
             if ($datos[d9] == '') $debe = 0;
            else $haber = 0;
            $resultado = $controlAsiento->agregarRegistro($numAsiento, $datos[cuenta9], $debe,$haber , 'O');
        }
    }
    return $objResponse;
}

?>
