<?php
include_once('conexion2.php');
//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Gastos';
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
    <title>REGISTRO GASTOS</title>
 </head>
    <body>
        <div class="contenedor" >
            <?php if (!$_GET): ?>
                <h2>AGREGAR GASTOS</h2>  
                <form method="POST" >
                    FECHA:</br> 
                    <input type="text" class="formulario" name="Fecha"></br>
                    PRODUCTO:</br> 
                    <input type="text" class="formulario" name="Producto"></br>
                    DESCRIPCION:</br> 
                    <input type="text" class="formulario" name="Descripcion"></br>
                    VALOR_TOTAL:</br> 
                    <input type="text" class="formulario" name="Valor_Total"></br></br>
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
                         <td>DESCRIPCION</td>
                         <td>VALOR_TOTAL</td>
                     </thead>

                     <tbody>
                         <div class = "contenido"> 
                             <?php foreach($resultado as $rs):?>
                                 <tr>
                                     <td width="140"><?php echo $rs['Fecha']; ?></td>
                                     <td><?php echo $rs['Producto']; ?></td>
                                     <td><?php echo $rs['Descripcion']?></td>
                                     <td><?php echo $rs['Valor_Total']?></td>
                                     <td><a href="gastos.php?Idgastos=<?php echo $rs['Idgastos']?>"> Editar </a></td>

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

    //ADICIONAR DATOS
    if ($_POST)
    {
        $Fecha = $_POST['Fecha'];
        $Producto = $_POST['Producto'];
        $Descripcion =  $_POST['Descripcion'];
        $Valor_Total =  $_POST['Valor_Total'];
        
        $sql_agregar = 'INSERT INTO Gastos(Fecha,Producto,
        Descripcion,Valor_Total)
        VALUES (?,?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Fecha,$Producto,$Descripcion,$Valor_Total 
        ));
       /*
        if ($sql_agregar) {
            echo "<p>Registro agregado.</p>";
            } else {
            echo "<p>No se agregó...</p>";
        }
        */
     header('Location:gastos.php');
    }

    
 
?>


<?php
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>