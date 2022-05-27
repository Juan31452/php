<?php
include_once 'conexion2.php';
/*echo 'editar.php?Descripcion=x';
$Descripcion = $_GET['Descripcion'];
echo $Descripcion;*/

$Idproduccion = $_GET['Idproduccion'];
$Fecha= $_GET['Fecha'];
$Producto= $_GET['Producto'];
$Cantidad= $_GET['Cantidad'];
$Lote= $_GET['Lote'];
echo $Idproduccion;
echo '<br>';
echo $Producto;



$sql_editar = 'UPDATE Produccion SET Fecha=?,Producto=?,Cantidad=?,Lote=? WHERE Idproduccion=?';
 $sentencia_editar = $pdo->prepare($sql_editar);
 
 $sentencia_editar->execute(array(
  $Fecha,$Producto,$Cantidad,
  $Lote,$Idproduccion
 )); 

 //cerrar conexion
$pdo=null;
$sentencia_eliminar = null;

 header('location:produccion.php');
?>
