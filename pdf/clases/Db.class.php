<?php
  /* Clase encargada de gestionar las conexiones a la base de datos */
Class Db{

   private $servidor;
   private $usuario;
   private $password;
   private $base_datos;
   private $link;
   private $stmt;
   private $array;
   
   static $_instance;

   /*La funci�n construct es privada para evitar que el objeto pueda ser creado mediante new*/
   private function __construct(){
      $this->setConexion();
      $this->conectar();
   }

   /*M�todo para establecer los par�metros de la conexi�n*/
   private function setConexion(){
      $conf = Conf::getInstance();
      $this->servidor=$conf->getHostDB();
      $this->base_datos=$conf->getDB();
      $this->usuario=$conf->getUserDB();
      $this->password=$conf->getPassDB();
   }

   /*Evitamos el clonaje del objeto. Patr�n Singleton*/
   private function __clone(){ }

   /*Funci�n encargada de crear, si es necesario, el objeto. Esta es la funci�n que debemos llamar desde fuera de la clase para instanciar el objeto, y as�, poder utilizar sus m�todos*/
   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
         return self::$_instance;
   }

   /*Realiza la conexi�n a la base de datos.*/
   private function conectar(){
      $this->link=mysql_connect($this->servidor, $this->usuario, $this->password);
      mysql_select_db($this->base_datos,$this->link);
	  mysql_query ("SET NAMES 'utf8'");
	 //   @mysql_query("SET NAMES 'utf8'");
   }

   /*M�todo para ejecutar una sentencia sql*/
   public function ejecutar($sql){
   //	echo "<br>en la calse  $sql<br>";
      $this->stmt=mysql_query($sql,$this->link);
      return $this->stmt;
   }

   /*M�todo para obtener una fila de resultados de la sentencia sql*/
   public function obtener_fila($stmt,$fila){
      if ($fila==0){
         $this->array=mysql_fetch_array($stmt);
      }else{
         mysql_data_seek($stmt,$fila);
         mysql_data_seek($stmt,$fila);
         $this->array=mysql_fetch_array($stmt);
      }
      return $this->array;
   }

   //Devuelve el �ltimo id del insert introducido
   public function lastID(){
      return mysql_insert_id($this->link);
   }

}


?>