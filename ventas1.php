<?php
//ADICIONAR DATOS
if ($_POST)
{
    $Fecha = $_POST['Fecha'];
    $Producto = $_POST['Producto'];
    $Cantidad =  $_POST['Cantidad'];
    $Valor_U =  $_POST['Valor_Unitario'];
    $Valor_T =  multiplica($Cantidad,$Valor_U);
    
    $sql_agregar = 'INSERT INTO Ventas(Fecha,Producto,
    Cantidad,Valor_Unitario,Valor_Total)
    VALUES (?,?,?,?,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);
    $sentencia_agregar->execute(array(
    $Fecha,$Producto,$Cantidad,$Valor_U,$Valor_T 
    ));
  
 header('Location:index.html');
}


?>