<?php

class user_db {
     //Create function
    public static function insertUser($user) {
        $db = Database::getDB();
        $query = 'insert into user(userName, password)'
                . 'values(:userName, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $user -> getUserName());
        $statement->bindValue(':password', $user -> getPassword());
        $statement->execute();
        $statement->closeCursor();
    }
    //Read functions
    public static function getAllUser() {
        $db = Database::getDB();
        $query = 'SELECT * FROM user
                  ORDER BY userName';
        $statement = $db->prepare($query);
        $statement->execute();
        $user = $statement->fetchAll();
        $statement->closeCursor();
        
        foreach ($user as $users) {
            $newUser = new User(
                $users['password'],
                $users['userName']);
            $newUsers[] = $newUser;
        }
        return $newUsers;
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
    //Update function
    public static function updateUserPassword($user) {
        $db = Database::getDB();
        $query = 'update user set '
                . 'password = :password '
                . 'Where userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $user -> getUserName());
        $statement->bindValue(':password', $user -> getPassword());
        $statement->execute();
        $statement->closeCursor();
    }
    
    //Delete function
    public static function deleteUser($userName) {
        $db = Database::getDB();
        $query = 'DELETE FROM user
                  WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $statement->closeCursor();
    }
    
     public static function checkLogIn($userName, $password) {
        $db = Database::getDB();
        $query = 'SELECT password FROM user
                  WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $hash = $statement->fetch();
        $statement->closeCursor();
        if($hash == NULL){
            return false;
        }
        else if(password_verify($password, $hash[0])) {
            return true;
        }
        else {
            return false;
        }
    }        
}

