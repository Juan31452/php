<?php
include_once('conexion2.php');
//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Ventas';
$gsent= $pdo->prepare($sql);
$gsent->execute();

$resultado = $gsent->fetchAll();
//var_dump($resultado);
?>

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
        </div> 
        </br>
        <div class="contenedor1" >
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
                    
                                 </tr>
                                <?php endforeach?>                 
                           </div>    

                     </tbody>
                    </table>
               </div> 
            </div>
       </div>
    </body>
</html>

<?php
    include_once('conexion2.php');
    include_once('calculo.php');


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

    
 
?>


<?php
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>