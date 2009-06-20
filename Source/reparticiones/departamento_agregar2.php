<?php 
include("conexion.php");

$tasa=$_POST['tasa'];
$area=$_POST['area'];
$valor=$_POST['area'];
$emp=$_POST['valor'];
$mat=$_POST['emp'];
$horas=$_POST['horas'];

if (empty($_POST['tasa']))
	$tasa = "NULL";
	
if (empty($_POST['area']))
	$area = "NULL";
	
if (empty($_POST['valor']))
	$valor = "NULL";

if (empty($_POST['emp']))
	$emp = "NULL";
	
if (empty($_POST['mat']))
	$mat = "NULL";	

if (empty($_POST['horas']))
	$horas = "NULL";	
$sql="insert into departamento (nombre,tipo,area,valor_mye,n_emp,materiales,kwh,hh_mob) values ('".$_POST['nombre']."','".$_POST['tipo']."',".$area.",".$valor.",".$emp.",".$mat.",".$tasa.",".$horas.");";
$result=mysql_query($sql);

header("Location: departamento_agregado.php");
?>
