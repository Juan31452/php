<?php 
include_once '../php/Clases/ConexionPDO.php';

Class Claseventas extends DB
{
  function consulta()
  {
    $query = $this->connect()->query('SELECT * FROM Ventas');
    return $query;
  }

  function consulta1()
  {
    $query = $this->connect()->query('SELECT SUM(Cantidad) AS Cantidad,SUM(Valor_Total) AS Valor_Unitario
     FROM Ventas');
    return $query;
  }
}

?>