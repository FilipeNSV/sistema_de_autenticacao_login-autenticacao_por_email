<?php

namespace App\Models;

use \App\Models\DataBase\DataBase;

class Login
{
    public function select($email)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "SELECT email, password, sit_user_id FROM user WHERE email=:EM LIMIT 1";        
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':EM', $email);

        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}