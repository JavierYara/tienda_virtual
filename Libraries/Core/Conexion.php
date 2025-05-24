<?php
class Conexion{
	private $conect;

	public function __construct(){
		$connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
		try{
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,

		// CONFIGURACIÓN SSL PARA AZURE (OBLIGATORIO)
            PDO::MYSQL_ATTR_SSL_CA => true,
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            PDO::ATTR_TIMEOUT => 30,
                
		);			
	
		$this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD, $options);

		//echo "conexión exitosa";
		}catch(PDOException $e){
			$this->conect = 'Error de conexión';
		    echo "ERROR: " . $e->getMessage();
		}
	}

	public function conect(){
		return $this->conect;
	}

	// Método para verificar si la conexión es exitosa
    public function isConnected(){
        return $this->conect !== null && $this->conect instanceof PDO;
    }
    
    // Método para cerrar la conexión
    public function closeConnection(){
        $this->conect = null;
    }
}

?>