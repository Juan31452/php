<?php
    require_once('Clases/fecha.php');
    include_once('conexion2.php');
    //se instancia clase fecha_actual
    $objfecha = new fecha_actual(date('m'),date('Y'));
    echo $objfecha->mes_actual;
    echo $objfecha->año_actual;

    //LEER DATOS se reemplaza por BUSCAR DATOS
    $sql = 'SELECT * FROM Produccion WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
    $gsent= $pdo->prepare($sql);
    $gsent->execute(array($objfecha->mes_actual,$objfecha->año_actual));

    $resultado = $gsent->fetchAll();
    //var_dump($resultado);

    //SUMAR DATOS
    $sqlsuma = 'SELECT  SUM(Cantidad) 
    FROM Produccion WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
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
        $Lote =  $_POST['Lote'];

        $sql_agregar = 'INSERT INTO Produccion(Fecha,Producto,
        Cantidad,Lote)
        VALUES (?,?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Fecha,$Producto,$Cantidad,$Lote 
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
    //EDITAR DATOS
    if (isset($_GET['Idproduccion']))
    {
        $Idproduccion = $_GET['Idproduccion'];
        $sql_unico = 'SELECT * FROM Produccion WHERE Idproduccion=?';
        $gsent_unico= $pdo->prepare($sql_unico);
        $gsent_unico->execute(array(
        $Idproduccion   
        ));
        $resultado_unico = $gsent_unico->fetch();
          /*var_dump($resultado_unico);*/ 

    }

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
                    <input type="text" class="formulario" name="Cantidad"></br>
                    LOTE:</br> 
                    <input type="text" class="formulario" name="Lote"></br></br>
                    <button>Agregar</button>
                </form>
            <?php endif ?>

            <?php if ($_GET): ?>
            <h2>EDITAR DATOS</h2>  
            <form method="GET" action="editarproduccion.php" >
                FECHA:</br> 
                <input type="text" class="formulario" name="Fecha"
                value="<?php echo $resultado_unico['Fecha'] ?>"></br>
                
                PRODUCTO:</br> 
                <input type="text" class="formulario" name="Producto"
                value="<?php echo $resultado_unico['Producto'] ?>"></br>
                
                CANTIDAD:</br> 
                <input type="text" class="formulario" name="Cantidad"
                value="<?php echo $resultado_unico['Cantidad'] ?>"></br>
                
                LOTE:</br> 
                <input type="text" class="formulario" name="Lote"
                value="<?php echo $resultado_unico['Lote'] ?>"></br>
                    
                <input type="hidden" name="Idproduccion"
                value="<?php echo $resultado_unico['Idproduccion'] ?>">
                <button>Actualizar</button>
            </form>
            <?php endif ?>
            
<<<<<<< HEAD
        </div> 
=======
                </div> 
>>>>>>> feature
        </br>
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
                        $sql = 'SELECT * FROM Produccion WHERE  YEAR(Fecha) = ?';
                        $gsent= $pdo->prepare($sql);
                        $gsent->execute(array($año));
            
                        $resultado = $gsent->fetchAll();
                        //var_dump($resultado);
                    
                        //SUMAR DATOS
                        $sqlsuma = 'SELECT  SUM(Cantidad) 
                        FROM Produccion WHERE YEAR(Fecha) = ?';
                        $gsuma= $pdo->prepare($sqlsuma);
                        $gsuma->execute(array($año));

                        $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
                        //echo "<pre>";
                        //var_dump($resultadosuma);
                        //echo "</pre>";
                        
                    }else
                    {
                        
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
                        //echo "<pre>";
                        //var_dump($resultadosuma);
                        //echo "</pre>";
                    }    
<<<<<<< HEAD
                }  

=======
                     

                }  

            
>>>>>>> feature
            ?>

            </br>
         <div class="fila">
              <div class="columna">
                 <table border=1>
                     <thead>
                         <td>FECHA</td>
                         <td>PRODUCTO</td>
                         <td>CANTIDAD</td>
                         <td>LOTE</td>                        
                     </thead>

                     <tbody>
                         <div class = "contenido"> 
                             <?php foreach($resultado as $rs):?>
                                 <tr>
                                     <td width="140"><?php echo $rs['Fecha']; ?></td>
                                     <td><?php echo $rs['Producto']; ?></td>
                                     <td><?php echo $rs['Cantidad']?></td>
                                     <td><?php echo $rs['Lote']?></td>
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
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>