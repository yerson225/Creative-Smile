<?php
session_start();
include_once __DIR__ . '/../Models/conexion.php';

// Validación de sesión (más segura)
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = '<div class="alert alert-danger">Debe iniciar sesión para registrar una cita.</div>';
    header('location: ../login.php');
    exit();
}

if (!empty($_POST['registrar'])) {
    if (
        !empty($_POST['fec']) &&
        !empty($_POST['ini']) &&
        !empty($_POST['fin']) &&
        !empty($_POST['doc']) &&
        !empty($_POST['tip']) &&
        !empty($_POST['dis'])
    ) {
        $fecha_cita = $_POST['fec'];
        $hora_inicial = $_POST['ini'];
        $hora_final = $_POST['fin'];
        $id_doctor = $_POST['doc'];
        $id_servicio = $_POST['tip'];
        $disponibilidad = $_POST['dis'];

        if ($conexion) {
            $sql_verificar = "SELECT * FROM citas_disponibles 
                              WHERE fecha_cita = ? AND hora_inicial = ? AND hora_final = ? 
                              AND id_doctor = ? AND id_servicio = ?";
            $stmt = $conexion->prepare($sql_verificar);
            $stmt->bind_param("sssii", $fecha_cita, $hora_inicial, $hora_final, $id_doctor, $id_servicio);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $_SESSION['mensaje'] = '<div class="alert alert-warning">Ya existe una cita para esa fecha, hora, doctor y especialidad.</div>';
            } else {
                $sql_insert = "INSERT INTO citas_disponibles 
                               (fecha_cita, hora_inicial, hora_final, id_doctor, id_servicio, disponibilidad)
                               VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conexion->prepare($sql_insert);
                $stmt_insert->bind_param("sssiii", $fecha_cita, $hora_inicial, $hora_final, $id_doctor, $id_servicio, $disponibilidad);

                if ($stmt_insert->execute()) {
                    $_SESSION['mensaje'] = '<div class="alert alert-success">Cita registrada correctamente.</div>';
                } else {
                    $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar la cita.</div>';
                }
            }
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error de conexión a la base de datos.</div>';
        }
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-warning">Por favor, completa todos los campos.</div>';
    }

    header("Location: ../registrarCita.php");
    exit();
}
?>
