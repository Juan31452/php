<?php

  if($_SERVER["REQUEST_METHOD"]=="GET")
   {
       require_once 'conexion1.php';
       $Idproducto=$_GET['Idproducto'];
       $query="SELECT * FROM Productos WHERE Idproducto ='".$Idproducto."'";
       $resultado = $mysql->query($query);
       /*var_dump($resultado);*/ 
       
       if ($mysql->affected_rows>0)
       {
           while($row=$resultado->fetch_assoc())
           {
               $array[] = ($row);
           } 
           //print_r($array);
           echo json_encode($array);
        
        }else{
           echo "No hay registros";      
       }  
       $resultado->close();
       $mysql->close(); 
    }
?>