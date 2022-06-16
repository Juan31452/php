<?php

include_once 'Clases/Claseventas.php';

class APIventas
{
    function getAll(){
        $miventa = new Claseventas();
        $gasto = array();
        $gasto = array();

        $res = $miventa->consulta();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Idventa" => $row['Idgasto'],
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Cantidad" => $row['Descripcion'],
                    "Valor_Unitario" => $row['Valor_Total']

                );
                array_push($gasto,$item);
            }
        
            echo json_encode($gasto);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
}

?>
