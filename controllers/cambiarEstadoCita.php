<?php
session_start();
include_once '../Models/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cita'], $_POST['nuevo_estado'])) {
    $idCita = (int)$_POST['id_cita'];
    $nuevoEstado = (int)$_POST['nuevo_estado'];
    $idDoctor = $_SESSION['id_usuario'];

    // Obtener estado actual
    $consulta = "SELECT id_estado_citas FROM citas_agendadas WHERE id_citas_agendadas = $idCita";
    $resultado = mysqli_query($conexion, $consulta);
    $cita = mysqli_fetch_assoc($resultado);

    if ($cita && $cita['id_estado_citas'] == 1) { // Solo si la cita está programada
        $estadoAnterior = 'programada';
        $estadoNuevo = ($nuevoEstado == 5) ? 'asistida' : 'perdida';

        // Actualizar el estado de la cita
        $update = "UPDATE citas_agendadas 
                   SET id_estado_citas = $nuevoEstado, finalizado = 1 
                   WHERE id_citas_agendadas = $idCita";
        mysqli_query($conexion, $update);

        // Insertar en historial
        $insert = "INSERT INTO historial_citas 
                   (id_citas_agendadas, estado_anterior, estado_nuevo, observaciones, cambiado_por, fecha_cambio)
                   VALUES ($idCita, '$estadoAnterior', '$estadoNuevo', '', $idDoctor, NOW())";
        mysqli_query($conexion, $insert);

        header("Location: ../vistas/mostrarPacienteAsignado.php?msg=estado_actualizado");
        exit();
    } else {
        echo "No puedes cambiar el estado de esta cita.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
