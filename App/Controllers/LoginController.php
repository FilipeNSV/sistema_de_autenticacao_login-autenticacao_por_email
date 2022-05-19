<?php

namespace App\Controllers;

use App\Models\Login;

class LoginController
{
    public function login()
    {
        if (isset($_POST['login']) && !empty($_POST['login'])) {

            $data = $this->getData();
            //var_dump($data);

            if (!is_null($data)) {
                $password = $data[0]['password'];                
                
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

//$result = $obLoginController->getData();
//var_dump($result);
