<?php
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "527316";
    $db = "copia_respaldo";

    $conexion = new mysqli($servidor, $usuario, $contrasena, $db);
    $conexion->set_charset('utf8');
    if($conexion -> connect_error){
        die("Falla en la conexión". $conexion-> connect_error);
    }

?>