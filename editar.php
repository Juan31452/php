<?php
include_once 'conexion2.php';
include_once 'calculo.php';
/*echo 'editar.php?Descripcion=x';
$Descripcion = $_GET['Descripcion'];
echo $Descripcion;*/

$Idproducto = $_GET['Idproducto'];
$Fecha= $_GET['Fecha'];
$Descripcion= $_GET['Descripcion'];
$Cantidad= $_GET['Cantidad'];
$Valor_Unitario= $_GET['Valor_Unitario'];
$Valor_Total=  multiplica($Cantidad,$Valor_Unitario);
echo $Idproducto;
echo '<br>';
echo $Descripcion;



$sql_editar = 'UPDATE productos SET Fecha=?,Descripcion=?,Cantidad=?,Valor_unitario=?,Valor_total=? WHERE Idproducto=?';
 $sentencia_editar = $pdo->prepare($sql_editar);
 
 $sentencia_editar->execute(array(
  $Fecha,$Descripcion,$Cantidad,
  $Valor_Unitario,$Valor_Total,$Idproducto
 )); 

 //cerrar conexion
$pdo=null;
$sentencia_eliminar = null;

 header('location:index.php');
?>
