<?php
    // Obtener credenciales desde variables de entorno
    $servidor   = getenv('DB_HOST');    // Host de la base de datos
    $usuario    = getenv('DB_USER');    // Usuario de la base de datos
    $contrasena = getenv('DB_PASS');    // Contraseña de la base de datos
    $db         = getenv('DB_NAME');    // Nombre de la base de datos

    // Crear la conexión
    $conexion = new mysqli($servidor, $usuario, $contrasena, $db);
    $conexion->set_charset('utf8');

    // Verificar conexión
    if($conexion->connect_error){
        die("Falla en la conexión: " . $conexion->connect_error);
    }
?>
