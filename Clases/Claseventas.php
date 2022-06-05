<?php 
include_once 'Clases/ConexionPDO.php';

Class Claseventas extends DB
{
  function consulta()
  {
    $query = $this->connect()->query('SELECT * FROM Ventas');
    return $query;
  }
}

?>