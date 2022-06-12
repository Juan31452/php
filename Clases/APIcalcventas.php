<?php
include_once '../php/Clases/Claseventas.php';

class APIcalcventas
{
    function getAll(){
        $miventa = new Claseventas();
        $venta = array();
        //$venta = array();

        $res = $miventa->consulta1();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
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
