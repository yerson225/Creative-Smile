<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>interffaz asistente</title>
  
  <!-- Incluir Bootstrap y Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #7d3785;;
      color: white;
      padding: 15px 0;
      text-align: center;
    }
    header h1 {
      margin: 0;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
    }
    .card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      margin: 10px;
      padding: 20px;
      width: 250px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .card h3 {
      font-size: 1.2em;
      margin-bottom: 15px;
    }
    .card p {
      font-size: 1em;
      color: #555;
    }
    .btn {
      background-color: #7d3785;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #7d3785;
    }
    .card-icon {
      font-size: 40px;
      margin-bottom: 5px;
    }
    footer {
      background-color: #00796b;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* Estilo para el navbar */
    .navbar {
      background-color:#7d3785;
    }

    .navbar .nav-link {
      color: white !important;
    }

    .navbar .nav-link:hover {
      color: #004d40 !important;
    }
    
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Gestión de Citas Odontológicas</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="logout()">Salir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  
  <div class="card">
    <div class="card-icon"><i class="bi bi-clock-history"></i></div>
    <h3>Historial de Citas</h3>
    <p>Consulta el historial de todas las citas pasadas del paciente.</p>
    <button class="btn" onclick="window.location.href = 'historialCitas.php';">Ver Historial</button>
 </div>


<div class="card">
    <div class="card-icon"><i class="bi bi-calendar-week"></i></div>
    <h3>Agenda de Citas</h3>
    <p>Visualiza la agenda de los odontólogos y disponibilidad.</p>
    <button class="btn" onclick="window.location.href = 'AgendarCitas.php';" >Ver Agenda</button>
  </div>

  <div class="card">
    <div class="card-icon"><i class="bi bi-tools"></i></div>
    <h3>Modificar Cita</h3>
    <p>Modifica o reprograma las citas de los pacientes.</p>
    <button class="btn" onclick="window.location.href = 'modificarCitas.php';">Modificar Cita</button>
  </div>

 
  <div class="card">
    <div class="card-icon"><i class="bi bi-bell"></i></div>
    <h3>Recordatorios</h3>
    <p>Configura recordatorios y notificaciones para citas.</p>
    <button class="btn" onclick="window.location.href = '/recordatorios.php';">Configurar Recordatorios</button>
  </div>

