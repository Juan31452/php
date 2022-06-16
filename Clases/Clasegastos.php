<?php 
include_once 'Clases/ConexionPDO.php';

Class Clasegastos extends DB
{
  function consulta()
  {
    $query = $this->connect()->query('SELECT * FROM Gastos');
    return $query;
  }

  function consulta1()
  {
    $query = $this->connect()->query('SELECT SUM(Valor_Total) AS Valor_Unitario
     FROM Gastos');
    return $query;
  }
}

?>