<?php

namespace App\Controllers;

use App\Models\Register;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RegisterController
{
    public function register()
    {
        if (isset($_POST['register']) && !empty($_POST['register'])) {

            if (empty($_POST['firstName'])) {
                echo "Erro: Preencha o campo -> First Name <-";
            } elseif (empty($_POST['secondName'])) {
                echo "Erro: Preencha o campo -> Second Name <-";
            } elseif (empty($_POST['email'])) {
                echo "Erro: Preencha o campo -> Email <-";
            } elseif (empty($_POST['birthDate'])) {
                echo "Erro: Preencha o campo -> Birth Date <-";
            } elseif (empty($_POST['password'])) {
                echo "Erro: Preencha o campo -> Password <-";
            } else {

                $validEmail = $this->authenticationEmail();
                if (!isset($validEmail)) {

                    $obRegister = new Register;

                    $confirmPass = password_hash($_POST['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
                    $key = explode('/', $confirmPass);

                    $result = $obRegister->insert($_POST['firstName'], $_POST['secondName'], $_POST['email'], $_POST['birthDate'], $_POST['password'], $key[0]);
                    
                    if ($result->rowCount() > 0) {
                        $this->confirmEmail($_POST['email'], $_POST['firstName'], $_POST['secondName'], $key[0]);
                        header('Location: ?router=Site/login/');
                        return $result;
                    }
                } else {
                    echo "<h2 style='color: red; max-width: 500px; border: solid 1px black; border-radius: 10px; padding: 10px; background-color: antiquewhite;'>
                            - Erro:<br><br> - E-mail já cadastradon no banco de dados!<br><br> - Registre outro e-mail.
                         </h2>";
                }
            }
        }
    }

    private function authenticationEmail()
    {
        $obRegister = new Register;
        $result = $obRegister->select($_POST['email']);
        if ($result != null) {
            return $result[0]['email'];
        } else {
            return null;
        }
    }

    private function confirmEmail($email, $firstName, $secondName, $key)
    {
        $mail = new PHPMailer(true);


        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host       = 'smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'a6d5ae6e98e51c';
        $mail->Password   = '930d035735a35d';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 2525;

        //Recipients
        $mail->setFrom('filipe@caffe.com', 'Filipe');
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
$register = new RegisterController;
$re = $register->register();
