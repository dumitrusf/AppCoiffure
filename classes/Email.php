<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        $mail->setFrom('accounts@appcoiffure.com', 'AppCoiffure');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirm your Account';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hi, " . $this->nombre . "</strong> You have created your account in App coiffeur, you just have to confirm it by clicking the following link</p>";
        $contenido .= "<p>Press here: <a href='" . $_ENV["APP_URL"] . "/confirmar-cuenta?token=" . $this->token . "'>Confirm Account</a></p>";
        $contenido .= "<p>If you did not request this change, you can ignore the message</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        $mail->setFrom('accounts@appcoiffure.com', 'AppCoiffure');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reset your Password';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hi, " . $this->nombre . "</strong> You have requested to reset your password, follow the following link to do it</p>";
        $contenido .= "<p>Press here: <a href='" . $_ENV["APP_URL"] . "/recuperar?token=" . $this->token . "'>Reset Password</a></p>";
        $contenido .= "<p>If you did not request this change, you can ignore the message</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();
    }
}
