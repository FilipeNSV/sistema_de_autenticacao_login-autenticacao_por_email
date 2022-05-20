<?php

namespace App\Controllers;

use App\Models\ConfirmEmail;

class ConfirmEmailController
{
    public function confirmKey()
    {
        $key = explode("/", filter_input(INPUT_GET, 'router', FILTER_SANITIZE_URL));
        
        if (!empty($key[2])) {
           
            $obConfEm = new ConfirmEmail;
            $result = $obConfEm->select($key[2]);
            
            if (($result)) {

                $obConfEm->update($result['id']);

                echo "<h1 style='color: green; max-width: 500px; border: solid 1px black; border-radius: 10px; padding: 10px; background-color: darkseagreen;'>
                Email Confirmado com Sucesso!</h1><br><a href='http://localhost/estudos/loginsystem/?router=Site/login/'>Volte Para a Página de Login!</a>";
            } else {
                echo "<h2 style='color: red; max-width: 500px; border: solid 1px black; border-radius: 10px; padding: 10px; background-color: antiquewhite;'>
                            - Erro:<br><br> - E-mail/Key inválido!
                         </h2>";
            }
        } else {
            echo "nada";
        }
    }
}

$obConfirm = new ConfirmEmailController;
$obConfirm->confirmKey();
