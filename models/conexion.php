<?php
    // Obtener credenciales desde variables de entorno
$servidor   = getenv('DB_HOST');
$usuario    = getenv('DB_USER');
$contrasena = getenv('DB_PASS');
$db         = getenv('DB_NAME');
$puerto     = getenv('DB_PORT');


// Verificar que todas las variables existan
if (!$servidor || !$usuario || !$contrasena || !$db || !$puerto) {
    die("Error: Faltan variables de entorno. Revisa la configuración en Azure.");
}

// Crear conexión MySQL
try {
    $conexion = new mysqli($servidor, $usuario, $contrasena, $db, $puerto);
    
    // Configurar charset
    $conexion->set_charset('utf8');
    
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Falla en la conexión MySQL: " . $conexion->connect_error);
    }
    

    
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
