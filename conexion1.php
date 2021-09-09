<?php
$mysql = new mysqli("localhost","root","","tienda"); 
if($mysql->connect_error)
{
    die("Error de conexion");
}
/*else
{
    echo "Conexion Exitosa";
}*/

?>