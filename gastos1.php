<?php
    include_once('../php/conexion2.php');
    require_once('Clases/fecha.php');

        //ADICIONAR DATOS
        if ($_POST)
        {
            $Fecha = $_POST['Fecha'];
            $Producto = $_POST['Producto'];
            $Descripcion =  $_POST['Descripcion'];
            $Valor_Total =  $_POST['Valor_Total'];
            
            $sql_agregar = 'INSERT INTO Gastos(Fecha,Producto,
            Descripcion,Valor_Total)
            VALUES (?,?,?,?)';
            $sentencia_agregar = $pdo->prepare($sql_agregar);
            $sentencia_agregar->execute(array(
            $Fecha,$Producto,$Descripcion,$Valor_Total 
            ));
            /*
            if ($sql_agregar) {
                echo "<p>Registro agregado.</p>";
                } else {
                echo "<p>No se agregó...</p>";
            }
            */
         //header('Location:gastos.php');
        }
    
?>