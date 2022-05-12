<?php
require_once('Clases/fecha.php');
//include_once('conexion2.php');
include_once('Clases/ConexionPDO.php');

function consultar($tabla)
{
    
    //se instancia clase fecha_actual
    $objfecha = new fecha_actual(date('m'),date('Y'));
    echo $objfecha->mes_actual;
    echo $objfecha->año_actual;

    $miconexion1 = new conexion;
    $consulta = $miconexion1->prepare('SELECT * FROM '.$tabla.' WHERE MONTH(Fecha) = 04 AND YEAR(Fecha) = 2022 ');
    $consulta->execute();
    $registro = $consulta->fetch();
    var_dump($registro);

    return $tabla;

   
}
?>