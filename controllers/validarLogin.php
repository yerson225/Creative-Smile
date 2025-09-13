<?php
    include_once '../Models/conexion.php';
    session_start();
    if(isset($_POST['usuario']) && isset($_POST['pass'])){
        function validar($data){
            $data = trim($data);
            $data =stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $usuario = validar($_POST['usuario']);
        $password = validar($_POST['pass']);

        if(empty($usuario)){
            header('location: ../login.php?error=Usuario Requerido');
            exit();
        }elseif(empty($password)){
            header('location: ../login.php?error=Contraseña Requerida');
            exit();
        }
        $sql = "call validar_datos('nombre','id_roles','$usuario','$password');"; 
        $resultado = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($resultado) ===1){
            $row = mysqli_fetch_assoc($resultado);
                if($row['id_usuario'] === $usuario && $row['contrasena'] === $password){
                    $_SESSION['id_usuario'] = $row['id_usuario'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['id_roles'] = $row['id_roles'];
                    switch ($row['id_roles']) {
                        case '1':
                            header('Location: ../vistas/interfazPaciente.php');
                            break;
                        case '2':
                            header('Location: ../vistas/interfazDoctor.php');
                            break;
                        case '3':
                            header('Location: ../vistas/interfazAsistente.php');
                            break;
                        case '4':
                            header('Location: ../vistas/interfazAdministrador.php');
                            break;
                        default:
                            header('Location: ../login.php?error=Rol desconocido');
                            exit();
                        }
                     } else{ /*Datos no identicos*/
                            header('Location: ../login.php?error=Usuario o contraseña incorrectos');
                            exit();
                        }
                    }
                  else{/*Los datos no coinciden con los de la BD */
                        header('Location: ../login.php?error=Usuario no registrado');
                    }
                
                } 
        
        ?>