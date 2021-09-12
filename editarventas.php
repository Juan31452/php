<?php
include_once 'conexion2.php';
include_once 'calculo.php';
/*echo 'editar.php?Descripcion=x';
$Descripcion = $_GET['Descripcion'];
echo $Descripcion;*/

$Idventa = $_GET['Idventa'];
$Fecha= $_GET['Fecha'];
$Producto= $_GET['Producto'];
$Cantidad= $_GET['Cantidad'];
$Valor_Unitario= $_GET['Valor_Unitario'];
$Valor_Total=  multiplica($Cantidad,$Valor_Unitario);
echo $Idventa;
echo '<br>';
echo $Producto;



$sql_editar = 'UPDATE Ventas SET Fecha=?,Producto=?,Cantidad=?,Valor_unitario=?,Valor_total=? WHERE Idventa=?';
 $sentencia_editar = $pdo->prepare($sql_editar);
 
 $sentencia_editar->execute(array(
  $Fecha,$Producto,$Cantidad,
  $Valor_Unitario,$Valor_Total,$Idventa
 )); 

 //cerrar conexion
$pdo=null;
$sentencia_eliminar = null;

 header('location:ventas.php');
?>
