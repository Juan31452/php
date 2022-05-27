<?php
include_once('conexion2.php');

//EDITAR DATOS
if (isset($_GET['Idproducto']))
{
  $Idproducto = $_GET['Idproducto'];
  $sql_unico = 'SELECT * FROM Productos WHERE Idproducto=?';
  $gsent_unico= $pdo->prepare($sql_unico);
  $gsent_unico->execute(array(
   $Idproducto   
  ));
  $resultado_unico = $gsent_unico->fetchAll();
  //var_dump($resultado_unico); 
  
  //echo "intentando obtener registros <br>";
   // $results = $resultado_unico = $gsent_unico->fetch(PDO::FETCH_NUM);
    //echo json_encode($results);
   
    
   if ($resultado_unico)

  {
  
    //Creamos un array donde almacenaremos la data obtenida
	  $array = [];
    foreach($resultado_unico as $res)
    {
      $array[] = array_map('utf8_encode',$res);
    } 
    //print_r($array);
    echo json_encode($array);
       
  }

  else
  {
    echo "No hay registros";      
  }

    
}
?>

<?php
//cerrar conexion
$pdo=null;
$resultado_unico = null;

?>