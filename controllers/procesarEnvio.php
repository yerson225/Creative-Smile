<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';
require '../Models/conexion.php'; // Conexión a tu base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = trim($_POST['asunto']);
    $mensaje = trim($_POST['mensaje']);

    if (empty($asunto) || empty($mensaje)) {
        echo "❌ Por favor completa todos los campos.";
        exit;
    }

    // Obtener todos los correos de usuarios registrados
    $query = "SELECT correo FROM usuario WHERE correo IS NOT NULL";
    $result = mysqli_query($conexion, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        echo "❌ No se encontraron correos registrados.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'creativesmile4@gmail.com';
        $mail->Password = 'jissksjgqbhgzfxn'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('creativesmile4@gmail.com', 'Creative Smile');

        
        while ($row = mysqli_fetch_assoc($result)) {
            $correo = $row['correo'];
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($correo);
            }
        }

        $mail->isHTML(false); 
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        $mail->send();

        header("Location: ../enviarCorreo.php?mensaje=Correo enviado a todos");
        exit();
    } catch (Exception $e) {
        echo "❌ Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    echo "Acceso no permitido.";
}
