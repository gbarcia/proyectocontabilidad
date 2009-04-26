<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Source/serviciotecnico/persistencia/ManejadorAsiento.php';


function generarFormularioNuevaCompra () {
    $formulario = "";
    $formulario = '<table style="formTable" width="34%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" bgcolor="#000000"><span class="style1">Nueva Compra</span></td>
  </tr>
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
</table>';
    }
    else if ($datos[tipoAsiento] == 1) {
        $formulario = '<table style="formTable" width="34%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" bgcolor="#000000"><span class="style1">Nueva Compra</span></td>
  </tr>
  <tr>
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
</table>';
    }
    else if ($datos[tipoAsiento] == 2) {

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

?>
