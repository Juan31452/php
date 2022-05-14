<?php
include_once('conexion2.php');
include_once('calculo.php');

//LEER DATOS se reemplaza por BUSCAR DATOS
$sql = 'SELECT * FROM Productos';
$gsent= $pdo->prepare($sql);
$gsent->execute();

$resultado = $gsent->fetchAll();
//var_dump($resultado);


//BUSCAR DATOS
/*$sql = 'SELECT * FROM productos WHERE Descripcion LIKE :search';
$seach_terms = isset($_GET['Descripcion']) ?$_GET['Descripcion'] : '' ;

$arr_sql_terms[':search'] = '%' . $seach_terms. '%';

$statement = $pdo->prepare($sql);
$statement->execute($arr_sql_terms);
$results = $statement->fetchAll();*/

$sql = 'SELECT * FROM Productos WHERE 1 ';
$seach_terms = isset($_GET['Fecha']) ?$_GET['Fecha'] : '' ;
$search_arr = explode(' ', $seach_terms);

$arr_sql_terms = array();
$n = 0;
foreach( $search_arr as $search_term )
{

  $sql .= " AND Fecha LIKE :search{$n}";
  $arr_sql_terms[":search{$n}"] = '%' . $search_term . '%';
  $n++;
}

$statement = $pdo->prepare($sql);
$statement->execute($arr_sql_terms);
$results = $statement->fetchAll();
//var_dump($results);
//header('location:index.php');

//ADICIONAR DATOS
if ($_POST)
{
    $Fecha = $_POST['Fecha'];
    $Descripcion = $_POST['Descripcion'];
    $Cantidad =  $_POST['Cantidad'];
    $Valor_Unitario = $_POST['Valor_Unitario'];
    $Valor_Total = multiplica($Cantidad,$Valor_Unitario);
    $sql_agregar = 'INSERT INTO Productos(Fecha,Descripcion,
    Cantidad,Valor_Unitario,Valor_Total)
    VALUES (?,?,?,?,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);
    $sentencia_agregar->execute(array(
     $Fecha,$Descripcion,$Cantidad,
     $Valor_Unitario,$Valor_Total   
    ));
    
   // header('Location:index.php');

    
}/*
//EDITAR DATOS
if (isset($_GET['Idproducto']))
{
  $Idproducto = $_GET['Idproducto'];
  $sql_unico = 'SELECT * FROM Productos WHERE Idproducto=?';
  $gsent_unico= $pdo->prepare($sql_unico);
  $gsent_unico->execute(array(
   $Idproducto   
  ));
  $resultado_unico = $gsent_unico->fetch();
<<<<<<< HEAD
/*  var_dump($resultado_unico);*/ 
=======
/*  var_dump($resultado_unico); 
>>>>>>> feature

}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <script>
    function borrar_registro(Idborrar)
    {
       var confirmacion = confirm('Esta seguro de eliminar este registro')
    }
  </script>   
</head>
<body>
   <div class="contenedor" >
    <div class="fila">
        <div class="columna">
           <table border=1>
               <thead>
               <form method="get">
                BUSCAR : 
                <input type="text" class="formulario" name="Fecha" value = "<?php echo $seach_terms; ?>">
                <input class="button" type="submit" value="BUSCAR" />
               </form>
               
               <td>FECHA</td>
               <td>DESCRIPCION</td>
               <td>CANTIDAD</td>
               <td>VALOR UNITARIO</td>
               <td>VALOR TOTAL</td>
               </thead>

               <tbody>
                  
                  <?php foreach($results as $rs):?>
                  <div class = "contenido">
                   <tr>
                        <td width="300"><?php echo $rs['Fecha']; ?></td>
                        <td><?php echo $rs['Descripcion']; ?></td>
                        <td><?php echo $rs['Cantidad']?></td>
                        <td><?php echo $rs['Valor_Unitario']?></td>
                        <td><?php echo $rs['Valor_Total']?></td>
                        <td><a href="index.php?Idproducto=<?php echo $rs['Idproducto']?>"> Editar </a></td>
                        <td><a href="eliminar.php?Idproducto=<?php echo $rs['Idproducto']?>"> Eliminar </a></td>
                   </tr>                 
                   <?php endforeach?>                 
                 </div>    
              </tbody>
	        </table>
         </div> 
      </div>

   </div>

   <div class="contenedor1" >
     <?php if (!$_GET): ?>
      <h2>AGREGAR DATOS</h2>  
      <form method="POST" >
         FECHA:</br> 
         <input type="text" class="formulario" name="Fecha"></br>
         DESCRIPCION:</br> 
         <input type="text" class="formulario" name="Descripcion"></br>
         CANTIDAD:</br> 
         <input type="text" class="formulario" name="Cantidad"></br>
         VALOR UNITARIO:</br>
         <input type="text" class="formulario" name="Valor_Unitario"></br>
         <button>Agregar</button>
      </form>
      <?php endif ?>
      
      <?php if ($_GET): ?>
      <h2>EDITAR DATOS</h2>  
      <form method="GET" action="editar.php" >
         FECHA:</br> 
         <input type="text" class="formulario" name="Fecha"
         value="<?php echo $resultado_unico['Fecha'] ?>"></br>
         
         DESCRIPCION:</br> 
         <input type="text" class="formulario" name="Descripcion"
         value="<?php echo $resultado_unico['Descripcion'] ?>"></br>
         
         CANTIDAD:</br> 
         <input type="text" class="formulario" name="Cantidad"
         value="<?php echo $resultado_unico['Cantidad'] ?>"></br>
         
         VALOR UNITARIO:</br> 
         <input type="text" class="formulario" name="Valor_Unitario"
         value="<?php echo $resultado_unico['Valor_Unitario'] ?>"></br>
              
         <input type="hidden" name="Idproducto"
         value="<?php echo $resultado_unico['Idproducto'] ?>">
         <button>Actualizar</button>
      </form>
      <?php endif ?>
      
   </div>


</body>
</html>

<?php
//cerrar conexion
$pdo=null;
$sentencia_eliminar = null;

?>