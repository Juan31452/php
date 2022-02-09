<?php
include_once('conexion2.php');
//LEER DATOS se reemplaza por BUSCAR DATOS

$sql = 'SELECT * FROM Produccion WHERE MONTH(Fecha) = 01 AND YEAR(Fecha) = 2022';
$gsent= $pdo->prepare($sql);
$gsent->execute();

$resultado = $gsent->fetchAll();
//var_dump($resultado);

//SUMAR DATOS
$sqlsuma = 'SELECT  SUM(Cantidad) 
FROM Produccion WHERE MONTH(Fecha) = 01 AND YEAR(Fecha) = 2022';
$gsuma= $pdo->prepare($sqlsuma);
$gsuma->execute();

$resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
echo "<pre>";
var_dump($resultadosuma);
echo "</pre>";

?>


<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO PRODUCCION</title>
 </head>
    <body>
        <div class="contenedor" >
            <?php if (!$_GET): ?>
                <h2>AGREGAR DATOS PRODUCCION</h2>  
                <form method="POST" >
                    FECHA:</br> 
                    <input type="text" class="formulario" name="Fecha"></br>
                    PRODUCTO:</br> 
                    <input type="text" class="formulario" name="Producto"></br>
                    CANTIDAD:</br> 
                    <input type="text" class="formulario" name="Cantidad"></br></br>
                    <button>Agregar</button>
                </form>
            <?php endif ?>
        </div> 
        </br>
        <div class="contenedor1" >
            <form method="GET" >
                <select name="mes" id="mes">
                    <option>01</option>
                    <option>02</option>  
                </select>
                <select name="año" id="año">
                    <option>2022</option>
                    <option>2021</option>  
                </select>
                <input class="button" type="submit" name ="enviar" value="BUSCAR" />
            </form>

            <?php
              if(isset($_GET['enviar']))
              {
                  
                    $año = $_GET['año'];
                    $mes = $_GET['mes'];
                    //echo $mes;
                    //echo $año;
                    $sql = 'SELECT * FROM Produccion WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
                    $gsent= $pdo->prepare($sql);
                    $gsent->execute(array($mes,$año));
        
                    $resultado = $gsent->fetchAll();
                    //var_dump($resultado);
                    
                    //SUMAR DATOS
                    $sqlsuma = 'SELECT  SUM(Cantidad) 
                    FROM Produccion WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
                    $gsuma= $pdo->prepare($sqlsuma);
                    $gsuma->execute(array($mes,$año));

                    $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
                    echo "<pre>";
                    var_dump($resultadosuma);
                    echo "</pre>";
                }  
            
            ?>

            </br>
         <div class="fila">
              <div class="columna">
                 <table border=1>
                     <thead>
                         <td>FECHA</td>
                         <td>PRODUCTO</td>
                         <td>CANTIDAD</td>
                     </thead>

                     <tbody>
                         <div class = "contenido"> 
                             <?php foreach($resultado as $rs):?>
                                 <tr>
                                     <td width="140"><?php echo $rs['Fecha']; ?></td>
                                     <td><?php echo $rs['Producto']; ?></td>
                                     <td><?php echo $rs['Cantidad']?></td>
                                     <td><a href="produccion.php?Idproduccion=<?php echo $rs['Idproduccion']?>"> Editar </a></td>

                                 </tr>
                                <?php endforeach?>                 
                           </div>    

                     </tbody>
                    </table>
               </div> 
            </div>
       </div>

       <div class="contenedor2" >
         <p> CANTIDAD : <?php echo $totalsuma =$resultadosuma[0]?> </p>
         <? $mes = isset($_GET['mes']);
          echo $mes
         ?>
        </div>

    </body>
</html>

<?php
    include_once('conexion2.php');

    //ADICIONAR DATOS
    if ($_POST)
    {
        $Fecha = $_POST['Fecha'];
        $Producto = $_POST['Producto'];
        $Cantidad =  $_POST['Cantidad'];
        
        $sql_agregar = 'INSERT INTO Produccion(Fecha,Producto,
        Cantidad)
        VALUES (?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Fecha,$Producto,$Cantidad 
        ));
       /*
        if ($sql_agregar) {
            echo "<p>Registro agregado.</p>";
            } else {
            echo "<p>No se agregó...</p>";
        }
        */
     header('Location:produccion.php');
    }

    
 
?>


<?php
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>