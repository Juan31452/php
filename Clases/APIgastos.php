<?php

include_once '../php/Clases/Clasegastos.php';

class APIgastos
{
    function getAll(){
        $migasto = new Clasegastos();
        $gasto = array();
        $gasto = array();

        $res = $migasto->consulta();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Idgastos" => $row['Idgastos'],
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Descripcion" => $row['Descripcion'],
                    "Valor_Total" => $row['Valor_Total']

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
