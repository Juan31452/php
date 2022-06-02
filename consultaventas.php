<?php

include_once('conexion2.php');

//Consular DATOS VENTAS
    
//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Ventas';
$gsent= $pdo->prepare($sql);
$gsent->execute(array());

$resultado = $gsent->fetchAll();
//var_dump($resultado);

if ($resultado)

{

 //Creamos un array donde almacenaremos la data obtenida
    $array = [];
    foreach($resultado as $res)
    {
     $array[] = $res;
    } 
    //print_r($array);
    echo json_encode($array);
 
}

else
{
    echo "No hay registros";      
}

    
?>
