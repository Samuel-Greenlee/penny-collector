<?php

class penny_db {
    //Create function
    public static function insertPenny($penny) {
        $db = Database::getDB();
        $query = 'insert into penny(pennyAmount, pennyCondition'
                . 'pennyID, pennyMint, userName)'
                . 'values(:pennyAmount, :pennyCondition, :pennyID,'
                . ':pennyMint, :userName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyAmount', $penny -> getPennyAmount());
        $statement->bindValue(':pennyCondition', $penny -> getPennyCondition());
        $statement->bindValue(':pennyID', $penny -> getPennyID());
        $statement->bindValue(':pennyMint', $penny -> getPennyMint());
        $statement->bindValue(':userName', $penny -> getUserName());
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
                . ' pennyMint = :pennyMint, userName = :userName '
                . 'Where pennyID = :pennyID';
        $statement = $db->prepare($query);
        $statement->bindValue(':pennyAmount', $penny -> getPennyAmount());
        $statement->bindValue(':pennyCondition', $penny -> getPennyCondition());
        $statement->bindValue(':pennyID', $penny -> getPennyID());
        $statement->bindValue(':pennyMint', $penny -> getPennyMint());
        $statement->bindValue(':userName', $penny -> getUserName());
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
}
