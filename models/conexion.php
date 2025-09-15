<?php
    // Obtener credenciales desde variables de entorno
$servidor   = getenv('DB_HOST');
$usuario    = getenv('DB_USER');
$contrasena = getenv('DB_PASS');
$db         = getenv('DB_NAME');
$puerto     = getenv('DB_PORT');

// TEMPORAL - Para depurar (quitar después de que funcione)
echo "<h3>Intentando conectar con:</h3>";
echo "Host: " . ($servidor ?: 'NO DEFINIDO') . "<br>";
echo "Usuario: " . ($usuario ?: 'NO DEFINIDO') . "<br>";
echo "Database: " . ($db ?: 'NO DEFINIDO') . "<br>";
echo "Puerto: " . ($puerto ?: 'NO DEFINIDO') . "<br>";
echo "<hr>";

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
    
    // TEMPORAL - Confirmar conexión exitosa
    echo "<div style='color: green; font-weight: bold;'>✅ Conexión exitosa a MySQL!</div><br>";
    
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
