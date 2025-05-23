<?php 
	// URL base - Detecta automáticamente si está en Azure
	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
	$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
	
	// Si está en Azure, usar la URL de Azure, sino localhost
	if (strpos($host, 'tienda-virtual.azurewebsites.net') !== false) {
		$baseUrl = "https://tienda-virtual.azurewebsites.net";
	} else {
		$baseUrl = getenv('BASE_URL') ?: "http://localhost/tienda_virtual";
	}
	
	define('BASE_URL', $baseUrl);

	//Zona horaria
	date_default_timezone_set('America/Guatemala');

	//Datos de conexión a Base de Datos
	// En Azure usa variables de entorno, en local usa valores por defecto
	define('DB_HOST', getenv('DB_HOST') ?: "localhost");
	define('DB_NAME', getenv('DB_NAME') ?: "db_tiendavirtual");
	define('DB_USER', getenv('DB_USER') ?: "root");
	define('DB_PASSWORD', getenv('DB_PASSWORD') ?: "");
	define('DB_CHARSET', "utf8");

	//Para envío de correo
	define('ENVIRONMENT', getenv('ENVIRONMENT') ? (int)getenv('ENVIRONMENT') : 1);

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";
	const CURRENCY = "USD";

	//Api PayPal
	$paypalUrl = getenv('PAYPAL_URL') ?: "https://api-m.sandbox.paypal.com";
	define('URLPAYPAL', $paypalUrl);
	define('IDCLIENTE', getenv('PAYPAL_CLIENT_ID') ?: "");
	define('SECRET', getenv('PAYPAL_SECRET') ?: "");

	//Datos envio de correo
	define('NOMBRE_REMITENTE', getenv('MAIL_FROM_NAME') ?: "Tienda Virtual");
	define('EMAIL_REMITENTE', getenv('MAIL_FROM_ADDRESS') ?: "no-reply@abelosh.com");
	const NOMBRE_EMPESA = "Tienda Virtual";
	define('WEB_EMPRESA', getenv('WEB_EMPRESA') ?: "www.abelosh.com");

	const DESCRIPCION = "La mejor tienda en línea con artículos de moda.";
	const SHAREDHASH = "TiendaVirtual";

	//Datos Empresa
	const DIRECCION = "Avenida las Américas Zona 13, Guatemala";
	const TELEMPRESA = "+(502)78787845";
	const WHATSAPP = "+50278787845";
	const EMAIL_EMPRESA = "info@abelosh.com";
	const EMAIL_PEDIDOS = "info@abelosh.com"; 
	const EMAIL_SUSCRIPCION = "info@abelosh.com";
	const EMAIL_CONTACTO = "info@abelosh.com";

	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";
	const CAT_FOOTER = "1,2,3,4,5";

	//Datos para Encriptar / Desencriptar
	define('KEY', getenv('APP_KEY') ?: 'abelosh');
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 5;

	//Módulos
	const MDASHBOARD = 1;
	const MUSUARIOS = 2;
	const MCLIENTES = 3;
	const MPRODUCTOS = 4;
	const MPEDIDOS = 5;
	const MCATEGORIAS = 6;
	const MSUSCRIPTORES = 7;
	const MDCONTACTOS = 8;
	const MDPAGINAS = 9;

	//Páginas
	const PINICIO = 1;
	const PTIENDA = 2;
	const PCARRITO = 3;
	const PNOSOTROS = 4;
	const PCONTACTO = 5;
	const PPREGUNTAS = 6;
	const PTERMINOS = 7;
	const PSUCURSALES = 8;
	const PERROR = 9;

	//Roles
	const RADMINISTRADOR = 1;
	const RSUPERVISOR = 2;
	const RCLIENTES = 3;

	const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');

	//Productos por página
	const CANTPORDHOME = 8;
	const PROPORPAGINA = 4;
	const PROCATEGORIA = 4;
	const PROBUSCAR = 4;

	//REDES SOCIALES
	const FACEBOOK = "https://www.facebook.com/abelosh";
	const INSTAGRAM = "https://www.instagram.com/febel24/";

	// Configuración adicional para Azure
	if (ENVIRONMENT === 1 && strpos($_SERVER['HTTP_HOST'] ?? '', 'tienda-virtual.azurewebsites.net') !== false) {
		// Headers de seguridad para producción
		header('X-Content-Type-Options: nosniff');
		header('X-Frame-Options: DENY');
		header('X-XSS-Protection: 1; mode=block');
		
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
			header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
		}
		
		// Configuración de sesiones seguras
		ini_set('session.cookie_secure', '1');
		ini_set('session.cookie_httponly', '1');
		ini_set('session.use_strict_mode', '1');
		
		// Ocultar errores en producción
		error_reporting(0);
		ini_set('display_errors', 0);
	}

 ?>