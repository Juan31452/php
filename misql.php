<?php
require_once('Clases/fecha.php');
include_once('Clases/ConexionPDO.php');

function consultar($tabla)
{
    
    //se instancia clase fecha_actual
    $objfecha = new fecha_actual(date('m'),date('Y'));
    echo $objfecha->mes_actual;
    echo $objfecha->año_actual;

    $miconexion1 = new conexion;
    $consulta = $miconexion1->prepare('SELECT * FROM '.$tabla.' WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ? ');
    $consulta->execute(array($objfecha->mes_actual,$objfecha->año_actual));
    $registro = $consulta->fetch();
    echo "<pre>";
    var_dump($registro);
    echo "</pre>";

    $miconexion2 = new conexion;
    $consulta = $miconexion2->prepare('SELECT SUM(Valor_Total) FROM '.$tabla.' WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ? ');
    $consulta->execute(array($objfecha->mes_actual,$objfecha->año_actual));
    $registro = $consulta->fetch();
    var_dump($registro);

    return $tabla;

   
}
?>