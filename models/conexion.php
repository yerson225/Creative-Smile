<?php
    // Obtener credenciales desde variables de entorno
$servidor   = getenv('DB_HOST');
$usuario    = getenv('DB_USERNAME') ?: getenv('DB_USER');  // Acepta ambos nombres
$contrasena = getenv('DB_PASSWORD') ?: getenv('DB_PASS');  // Acepta ambos nombres
$db         = getenv('DB_NAME');
$puerto     = getenv('DB_PORT') ?: 3306;  // Puerto por defecto para MySQL

$conexion = new mysqli($servidor, $usuario, $contrasena, $db, $puerto);
$conexion->set_charset('utf8');

if($conexion->connect_error){
    die("Falla en la conexión: " . $conexion->connect_error);
}
?>
