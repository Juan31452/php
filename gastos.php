<?php
    include_once('conexion2.php');
    require_once('Clases/fecha.php');

    //LEER DATOS se reemplaza por BUSCAR DATOS
    $mes_actual = date('m');
    $año_actual = date('Y');
    echo $mes_actual;
    echo $año_actual;

    $sql = 'SELECT * FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
    $gsent= $pdo->prepare($sql);
    $gsent->execute(array($mes_actual,$año_actual));

    //se instancia clase fecha_actual
    $objfecha = new fecha_actual(date('m'),date('Y'));
    echo $objfecha->mes_actual;
    echo $objfecha->año_actual;

    //LEER DATOS se reemplaza por BUSCAR DATOS
    $sql = 'SELECT * FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
    $gsent= $pdo->prepare($sql);
    $gsent->execute(array($objfecha->mes_actual,$objfecha->año_actual));
    $resultado = $gsent->fetchAll();
    //var_dump($resultado);

    //SUMAR DATOS
    $sqlsuma = 'SELECT SUM(Valor_Total) 
    FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
    $gsuma= $pdo->prepare($sqlsuma);
    $gsuma->execute(array($mes_actual,$año_actual));
    $sqlsuma = 'SELECT  SUM(Valor_Total) 
    FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
    $gsuma= $pdo->prepare($sqlsuma);
    $gsuma->execute(array($objfecha->mes_actual,$objfecha->año_actual));


    $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
    echo "<pre>";
    var_dump($resultadosuma);
    echo "</pre>";

    //Creamos el JSON
    $json_string = json_encode($resultado);
    echo $json_string;

    foreach($resultado as $rs):
        echo $rs['Fecha'];
        echo $rs['Producto'];
        echo $rs['Descripcion'];
        echo $rs['Valor_Total'];
    endforeach ;

    
    
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

    //EDITAR DATOS
    if (isset($_GET['Idgastos']))
    {
        $Idgastos = $_GET['Idgastos'];
        $sql_unico = 'SELECT * FROM Gastos WHERE Idgastos=?';
        $gsent_unico= $pdo->prepare($sql_unico);
        $gsent_unico->execute(array(
        $Idgastos   
        ));
        $resultado_unico = $gsent_unico->fetch();
        var_dump($resultado_unico); 

    } 

    if(isset($_GET['enviar']))
    {      
        $año = $_GET['año'];
        $mes = $_GET['mes'];
        $nommes = $objfecha->nombremes(date('m'));
        echo "Mes Actual :".$nommes;
             
        if(isset($_GET['enviar']))
        {      
        $año = $_GET['año'];
        $mes = $_GET['mes'];

        //echo $mes;
        //echo $año;
        $sql = 'SELECT * FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
        $gsent= $pdo->prepare($sql);
        $gsent->execute(array($mes,$año));
        
        $resultado = $gsent->fetchAll();
        //var_dump($resultado);
                    
        //SUMAR DATOS
        $sqlsuma = 'SELECT  SUM(Valor_Total) 
        FROM Gastos WHERE MONTH(Fecha) = ? AND YEAR(Fecha) = ?';
        $gsuma= $pdo->prepare($sqlsuma);
        $gsuma->execute(array($mes,$año));
        $resultadosuma = $gsuma->fetch(PDO::FETCH_NUM);
        //echo "<pre>";
        //var_dump($resultadosuma);
        //echo "</pre>";
                               

    } 


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
            
            <?php if ($_GET): ?>
                <h2>EDITAR DATOS</h2>  
                <form method="GET" action="editargastos.php" >
                    FECHA:</br> 
                    <input type="text" class="formulario" name="Fecha"
                    value="<?php echo $resultado_unico['Fecha'] ?>"></br>
                    
                    PRODUCTO:</br> 
                    <input type="text" class="formulario" name="Producto"
                    value="<?php echo $resultado_unico['Producto'] ?>"></br>
                    
                    DESCRIPCION:</br> 
                    <input type="text" class="formulario" name="Descripcion"
                    value="<?php echo $resultado_unico['Descripcion'] ?>"></br>
                    
                    VALOR TOTAL:</br> 
                    <input type="text" class="formulario" name="Valor_Total"
                    value="<?php echo $resultado_unico['Valor_Total'] ?>"></br>
                        
                    <input type="hidden" name="Idgastos"
                    value="<?php echo $resultado_unico['Idgastos'] ?>">
                    <button>Actualizar</button>
                </form>
            <?php endif ?>
        </div> 
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
       
       <div class="contenedor2" >
          <p> TOTAL : <?php echo $totalsuma =$resultadosuma[0]?> </p>
        </div>

    </body>
</html>

<?php


//cerrar conexion
$pdo=null;
$sentencia_agrega = null;
$resultado = null;

?>