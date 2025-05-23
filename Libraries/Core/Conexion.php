<?php 
/**
 * Clase de conexión compatible con Azure Database for MySQL
 * Reutiliza las constantes de tu Config.php existente
 */

class Conexion {
    private $conect;
    
    public function __construct() {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $username = DB_USER;
            $password = DB_PASSWORD;
            
            // Si es Azure Database for MySQL (tu servidor específico)
            if (strpos(DB_HOST, 'databaseproyecto.mysql.database.azure.com') !== false) {
                // Agregar nombre del servidor al usuario si no lo tiene
                if (strpos(DB_USER, '@') === false) {
                    $serverName = explode('.', DB_HOST)[0];
                    $username = DB_USER . '@' . $serverName;
                }
                
                // Configuración SSL para Azure
                $options[PDO::MYSQL_ATTR_SSL_CA] = true;
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }
            
            $this->conect = new PDO($connectionString, $username, $password, $options);
            
        } catch (PDOException $e) {
            error_log('Error de conexión: ' . $e->getMessage());
            
            // En desarrollo mostrar error, en producción ocultarlo
            if (ENVIRONMENT === 0) {
                die('Error de conexión: ' . $e->getMessage());
            } else {
                die('Error de conexión a la base de datos');
            }
        }
    }
    
    public function conect() {
        return $this->conect;
    }
}
?>