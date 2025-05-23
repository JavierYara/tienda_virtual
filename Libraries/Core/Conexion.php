<?php
class Conexion{
	private $conect;

	public function __construct(){
		$connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
		try{
			$this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo "conexión exitosa";

            // Configuraciones adicionales para Azure MySQL
			$this->conect->setAttribute(PDO::ATTR_TIMEOUT, 30);
			$this->conect->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			
		}catch(PDOException $e){
			$this->conect = 'Error de conexión';
		    echo "ERROR: " . $e->getMessage();
		}
	}

	public function conect(){
		return $this->conect;
	}
}

?>