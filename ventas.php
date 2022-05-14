<?php
include_once('conexion2.php');
include_once('calculo.php');
require_once('Clases/fecha.php');
//se instancia clase fecha_actual
$objfecha = new fecha_actual(date('m'),date('Y'));
echo $objfecha->mes_actual;
echo $objfecha->año_actual;

//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
$gsent= $pdo->prepare($sql);
$gsent->execute(array($objfecha->mes_actual,$objfecha->año_actual));

$resultado = $gsent->fetchAll();
//var_dump($resultado);

//SUMAR DATOS
$sqlsuma = 'SELECT SUM(Valor_Total) , SUM(Cantidad) 
FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
$gsuma= $pdo->prepare($sqlsuma);
$gsuma->execute(array($objfecha->mes_actual,$objfecha->año_actual));

$resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
//echo "<pre>";
//var_dump($resultadosuma);
//echo "</pre>";

    //ADICIONAR DATOS
    if ($_POST)
    {
        $Fecha = $_POST['Fecha'];
        $Producto = $_POST['Producto'];
        $Cantidad =  $_POST['Cantidad'];
        $Valor_U =  $_POST['Valor_Unitario'];
        $Valor_T =  multiplica($Cantidad,$Valor_U);
        
        $sql_agregar = 'INSERT INTO Ventas(Fecha,Producto,
        Cantidad,Valor_Unitario,Valor_Total)
        VALUES (?,?,?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Fecha,$Producto,$Cantidad,$Valor_U,$Valor_T 
        ));
      
     header('Location:ventas.php');
    }

//EDITAR DATOS
if (isset($_GET['Idventa']))
{
    $Idventa = $_GET['Idventa'];
    $sql_unico = 'SELECT * FROM Ventas WHERE Idventa=?';
    $gsent_unico= $pdo->prepare($sql_unico);
    $gsent_unico->execute(array(
    $Idventa   
    ));
    $resultado_unico = $gsent_unico->fetch();
      //var_dump($resultado_unico); 

<<<<<<< HEAD
}?>
=======
}
?>
>>>>>>> feature

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO VENTAS</title>
 </head>
    <body>
        <div class="contenedor" >
            <?php if (!$_GET): ?>
                <h2>AGREGAR DATOS VENTAS</h2>  
                <form method="POST" >
                    FECHA:</br> 
                    <input type="text" class="formulario" name="Fecha"></br>
                    PRODUCTO:</br> 
                    <input type="text" class="formulario" name="Producto"></br>
                    CANTIDAD:</br> 
                    <input type="text" class="formulario" name="Cantidad"></br>
                    VALOR_UNITARIO:</br> 
                    <input type="text" class="formulario" name="Valor_Unitario"></br></br>
                    <button>Agregar</button>
                </form>
            <?php endif ?>

            <?php if ($_GET): ?>
                <h2>EDITAR DATOS</h2>  
                <form method="GET" action="editarventas.php" >
                    FECHA:</br> 
                    <input type="text" class="formulario" name="Fecha"
                    value="<?php echo $resultado_unico['Fecha'] ?>"></br>
                    
                    PRODUCTO:</br> 
                    <input type="text" class="formulario" name="Producto"
                    value="<?php echo $resultado_unico['Producto'] ?>"></br>
                    
                    CANTIDAD:</br> 
                    <input type="text" class="formulario" name="Cantidad"
                    value="<?php echo $resultado_unico['Cantidad'] ?>"></br>
                    
                    VALOR UNITARIO:</br> 
                    <input type="text" class="formulario" name="Valor_Unitario"
                    value="<?php echo $resultado_unico['Valor_Unitario'] ?>"></br>
                        
                    <input type="hidden" name="Idventa"
                    value="<?php echo $resultado_unico['Idventa'] ?>">
                    <button>Actualizar</button>
                </form>
            <?php endif ?>
        </div> 
        
        <div class="contenedor1" >
            <form method="GET" >
                <select name="mes" id="mes">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>Todo</option>                      
                </select>
                <select name="año" id="año">
                    <option>2022</option>
                    <option>2021</option>  
                </select>
                <input class="button" type="submit" name ="enviar" value="BUSCAR" />
            </form>
        </div> 

        <?php
         $nommes = $objfecha->nombremes(date('m'));
         echo "Mes Actual :".$nommes;

         if(isset($_GET['enviar']))
         {      
               $año = $_GET['año'];
               $mes = $_GET['mes'];
               echo $mes;
               echo $año;

               if ($mes == "Todo")
               {
                   $sql = 'SELECT * FROM Ventas WHERE  YEAR(Fecha) = ?';
                   $gsent= $pdo->prepare($sql);
                   $gsent->execute(array($año));
       
                   $resultado = $gsent->fetchAll();
                   //var_dump($resultado);
               
                   //SUMAR DATOS
                   $sqlsuma = 'SELECT  SUM(Valot_Total) 
                   FROM Ventas WHERE YEAR(Fecha) = ?';
                   $gsuma= $pdo->prepare($sqlsuma);
                   $gsuma->execute(array($año));

                   $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
                   //echo "<pre>";
                   //var_dump($resultadosuma);
                   //echo "</pre>";
                   
               }else
               {
                   
                   $sql = 'SELECT * FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
                   $gsent= $pdo->prepare($sql);
                   $gsent->execute(array($mes,$año));
       
                   $resultado = $gsent->fetchAll();
                   //var_dump($resultado);
                   
                   //SUMAR DATOS
                   $sqlsuma = 'SELECT  SUM(Cantidad),SUM(Valor_Total) 
                   FROM Ventas WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
                   $gsuma= $pdo->prepare($sqlsuma);
                   $gsuma->execute(array($mes,$año));

                   $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
                   //echo "<pre>";
                   //var_dump($resultadosuma);
                   //echo "</pre>";
               }                
           }  

        ?>

        </br>
        <div class="contenedor2" >
         <div class="fila">
              <div class="columna">
                 <table border=1>
                     <thead>
                         <td>FECHA</td>
                         <td>PRODUCTO</td>
                         <td>CANTIDAD</td>
                         <td>VALOR_UNITARIO</td>
                         <td>VALOR_TOTAL</td>
                     </thead>

                     <tbody>
                         <div class = "contenido"> 
                             <?php foreach($resultado as $rs):?>
                                 <tr>
                                     <td width="140"><?php echo $rs['Fecha']; ?></td>
                                     <td><?php echo $rs['Producto']; ?></td>
                                     <td><?php echo $rs['Cantidad']?></td>
                                     <td><?php echo $rs['Valor_Unitario']?></td>
                                     <td><?php echo $rs['Valor_Total']?></td>
                                     <td><a href="ventas.php?Idventa=<?php echo $rs['Idventa']?>"> Editar </a></td>
                    
                                 </tr>
                                <?php endforeach?>                 
                           </div>    

                     </tbody>
                    </table>
               </div> 
            </div>
       </div>
       
       <div class="contenedor3" >
         <p> CANTIDAD : <?php echo $totalsuma =$resultadosuma[0]?> </p>
         <p> TOTAL : <?php echo $totalsuma =$resultadosuma[1]?> </p>
       </div>    
      
    </body>
</html>

<?php
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>