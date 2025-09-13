<?php
session_start();
include_once 'Models/conexion.php';

if (!isset($_SESSION['nombre'])) { 
    header('location: login.php');
    exit();
}

$nombreUsuario = $_SESSION['nombre'];
$hoy = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e0bbff, #957dad);
        }

        header {
            background-color: #6a1b9a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #9c4dcc;
        }

        .container {
            max-width: 900px;
            margin-top: 40px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            background-color: #6a1b9a;
            color: white;
        }

        .btn:hover {
            background-color: #9c4dcc;
        }
    </style>
</head>
<body>

<header>
    <h1>Creative Smile</h1>
    <nav>
        <ul>
            <li><a href="/vistas/interfazAsistente.php">Inicio</a></li>
            <li><a href="../registrarCita.php">Registrar Cita</a></li>
            <li><a href="../mostrarDoctor.php">Doctores</a></li>
            <li><a href="../modificarDatosAsistente.php">Actualizar datos</a></li>
            <li><a href="../cerrarCesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="form-container">
        <h2>Registrar Cita</h2>

        <!-- ✅ Mostrar mensajes -->
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        ?>

        <form action="controllers/CitasDisponibles.php" method="POST" enctype="multipart/form-data">
            <!-- DOCTOR -->
            <!-- DOCTOR -->
<div class="form-group">
    <label for="doctor">Doctor:</label>
    <select class="form-control" name="doc" id="id_doctor" required>
        <option value="">Seleccione el doctor</option>
        <?php
        $sql = "SELECT doctor.id_doctor, usuario.nombre, servicios.id_servicio, servicios.especialidad
                FROM doctor 
                JOIN usuario ON doctor.id_usuario = usuario.id_usuario
                JOIN servicios ON doctor.id_servicio = servicios.id_servicio
                WHERE doctor.activo = 1;";
        $resultado = $conexion->query($sql);

        while ($doctor = $resultado->fetch_assoc()) {
            echo "<option value='" . $doctor['id_doctor'] . "' 
                        data-idservicio='" . $doctor['id_servicio'] . "' 
                        data-nombreservicio='" . $doctor['especialidad'] . "'>" 
                        . $doctor['nombre'] . 
                 "</option>";
        }
        ?>
    </select>
</div>

            <!-- HORA INICIAL -->
            <div class="form-group">
                <label for="hora_inicio">Hora inicial:</label>
                <select class="form-control" name="ini" required>
                    <option value="">Seleccione hora inicial</option>
                    <?php
                    for ($hora = 7; $hora <= 19; $hora++) {
                        $hora_formato = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00";
                        $hora_AmPm = date("h:i A", strtotime($hora_formato)); 
                        echo "<option value='$hora_formato'>$hora_AmPm</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- HORA FINAL -->
            <div class="form-group">
                <label for="hora_final">Hora final:</label>
                <select class="form-control" name="fin" required>
                    <option value="">Seleccione hora final</option>
                    <?php
                    for ($h = 8; $h <= 20; $h++) {
                        $Hora = str_pad($h, 2, "0", STR_PAD_LEFT) .":00";
                        $Am_Pm = date("h:i A", strtotime($Hora)); 
                        echo "<option value='$Hora'>$Am_Pm</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- FECHA -->
            <div class="form-group">
                <label for="fecha_cita">Fecha de cita:</label>
                <input type="date" id="fecha_cita" name="fec" min="<?= $hoy ?>" required />
            </div>

            <!-- ESPECIALIDAD (AUTOMÁTICA) -->
            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <input type="text" id="especialidad_nombre" class="form-control" disabled>
                <input type="hidden" id="id_servicio" name="tip">
            </div>

            <!-- DISPONIBILIDAD -->
            <input type="hidden" name="dis" value="1" />

            <!-- BOTÓN -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary" name="registrar" value="ok">Registrar</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT PARA ACTUALIZAR ESPECIALIDAD AUTOMÁTICAMENTE -->
<script>
document.getElementById('id_doctor').addEventListener('change', function () {
    let selected = this.options[this.selectedIndex];
    let especialidadNombre = selected.getAttribute('data-nombreservicio');
    let especialidadID = selected.getAttribute('data-idservicio');

    document.getElementById('especialidad_nombre').value = especialidadNombre || '';
    document.getElementById('id_servicio').value = especialidadID || '';
});
</script>

</body>
</html>
