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