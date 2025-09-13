<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista usuarios</title>
    <link rel="stylesheet" href="../ejemplo.css" media="print">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a53887caa8.js" crossorigin="anonymous"></script>

</head>

<body>
    
    <?php

    include "../Models/conexion.php";
        $where = "";
        //Verificar si se carga o no la información
        if(!empty($_POST)){
            $valor = $_POST['nombre'];
            if(!empty($valor)){
                $where = "where nombre like '%$valor%'";
            }
        }
        $sql = "select * from usuario $where ";
        $resultado = $conexion->query($sql);
    ?>
<p class="h1">Lista de usuarios</p>

<div class="container mt-3">

    <div  class="container">
      <a class="btn btn-warning boton" href="../mostrarUsuario.php">Regresar</a>
     <a class="btn btn-warning boton" href="../controllers/reporteusuarios_excel.php"> Reporte excel</a>
     <a class="btn btn-warning boton" onclick="window.print()" href="">imprimir</a>
  </div>


 <table class="table table-dark">
    <thead>
      <tr>
       <th>Nombre </th>
        <th>apellido </th>
        <th>fecha_de_nacimiento </th>
        <th>Direccion</th>
        <th>correo</th>
        <th>sexo</th>
        
      </tr>
    </thead>

    <tbody>
        <?php
        include "../controllers/modificarUs.php";
            if($resultado->num_rows>0){
                while($row = $resultado->fetch_assoc()){
        ?>
      <tr>
       <td><?php echo $row['nombre']?></td>
        <td><?php echo $row['apellido']?></td>
        <td><?php echo $row['fecha_de_nacimiento']?></td>
       <td><?php echo $row['Direccion']?></td>
        <td><?php echo $row['correo']?></td>
        <td><?php echo $row['sexo']?></td>
        
        
           
      </tr>
      <?php
                }
            }
      ?>
     
    </tbody>
  </table>

</div>

</body>
</html>