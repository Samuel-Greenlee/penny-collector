<?php
class penny {
    
    //Create variables for the database table penny
    private $pennyAmount, $pennyCondition, $pennyID, $pennyMint, $userName;
    
    //Constructor to hold necessary variables
    public function __construct($pennyAmount, $pennyCondition, $pennyID, $pennyMint, $userName) {
        $this->pennyAmount = $pennyAmount;
        $this->pennyCondition = $pennyCondition;
        $this->pennyID = $pennyID;
        $this->pennyMint = $pennyMint;
        $this->userName = $userName;       
    }
    
    //Get pennyAmount
    function getPennyAmount() {
        return $this->pennyAmount;
    }

    //Get pennyCondition
    function getPennyCondition() {
        return $this->pennyCondition;
    }

    //Get pennyID
    function getPennyID() {
        return $this->pennyID;
    }

    //Get pennyMint
    function getPennyMint() {
        return $this->pennyMint;
    }

    //Get userName
    function getUserName() {
        return $this->userName;
    }

    //Set pennyAmount
    function setPennyAmount($pennyAmount) {
        $this->pennyAmount = $pennyAmount;
    }

    //Set pennyCondition
    function setPennyCondition($pennyCondition) {
        $this->pennyCondition = $pennyCondition;
    }

    //Set pennyID
    function setPennyID($pennyID) {
        $this->pennyID = $pennyID;
    }

    //Set pennyMint
    function setPennyMint($pennyMint) {
        $this->pennyMint = $pennyMint;
    }

    //Set userName
    function setUserName($userName) {
        $this->userName = $userName;
    }
}
