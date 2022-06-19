<?php

include_once ('../php/Clases/Claseproduccion.php');

class APIproduccion
{
    function getAll(){
        $miproduccion = new Claseproduccion();
        $produccion = array();
//        $produccion["items"] = array();
        $produccion = array();

        $res = $miproduccion->consulta();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Idproduccion" => $row['Idproduccion'],
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Cantidad" => $row['Cantidad'],
                    "Lote" => $row['Lote']
                    
                );
                array_push($produccion,$item);
            }
        
            echo json_encode($produccion);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function buscarporfecha($mes,$año){
        $miproduccion = new Claseproduccion();
        $produccion = array();
//        $produccion["items"] = array();
        $produccion = array();

        $res = $miproduccion->consulta3($mes,$año);

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Idproduccion" => $row['Idproduccion'],
                    "Fecha" => $row['Fecha'],
                    "Producto" => $row['Producto'],
                    "Cantidad" => $row['Cantidad'],
                    "Lote" => $row['Lote']
                    
                );
                array_push($produccion,$item);
            }
        
            echo json_encode($produccion);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
    
    function agregar($item)
    {
        $miproduccion = new Claseproduccion();
        $res = $miproduccion-> insertardatos($item);
        echo "Registro guardado con exito";

    }
    
}

class APIcalproduccion
{
    function getAll(){
        $miproduccion = new Claseproduccion();
        $produccion = array();
        //$venta = array();

        $res = $miproduccion->consulta1();

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Cantidad" => $row['Cantidad'],
                    
                );
                array_push($produccion,$item);
            }
        
            echo json_encode($produccion);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
    
    function buscarporfecha($mes,$año){
        $miproduccion = new Claseproduccion();
        $produccion = array();
        //$venta = array();

        $res = $miproduccion->consulta2($mes,$año);

        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "Cantidad" => $row['Cantidad'],
                    
                );
                array_push($produccion,$item);
            }
        
            echo json_encode($produccion);
        }else{
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    } 
}

?>
