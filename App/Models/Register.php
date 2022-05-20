<?php

namespace App\Models;

use App\Models\DataBase\DataBase;

class Register
{
    public function insert($firstName, $secondName, $email, $birthdate, $password, $key)
    {
        $db = new DataBase;
        $conn = $db->connection();
        $cmd = "INSERT INTO user (firstname, secondname, email, birthdate, password, userkey) VALUES (:FN, :SN, :EM, :BD, :PA, :UK)";
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':FN', $firstName);
        $stmt->bindValue(':SN', $secondName);
        $stmt->bindValue(':EM', $email);
        $stmt->bindValue(':BD', $birthdate);
        
        //$cript = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':PA', $password);
        
        $stmt->bindValue(':UK', $key);

        $stmt->execute();
        return $stmt;
    }

    public function select($email)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "SELECT * FROM user WHERE email=:EM LIMIT 1";        
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':EM', $email);

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}