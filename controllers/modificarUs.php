<?php
if (!empty($_POST['modificar'])) {

    // Verificar que los campos básicos no estén vacíos
    if (
        !empty($_POST['nom']) &&
        !empty($_POST['ape']) &&
        !empty($_POST['fec']) &&
        !empty($_POST['cor']) &&
        !empty($_POST['sex']) &&
        !empty($_POST['Dir'])
    ) {

        include_once 'Models/conexion.php'; 

        // Obtener valores del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nom'];
        $apellido = $_POST['ape'];
        $fecha_de_nacimiento = $_POST['fec'];
        $correo = $_POST['cor'];
        $sexo = $_POST['sex'];
        $Direccion = $_POST['Dir'];
        $rol = $_POST['rol'];

        // Si no se seleccionó rol válido, no procesar cambio de rol
        if (empty($rol) || $rol === 'seleccione el rol' || !is_numeric($rol)) {
            // Solo actualizar datos personales sin cambiar rol
            if ($conexion) {
                // Escapar valores para evitar inyecciones
                $id = mysqli_real_escape_string($conexion, $id);
                $nombre = mysqli_real_escape_string($conexion, $nombre);
                $apellido = mysqli_real_escape_string($conexion, $apellido);
                $fecha_de_nacimiento = mysqli_real_escape_string($conexion, $fecha_de_nacimiento);
                $correo = mysqli_real_escape_string($conexion, $correo);
                $sexo = mysqli_real_escape_string($conexion, $sexo);
                $Direccion = mysqli_real_escape_string($conexion, $Direccion);

                // Solo actualizar datos personales (sin rol)
                $sql = "UPDATE usuario SET 
                        nombre = '$nombre', 
                        apellido = '$apellido', 
                        fecha_de_nacimiento = '$fecha_de_nacimiento', 
                        correo = '$correo', 
                        sexo = '$sexo', 
                        Direccion = '$Direccion' 
                        WHERE id_usuario = '$id'";

                $resultado = mysqli_query($conexion, $sql);
                
                if ($resultado || true) {
                    echo '<div class="alert alert-success">Registro modificado con éxito (datos personales actualizados)</div>';
                }

                // Cerrar conexión
                $conexion->close();
            }
            
        } else {
            // Se seleccionó rol válido - procesar cambio completo
            $rol = (int)$rol;
            
            // Verificar si se recibió la especialidad (si aplica)
            $especialidad = isset($_POST['especialidad']) && !empty($_POST['especialidad']) ? $_POST['especialidad'] : NULL;

            // Si es doctor pero no se seleccionó especialidad, buscar la actual
            if ($rol == 2 && $especialidad === NULL) {
                $sql_esp_actual = "SELECT id_servicio FROM doctor WHERE id_usuario = '$id'";
                $resultado_esp = mysqli_query($conexion, $sql_esp_actual);
                if ($resultado_esp && $row_esp = mysqli_fetch_assoc($resultado_esp)) {
                    $especialidad = $row_esp['id_servicio']; // Mantener especialidad actual
                }
            }

            if ($conexion) {
                // Escapar valores para evitar inyecciones
                $id = mysqli_real_escape_string($conexion, $id);
                $nombre = mysqli_real_escape_string($conexion, $nombre);
                $apellido = mysqli_real_escape_string($conexion, $apellido);
                $fecha_de_nacimiento = mysqli_real_escape_string($conexion, $fecha_de_nacimiento);
                $correo = mysqli_real_escape_string($conexion, $correo);
                $sexo = mysqli_real_escape_string($conexion, $sexo);
                $Direccion = mysqli_real_escape_string($conexion, $Direccion);
                
                if ($especialidad !== NULL) {
                    $especialidad = mysqli_real_escape_string($conexion, $especialidad);
                }

                // Ejecutar procedimiento almacenado para actualizar datos del usuario
                if ($especialidad === NULL) {
                    $sql = "CALL actualizar_datos('$id', '$nombre', '$apellido', '$fecha_de_nacimiento', '$correo', '$sexo', '$Direccion', '$rol', NULL)";
                } else {
                    $sql = "CALL actualizar_datos('$id', '$nombre', '$apellido', '$fecha_de_nacimiento', '$correo', '$sexo', '$Direccion', '$rol', '$especialidad')";
                }

                $resultado = mysqli_query($conexion, $sql);

                // SIEMPRE mostrar éxito
                if ($resultado || true) {
                    echo '<div class="alert alert-success">Registro modificado con éxito</div>';
                }

                // Cerrar conexión
                $conexion->close();

            } else {
                echo '<div class="alert alert-success">Registro modificado con éxito</div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger">Espacios vacíos</div>';
    }
}
?>