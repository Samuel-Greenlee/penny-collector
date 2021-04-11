<?php

class user_db {
     //Create
    public static function insertUser($user) {
        $db = Database::getDB();
        $query = 'insert into user(userName, password)'
                . 'values(:userName, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $user -> $userName);
        $statement->bindValue(':password', $user -> $password);
        $statement->execute();
        $statement->closeCursor();
    }
    //Read
    public static function getAllUser() {
        $db = Database::getDB();
        $query = 'SELECT * FROM user
                  ORDER BY userName';
        $statement = $db->prepare($query);
        $statement->execute();
        $penny = $statement->fetchAll();
        $statement->closeCursor();
        return $user;
    }
            
    public static function getUserByName($userName) {
        $db = Database::getDB();
        $query = 'SELECT * FROM user
                  WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }        
    //Update
    public static function updateUserPassword($user) {
        $db = Database::getDB();
        $query = 'update user set '
                . 'password = :password '
                . 'Where userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $user -> $userName);
        $statement->bindValue(':password', $user -> $password);
        $statement->execute();
        $statement->closeCursor();
    }
    
    //Delete
    public static function deleteUser($UserName) {
        $db = Database::getDB();
        $query = 'DELETE FROM user
                  WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $statement->closeCursor();
    }        
}

