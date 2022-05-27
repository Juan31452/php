<?php 

// class Conexion extends PDO { 
//   private $tipo_de_base = 'mysql';
//   private $host = 'localhost';
//   private $nombre_de_base = 'TIENDA';
 //  private $usuario = 'root';
 //  private $contrasena = ''; 

  // public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
  //    try{
   //      parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};host={$this->host};charset=utf8", $this->usuario, $this->contrasena);
    //  }catch(PDOException $e){
     //    echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
     //    exit;
     // }
  // } 
// } 


class DB{
   private $host;
   private $db;
   private $user;
   private $password;
   private $charset;

   public function __construct()
   {
       $this->host     = 'localhost';
       $this->db       = 'TIENDA';
       $this->user     = 'root';
       $this->password = '';
       //$this->password = "6#vWHD_$";
       $this->charset  = 'utf8mb4';
   }

   //mysql -e "USE todolistdb; select*from todolist" --user=azure --password=6#vWHD_$ --port=49175 --bind-address=52.176.6.0

   function connect(){
   
       try{

           
           $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
           $options = [
               PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_EMULATE_PREPARES   => false,
           ];
           //$pdo = new PDO($connection, $this->user, $this->password, $options);
           $pdo = new PDO($connection,$this->user,$this->password);
       
           return $pdo;


       }catch(PDOException $e){
           print_r('Error connection: ' . $e->getMessage());
       }   
   }
}

?>

