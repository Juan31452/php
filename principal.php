<?php
include_once('calculo.php');
include_once('misql.php');

$tabla = "Gastos";

$mensaje = consultar($tabla = "Gastos");
echo $mensaje;

?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
 </head>
    <body>
    <div class="contenedor" >
            <form method="GET" >
                <select name="tabla" id="tabla">
                    <option>Gastos</option>
                    <option>Produccion</option>
                    <option>Ventas</option>
                </select>
                <select name="mes" id="mes">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                </select>
                <select name="año" id="año">
                    <option>2022</option>
                    <option>2021</option>  
                </select>
                <input class="button" type="submit" name ="enviar" value="BUSCAR" />
            </form>
        </div> 

    </body>
</html>
