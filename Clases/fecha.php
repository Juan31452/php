<?php
class fecha_actual
{
    // Propiedades
    public $mes_actual;
    public $año_actual;
    public $titulo = null;

    // Constructor:
    public function __construct($mes,$año) 
    {
       $this->mes_actual = $mes;
       $this->año_actual = $año; 
       echo "<p>En el Constructor de la Clase</p>";
    }

    // Destructor:
    function __destruct() 
    {
        echo "<p>En el Destructor de la Clase</p>";
    }

    public function nombremes($mes)
    {
        if ($mes==01)
        {
          $mes = "Enero";
          return $mes;
        }
        if ($mes==02)
        {
          $mes = "Febrero";
          return $mes;
        }
        if ($mes==03)
        {
          $mes = "Marzo";
          return $mes;
        }
        if ($mes==04)
        {
          $mes = "Abril";
          return $mes;
        }
        if ($mes==05)
        {
          $mes = "Mayo";
          return $mes;
        }

        if ($mes==06)
        {
          $mes = "Junio";
          return $mes;
        }
       
      }

    // Métodos:
    public function getmes_actual() 
    {
       return $this->mes_actual;
    }
    
    public function setmes_actual( $mes ) 
    {
        $this->mes_actual = $mes;
    }
    
    public function getaño_actual() 
    {
        return $this->año_actual;
    }
    
    public function setaño_actual( $año ) 
    {
        $this->año_actual = $año;
    }
    
}
?>