<?php
include("models/conexion.php");
session_start();

// Asegurarse de que el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = 'Debes iniciar sesión primero';
    header('Location: ../login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_cita'])) {
    $id_cita = $_GET['id_cita'];
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta para obtener el id_doctor desde la cita disponible
    $consulta = "SELECT id_doctor FROM citas_disponibles WHERE id_cita = ?";
    if ($stmt = $conexion->prepare($consulta)) {
        $stmt->bind_param("i", $id_cita);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $id_doctor = $fila['id_doctor'];
            $id_estado_citas = 1;

            // Insertar la cita en la tabla de citas agendadas
            $sql = "CALL agendar_cita(?, ?, ?, ?)";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("iiii", $id_usuario, $id_doctor, $id_estado_citas, $id_cita);

                if ($stmt->execute()) {
                    $_SESSION['mensaje'] = 'Cita agendada exitosamente';
                } else {
                    $_SESSION['mensaje'] = 'Error al agendar la cita';
                }
            } else {
                $_SESSION['mensaje'] = 'Error al preparar la consulta para agendar la cita';
            }
        } else {
            $_SESSION['mensaje'] = 'La cita seleccionada no existe';
        }
    } else {
        $_SESSION['mensaje'] = 'Error al preparar la consulta para obtener los datos de la cita';
    }

    // Redirigir nuevamente a la página de AgendarCita.php
    header('location: AgendarCita.php');
    exit();
}
?>
