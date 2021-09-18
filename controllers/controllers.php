<?php
class Mailer {
    public function SendM() {
        if (isset($_POST["faction"])) {
         $nombre = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        if (empty($nombre)) {
            $_SESSION["MSGFM"] = "<p class='fm-msg'>No se ha ingresado el nombre</p>";
            header("Location: index.php");
            exit;
        }
        $_SESSION["NAME"] = $nombre;
        $email = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        if (empty($email)) {
            $_SESSION["MSGFM"] = "<p class='fm-msg'>No se ha ingresado el email</p>";
            header("Location: index.php");
            exit;
        }
        $_SESSION["EMAIL"] = $email;
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        if (empty($phone)) {
            $_SESSION["MSGFM"] = "<p class='fm-msg'>No se ha ingresado el teléfono</p>";
            header("Location: index.php");
            exit;
        }
        $_SESSION["PHONE"] = $phone;
        $kind = filter_input(INPUT_POST, 'kind', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        if (empty($message)) {
            $_SESSION["MSGFM"] = "<p class='fm-msg'>No se ha ingresado el mensaje</p>";
            header("Location: index.php");
            exit;
        }
        $_SESSION["MESSAGE"] = $message;
        //echo "El Nombre ingresado es: ".$nombre."</br>El Email ingresado es: ".$email."</br>El Teléfono ingresado es: ".$phone."</br>El Tipo de soporte ingresado es: ".$kind."</br>El Mensaje ingresado es: ".$message;
        $EmailTittle = "Formulario de Contacto | $kind";
        $DestinoEmail = "videos@marbust.com";
        $DestinoName = "Marbust Videos & Entertainment";
        $body = "<h1 style='text-align: center;'>Formulario de Contacto</h1>";
        $body = $body."<p><strong>Nombre: </strong> $nombre</p>";
        $body = $body."<p><strong>Email: </strong> <a href='mailto:$email'>$email</a></p>";
        $body = $body."<p><strong>Teléfono: </strong> $phone</p>";
        $body = $body."<p><strong>Mensaje: </strong> $message</p>";
        $body = $body."<p style='text-align: center;'><strong>Formulario hecho para curso de PHPMailer(); por Marbust Videos &amp; Entertainment&reg;</strong></p>";
        unset($_SESSION["NAME"]);
        unset($_SESSION["EMAIL"]);
        unset($_SESSION["PHONE"]);
        unset($_SESSION["MESSAGE"]);
        
        require('phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
            
        //Aqui viene la magia
        $mail->Host = "Enter your server mail.domain.extension";
        $mail->Username = "Enter your email";
        $mail->Password = "Enter your password";
        $mail->AddAddress($DestinoEmail, $DestinoName);
        $mail->Subject = $EmailTittle;
            
        //No editar
        $mail->From = $email;
        $mail->FromName = $name;
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Body = $body; //insert the message body
        $mail->AltBody ="Name    : {$name}\n\nEmail   : {$email}\n\nMessage : {$message}";
        $mail->SMTPDebug  = 0;								// Change to "2" to see full SMTP connection output 
        
        if(!$mail->Send()) {
            $_SESSION["MSGFM"] = "<p class='fm-msg'>Lo sentimos pero el Mensaje no pudo ser enviado</p>";
            header("Location: index.php");
            exit;
        }
            $_SESSION["MSGFM"] = "<p class='fm-msg'>Gracias $nombre, tu mensaje ha sido enviado correctamente.</p>";
            header("Location: index.php");
            exit;
        
        }
        
    }
}

?>
