<?php

class penny_db {
    //Create function
    public static function insertPenny($penny) {
        $db = Database::getDB();
        $query = 'insert into penny(pennyAmount, pennyCondition, '
                . 'pennyID, pennyMint, userName, pennyYear) '
                . 'values(:pennyAmount, :pennyCondition, :pennyID, '
                . ':pennyMint, :userName, :pennyYear)';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyAmount', $penny -> getPennyAmount());
        $statement->bindValue(':pennyCondition', $penny -> getPennyCondition());
        $statement->bindValue(':pennyID', $penny -> getPennyID());
        $statement->bindValue(':pennyMint', $penny -> getPennyMint());
        $statement->bindValue(':userName', $penny -> getUserName());
        $statement->bindValue(':pennyYear', $penny -> getPennyYear());
        $statement->execute();
        $statement->closeCursor();
    }
    //Read functions
    public static function getAllPenny() {
        $db = Database::getDB();
        $query = 'SELECT * FROM penny
                  ORDER BY pennyID';
        $statement = $db->prepare($query);
        $statement->execute();
        $penny = $statement->fetchAll();
        $statement->closeCursor();
        return $penny;
    }
            
    public static function getPennyID($pennyID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM penny
                  WHERE pennyID = :pennyID';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyID', $pennyID);
        $statement->execute();
        $penny = $statement->fetch();
        $statement->closeCursor();
        return $penny;
    }        
    //Update function
    public static function updatePenny($penny) {
        $db = Database::getDB();
        $query = 'update penny set '
                . 'pennyAmount = :pennyAmount, pennyCondition = :pennyCondition,'
                . ' pennyMint = :pennyMint, userName = :userName, pennyYear = :pennyYear '
                . 'Where pennyID = :pennyID';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyAmount', $penny -> getPennyAmount());
        $statement->bindValue(':pennyCondition', $penny -> getPennyCondition());
        $statement->bindValue(':pennyID', $penny -> getPennyID());
        $statement->bindValue(':pennyMint', $penny -> getPennyMint());
        $statement->bindValue(':userName', $penny -> getUserName());
        $statement->bindValue(':pennyYear', $penny -> getPennyYear());
        $statement->execute();
        $statement->closeCursor();
    }
    
    //Delete function
    public static function deletePenny($pennyID) {
        $db = Database::getDB();
        $query = 'DELETE FROM penny
                  WHERE pennyID = :pennyID';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyID', $pennyID);
        $statement->execute();
        $statement->closeCursor();
    }        
    
    //Get all of the pennies based off of userName
    public static function getUsersPennies($userName) {
        $db = Database::getDB();
        $query = 'SELECT * FROM penny 
                  WHERE userName = :userName
                  ORDER BY pennyID';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $penny = $statement->fetchAll();
        $statement->closeCursor();
        
        //Create an array of pennies, and then return the array 
        /*foreach ($penny as $pennies) :           
            $pennies['pennyAmount'];
            $pennies['pennyCondition'];
            $pennies['pennyID'];
            $pennies['pennyMint'];
            $pennies['userName'];
            $pennies['pennyYear'];
        endforeach; */
        $newPennies = [];
        foreach ($penny as $pennies) {
            $newPenny = new Penny(
                                   $pennies['pennyAmount'],
                                   $pennies['pennyCondition'],
                                   $pennies['pennyID'],
                                   $pennies['pennyMint'],
                                   $pennies['userName'],
                                   $pennies['pennyYear']);
            $newPennies[] = $newPenny;
        }
        return $newPennies;
    }
}
