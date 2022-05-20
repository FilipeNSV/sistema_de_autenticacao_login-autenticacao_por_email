<?php

namespace App\Controllers;

use App\Models\Register;
use App\Models\SendEmail;

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
                        $obSendEmail = new SendEmail;
                        $obSendEmail->sendEmail($_POST['email'], $_POST['firstName'], $_POST['secondName'], $key[0]);
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
}
$register = new RegisterController;
$re = $register->register();
