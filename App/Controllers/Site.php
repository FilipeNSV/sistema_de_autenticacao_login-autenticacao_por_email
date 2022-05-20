<?php

namespace App\Controllers;

class Site
{
    public function loginSystem()
    {
        require_once __DIR__ . '/../../resources/view/loginSystem.php';
    }

    public function register()
    {
        require_once __DIR__ . '/../../resources/view/register.php';
    }
    
    public function userPanel()
    {
        require_once __DIR__ . '/../../resources/view/userPanel.php';
    }
    
    /* public function cofirmEmail()
    {
        require_once __DIR__ . '/../../resources/view/cofirmEmail.php';
    } */

    //Methods

    public function LoginController()
    {
        require_once __DIR__ . '/LoginController.php';
    }

    public function RegisterController()
    {
        require_once __DIR__ . '/RegisterController.php';
    }

    public function ConfirmEmailController($params)
    {
        $param = $params;
        require_once __DIR__ . '/ConfirmEmailController.php';
    }
}
