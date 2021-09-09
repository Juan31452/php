<?php

$servidor = "localhost";
$usuario = "root";
$password = "";

$servername = "mysql:host=$servidor;dbname=tienda";
try{
// crear conexion
$pdo=new PDO($servername,$usuario,$password);
//echo 'Conectado a Base de Datos Tienda  ';

}catch(PDOException $e){
    print "Error conexion" . $e->getMessage(). "<br/>";
    die();
}
?>

