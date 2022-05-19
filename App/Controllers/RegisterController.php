<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Register;

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
                    $result = $obRegister->insert($_POST['firstName'], $_POST['secondName'], $_POST['email'], $_POST['birthDate'], $_POST['password']);

                    if ($result->rowCount() > 0) {

                        header('Location: ?router=Site/login/');
                        return $result;
                    }
                } else {
                    echo "Email já cadastrado";                    
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
