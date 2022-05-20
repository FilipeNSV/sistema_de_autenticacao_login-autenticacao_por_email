<?php

namespace App\Models;

require_once __DIR__.'/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class SendEmail
{
    public function sendEmail($email, $firstName, $secondName, $key)
    {
        $mail = new PHPMailer(true);


        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = $_ENV['MAIL_CHARSET'];
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = $_ENV['MAIL_SMTPAUTH'];
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['MAIL_PORT'];

        //Recipients
        $mail->setFrom($_ENV['MAIL_FROM_ADRESS'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($email, $firstName . ' ' . $secondName);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Confirmar o e-mail';
        $mail->Body    = "<h2>Olá Sr(a). $firstName $secondName.</h2><br>Para finalizarmos o 
                            seu cadastro, confirme seu e-mail clicando no link abaixo:<br>
                            <a href='http://localhost/estudos/loginsystem/?router=Site/ConfirmEmailController/$key'>Confirme Aqui</a>";
        $mail->AltBody = "Olá Sr(a). $firstName $secondName.\n Para finalizarmos o 
        seu cadastro, confirme seu e-mail clicando no link abaixo:\n
        http://localhost/estudos/loginsystem/?router=Site/ConfirmEmailController/$key ";

        $mail->send();
    }
}