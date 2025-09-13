<?php
session_start();
include_once '../Models/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cita'], $_POST['motivo'])) {
    $idCitaAgendada = intval($_POST['id_cita']);
    $motivo = mysqli_real_escape_string($conexion, $_POST['motivo']);
    $idUsuario = $_SESSION['id_usuario'];

    // Verificar que la cita pertenece al usuario y está programada
    $consulta = "SELECT id_estado_citas FROM citas_agendadas 
                 WHERE id_citas_agendadas = $idCitaAgendada AND id_usuario = $idUsuario";
    $resultado = mysqli_query($conexion, $consulta);
    $datos = mysqli_fetch_assoc($resultado);

    if ($datos && $datos['id_estado_citas'] == 1) { // 1 = programada
        // Cambiar estado a cancelado (3) y marcar finalizado
        $update = "UPDATE citas_agendadas 
                   SET id_estado_citas = 3, finalizado = 1 
                   WHERE id_citas_agendadas = $idCitaAgendada";
        mysqli_query($conexion, $update);

        // Insertar en historial de cambios
        $insert = "INSERT INTO historial_citas 
                   (id_citas_agendadas, estado_anterior, estado_nuevo, observaciones, cambiado_por, fecha_cambio)
                   VALUES ($idCitaAgendada, 'programada', 'cancelado', '$motivo', $idUsuario, NOW())";
        mysqli_query($conexion, $insert);

        // Redirigir con mensaje
        header("Location:../mostrarCitaActual.php?msg=cita_cancelada");
        exit();
    } else {
        echo "❌ No puedes cancelar esta cita.";
    }
} else {
    echo "❌ Solicitud no válida.";
}
?>
