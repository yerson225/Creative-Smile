<?php
    // Obtener credenciales desde variables de entorno
$servidor   = getenv('DB_HOST');
$usuario    = getenv('DB_USER');
$contrasena = getenv('DB_PASS');
$db         = getenv('DB_NAME');
$puerto     = getenv('DB_PORT');  // NUEVO

$conexion = new mysqli($servidor, $usuario, $contrasena, $db, $puerto);
$conexion->set_charset('utf8');

if($conexion->connect_error){
    die("Falla en la conexión: " . $conexion->connect_error);
}

?>
