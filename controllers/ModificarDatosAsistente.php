<?php
include_once 'Models/conexion.php';



$row = [];

// Asegurarse de que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header('location: login.php');
    exit();
}

$id = $_SESSION['id_usuario'];

// 1. OBTENER LOS DATOS DEL USUARIO
$sql = "SELECT * FROM usuario WHERE id_usuario = '$id'";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
}

// 2. ACTUALIZAR DATOS SI SE ENVÍA EL FORMULARIO
if (isset($_POST['modificar'])) {
    $nom = $_POST['nom'];
    $ape = $_POST['ape'];
    $tip = $_POST['tip'];
    $fec = $_POST['fec'];
    $cor = $_POST['cor'];
    $dir = $_POST['Dir'];

    // Validación y seguridad (simple para este ejemplo)
    $nom = mysqli_real_escape_string($conexion, $nom);
    $ape = mysqli_real_escape_string($conexion, $ape);
    $fec = mysqli_real_escape_string($conexion, $fec);
    $cor = mysqli_real_escape_string($conexion, $cor);
    $dir = mysqli_real_escape_string($conexion, $dir);

    $updateSql = "UPDATE usuario SET nombre='$nom', apellido='$ape', fecha_de_nacimiento='$fec', tipo_identificacion='$tip', correo='$cor', Direccion='$dir' WHERE id_usuario='$id'";

    if ($conexion->query($updateSql)) {
        echo "<div class='alert alert-success'>Datos actualizados correctamente.</div>";

        // Volver a cargar datos actualizados
        $resultado = $conexion->query("SELECT * FROM usuario WHERE id_usuario = '$id'");
        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
        }

    } else {
        echo "<div class='alert alert-danger'>Error al actualizar: " . $conexion->error . "</div>";
    }
}
?>