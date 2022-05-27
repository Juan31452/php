<?php

include_once 'Clases/ConexionPDO.php';

Class Claseproduccion extends DB
{
  function consulta()
  {
    $query = $this->connect()->query('SELECT * FROM Produccion');
    return $query;
  }
}

?>