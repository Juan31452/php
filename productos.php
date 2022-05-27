<?php
  include_once('conexion2.php');

  //ADICIONAR DATOS
    if (isset($_POST['Nombre']))
    {
       
        $Nombre = $_POST['Nombre'];
        $Descripcion = $_POST['Descripcion'];
        $Img = $_POST['Imagen'];
        $Cantidad =  $_POST['Cantidad'];
        $Valor_Unitario = $_POST['Valor_Unitario'];
        $sql_agregar = "INSERT INTO Productos(Idproducto,Nombre,Descripcion,
        Imagen,Cantidad,Valor_Unitario)
        VALUES (null,?,?,?,?,?)";
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array(
        $Nombre,$Descripcion,$Img,
        $Cantidad,$Valor_Unitario   
        ));
        /*
        if ($sql_agregar) {
        echo "<p>Registro agregado.</p>";
        } else {
        echo "<p>No se agregó...</p>";
        }

        header('Location:productos.html');
          */  
    }
    
?>



<?php
//cerrar conexion
$pdo=null;
$sentencia_agrega = null;

?>