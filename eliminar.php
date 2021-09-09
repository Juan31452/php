<?php

include_once 'conexion2.php';

$Idproducto = isset($_GET['Idproducto']) ? $_GET['Idproducto'] : 0;

$sql_eliminar = 'DELETE FROM productos WHERE Idproductos=?' ;
$sentencia_eliminar = $pdo->prepare($sql_eliminar);
$sentencia_eliminar->execute(array($Idproducto));

//cerrar conexion
$pdo=null;
$sentencia_eliminar = null;

header('location:index.php');

?>