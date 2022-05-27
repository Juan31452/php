<?php
    include_once('conexion2.php');

    //LEER DATOS VENTAS
    
    $sql = 'SELECT * FROM Ventas';
    $gsent= $pdo->prepare($sql);
    $gsent->execute();

    $resultado = $gsent->fetchAll();
    //var_dump($resultado);

    if ($resultado)

   {
  
     //Creamos un array donde almacenaremos la data obtenida
        $array = [];
        foreach($resultado as $res)
        {
        $array[] = array_map('utf8_encode',$res);
        } 
        //print_r($array);
        echo json_encode($array);
        
    }

    else
    {
        echo "No hay registros";      
    }

        
?>