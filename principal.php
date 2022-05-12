<?php
//include_once('conexion2.php');
include_once('Clases/ConexionPDO.php');
include_once('calculo.php');
require_once('Clases/fecha.php');
include_once('misql.php');

$tabla = "Gastos";

$mensaje = consultar($tabla = "Gastos");
echo $mensaje;

?>