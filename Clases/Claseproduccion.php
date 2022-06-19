<?php

include_once 'Clases/ConexionPDO.php';

Class Claseproduccion extends DB
{
  function consulta()
  {
    $query = $this->connect()->query('SELECT * FROM Produccion');
    return $query;
  }

  function consulta1()
  {
    $query = $this->connect()->query('SELECT SUM(Cantidad) AS Cantidad
     FROM Produccion');
    return $query;
  }

  function consulta3($mes,$año)
  {
    $query = $this->connect()->prepare('SELECT * FROM Produccion WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?');
    $query->execute(array($mes,$año));
    return $query;
  }
  
  function insertardatos($datos)
  {
    

    $sql_agregar =$this->connect()->prepare('INSERT INTO Produccion(Fecha,Producto,
    Cantidad,Lote)
    VALUES (?,?,?,?)');
//$sentencia_agregar = ->prepare($sql_agregar);
    $sql_agregar->execute(array($datos['Fecha'],$datos['Producto'],$datos['Cantidad'],$datos['Lote']
   
    ));
    return $sql_agregar;
  }
  
}

?>