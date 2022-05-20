<?php

namespace App\Controllers;

use App\Models\Login;

class LoginController
{
    public function login()
    {
        if (isset($_POST['login']) && !empty($_POST['login'])) {

            $data = $this->getData();
            
            if ($data['sit_user_id'] != 1) {
                echo "<h2 style='color: red; max-width: 500px; border: solid 1px black; border-radius: 10px; padding: 10px; background-color: antiquewhite;'>
                - Erro:<br><br> - E-mail não confirmado!<br><br> - Verifique sua caixa de entrada de e-mail!
                </h2>";
            } elseif (!is_null($data)) {
                $password = $data['password'];                
                
                if ($password == $_POST['passwordLogin']) {
                    header("Location: ?router=Site/userPanel/");
                } else {

                    echo "<h1 style='color: red;'>Email ou Senha Invalido(a)!</h1>";
                }
            } else {
                
                echo "<h1 style='color: red;'>Email ou Senha Invalido(a)!</h1>";
            }
        }
    }

    private function getData()
    {
        $obLogin = new Login;
        $result = $obLogin->select($_POST['emailLogin']);
        if ($result != null) {
            return $result;
        } else {
            return null;
        }
    }
}

$obLoginController = new LoginController;
$obLoginController->login();