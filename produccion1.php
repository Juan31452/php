<?php
      //include_once('../php/conexion2.php');
      //require_once('Clases/fecha.php');
      include_once '../php/Clases/APIproduccion.php';

      $api = new APIproduccion();
      
    //ADICIONAR DATOS
    if ($_POST)
    {
       $item = array(
        'Fecha'=> $_POST['Fecha'],
        'Producto' => $_POST['Producto'],
        'Cantidad' => $_POST['Cantidad'],
        'Lote' => $_POST['Lote']

       );

       $api -> agregar($item);

       /*
        $Fecha = $_POST['Fecha'];
        $Producto = $_POST['Producto'];
        $Cantidad =  $_POST['Cantidad'];
        $Lote =  $_POST['Lote'];

        $sql_agregar = 'INSERT INTO Produccion(Fecha,Producto,
        Cantidad,Lote)
        VALUES (?,?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Fecha,$Producto,$Cantidad,$Lote 
        ));
        /*
        if ($sql_agregar) {
            echo "<p>Registro agregado.</p>";
        } else {
        echo "<p>No se agregó...</p>";
        }
        */
        //header('Location:produccion.php');
    }
?>