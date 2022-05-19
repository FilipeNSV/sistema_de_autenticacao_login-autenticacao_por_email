<?php

namespace App\Models;

use \App\Models\DataBase\DataBase;

class Login
{
    public function select($email)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "SELECT email, password FROM user WHERE email=:EM LIMIT 1";        
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':EM', $email);

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}