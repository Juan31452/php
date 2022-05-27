<?php

include_once 'Clases/Claseproduccion.php';

class APIproduccion
{
    function getAll(){
        $miproduccion = new Claseproduccion();
        $produccion = array();
        $produccion["items"] = array();

        $res = $miproduccion->consulta();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Cantidad" => $row['Cantidad'],
                    "Lote" => $row['Lote']
                    
                );
                array_push($produccion["items"], $item);
            }
        
            echo json_encode($produccion);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
}

?>
