<?php
//validar que se hace clic en el boton enviar
    if(!empty($_POST['registrar'])){
        //valida que los espacios no esten vacios
        if(!empty($_POST['id'])  and !empty($_POST['nom']) and !empty($_POST['ape']) and !empty($_POST['tip']) and !empty($_POST['fec'])
        and !empty($_POST['cor']) and !empty($_POST['sex']) and !empty($_POST['Dir']) and !empty($_POST['con'])){
           

        
           

        
        }
            $id = $_POST['id'];
            $nombre = $_POST['nom'];
            $apellido = $_POST['ape'];
            $tipo_identificacion = $_POST['tip'];
            $fecha_de_nacimiento = $_POST['fec'];
            $correo = $_POST['cor'];
            $sexo = $_POST['sex'];
            $Direccion = $_POST['Dir'];
            $contrasena = $_POST ['con'];
           
           
            
            
            if($conexion){
                $sql ="call insertar_datos ('$id','$nombre', '$apellido','$fecha_de_nacimiento','$correo','$sexo','$Direccion','$tipo_identificacion'
                ,'','$contrasena','$id','1')";
                $result = $conexion->query($sql);
                
                
                echo '<div class = "alert alert-success">Registro Satisfactorio</div>';
            }
            else{
                echo '<div class = "alert alert-danger">Error de conexion</div>';
            }

            }
           
            
        else{
            echo '<div class = "alert alert-warning">ingresa datos</div>';
        };
    

     
?>