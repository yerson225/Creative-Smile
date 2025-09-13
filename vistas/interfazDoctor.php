<?php

session_start();
 if(isset($_SESSION['nombre']));

 
?>
   <h1>Doctor</h1>
   <p class ="text-light p-4"><?php echo $_SESSION['nombre'];?></p>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Doctor</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #e0bbff, #957dad);
            color: #fff;
        }

        /* Encabezado */
        header {
            background-color: #5e2d79;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 2.5em;
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 20px 0 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 20px;
            color: #fff;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #7d3e9d;
            border-color: #fff;
        }

        /* Sección principal */
        main {
            padding: 40px 20px;
            text-align: center;
        }

        main h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        /* Footer */
        footer {
            background-color: #5e2d79;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            color: #e0bbff;
            font-size: 0.9em;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Botones interactivos */
        button {
            background-color: #7d3e9d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b583d1;
        }
    </style>
</head>
<body>
    <header>
        <h1>creative smile</h1>
        <nav>
            <ul>
                <li><a href="/vistas/interfazDoctor.php">inicio</a></li>
                <li><a href="../mostrarPacienteAsignado.php">Mostrar cita actual</a></li>
                <li><a href="../modificarDatosDoctor.php ">actualizar datos</a></li>
                <li><a href="../cerrarCesion.php">Cerrar Sesión </a> </li>

                

   
               
            </ul>
        </nav>
    </header>

    <main>
 
   

        <?php
        // Cargar la página correspondiente según la selección
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'pacientes':
                    include 'doctor_patients.php';
                    break;
                case 'modificar_citas':
                    include 'modify_appointments.php';
                    break;
                case 'historial_citas':
                    include 'patient_history.php';
                    break;
                default:
                    echo "<h2>Bienvenido al Panel del Doctor</h2>";
            }
        } else {
            echo "<h2>Bienvenido al Panel del Doctor</h2>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Sistema de Gestión Médica</p>
    </footer>
   
</body>
</html>