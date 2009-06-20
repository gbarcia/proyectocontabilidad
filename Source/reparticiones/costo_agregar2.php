<?php 
include("conexion.php");

$monto=$_POST['monto'];

if (empty($_POST['monto']))
	$monto = "NULL";

$sql="insert into costo (nombre,tipo_r,monto) values ('".$_POST['nombre']."','".$_POST['tipo']."',".$monto.");";

$result=mysql_query($sql);

if($_POST['tipo']=='directa')
	header("Location: costo_agregar3.php");
else
	header("Location: costo_agregado.php");
?>
