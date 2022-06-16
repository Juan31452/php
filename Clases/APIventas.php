<?php

include_once '../php/Clases/Claseventas.php';

class APIventas
{
    function getAll(){
        $miventa = new Claseventas();
        $venta = array();
        $venta = array();

        $res = $miventa->consulta();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Idventa" => $row['Idventa'],
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Cantidad" => $row['Cantidad'],
                    "Valor_Unitario" => $row['Valor_Unitario']

                );
                array_push($venta,$item);
            }
        
            echo json_encode($venta);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
}

?>
