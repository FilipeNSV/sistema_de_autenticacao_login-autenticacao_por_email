<?php

namespace App\Models;

use App\Models\DataBase\DataBase;

class ConfirmEmail
{
    public function select($key)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "SELECT * FROM user WHERE userkey=:UK LIMIT 1";        
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':UK', $key);

        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id)
    {
        $db = new DataBase;
        $conn = $db->connection();

        $cmd = "UPDATE user SET sit_user_id = 1, userkey = :UK WHERE id=:ID";
        $stmt = $conn->prepare($cmd);
        $stmt->bindValue(':ID', $id);
        $key = null;
        $stmt->bindValue(':UK', $key);

        $stmt->execute();
        return $stmt;
    }
}