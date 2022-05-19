<?php

namespace App\Models;
require_once __DIR__.'/../../vendor/autoload.php';
use App\Models\DataBase\DataBase;

class Register
{
    public function insert($firstName, $secondName, $email, $birthdate, $password)
    {
        $db = new DataBase;
        $conn = $db->connection();
        $cmd = "INSERT INTO user (firstname, secondname, email, birthdate, password) VALUES (:FN, :SN, :EM, :BD, :PA)";
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':FN', $firstName);
        $stmt->bindValue(':SN', $secondName);
        $stmt->bindValue(':EM', $email);
        $stmt->bindValue(':BD', $birthdate);
        
        $cript = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':PA', $cript);

        $stmt->execute();
        return $stmt;
    }

    public function select($email)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "SELECT * FROM user WHERE email LIKE :EM";        
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':EM', $email);

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

/* $obReg = new Register;
$resul = $obReg->select();
var_dump($resul[1]); */