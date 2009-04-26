<?php

function generarFormularioNuevaCompra () {
    $formulario = "";
    $formulario = '<table width="34%" border="0" cellspacing="0" cellpadding="0">
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
    <td><select name="select" id="select">
    </select>
    </td>
  </tr>
  <tr>
    <td>Producto:</td>
    <td><select name="select2" id="select2">
    </select>
    </td>
  </tr>
  <tr>
    <td>Cantidad:</td>
    <td><input name="textfield2" type="text" id="textfield2" size="20" /></td>
  </tr>
  <tr>
    <td>Costo Unitario:</td>
    <td><input name="textfield3" type="text" id="textfield3" size="20" /></td>
  </tr>
</table>';
}

?>
