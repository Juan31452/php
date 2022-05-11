<?php
include_once('conexion2.php');
include_once('calculo.php');
require_once('Clases/fecha.php');
//se instancia clase fecha_actual
$objfecha = new fecha_actual(date('m'),date('Y'));
echo $objfecha->mes_actual;
echo $objfecha->año_actual;

//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
$gsent= $pdo->prepare($sql);
$gsent->execute(array($objfecha->mes_actual,$objfecha->año_actual));

$resultado = $gsent->fetchAll();
//var_dump($resultado);

//SUMAR DATOS
$sqlsuma = 'SELECT SUM(Valor_Total) , SUM(Cantidad) 
FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
$gsuma= $pdo->prepare($sqlsuma);
$gsuma->execute(array($objfecha->mes_actual,$objfecha->año_actual));

$resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
//echo "<pre>";
//var_dump($resultadosuma);
//echo "</pre>";



?>