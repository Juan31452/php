<?php
include_once '../php/Clases/APIproduccion.php';

$api = new APIproduccion();

if (isset($_GET['mes']))
{
  $mes = $_GET['mes'];
  $año = $_GET['año'];
  $api->buscarporfecha($mes,$año);
  
}else
{
    $api->getAll();
}

?>