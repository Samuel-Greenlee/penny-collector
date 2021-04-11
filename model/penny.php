<?php
class penny {
    private $pennyAmount, $pennyCondition, $pennyID, $pennyMint, $userName;
    
    public function __construct($pennyAmount, $pennyCondition, $pennyID, $pennyMint, $userName) {
        $this->pennyAmount = $pennyAmount;
        $this->pennyCondition = $pennyCondition;
        $this->pennyID = $pennyID;
        $this->pennyMint = $pennyMint;
        $this->userName = $userName;       
    }
    
    function getPennyAmount() {
        return $this->pennyAmount;
    }

    function getPennyCondition() {
        return $this->pennyCondition;
    }

    function getPennyID() {
        return $this->pennyID;
    }

    function getPennyMint() {
        return $this->pennyMint;
    }

    function getUserName() {
        return $this->userName;
    }

    function setPennyAmount($pennyAmount) {
        $this->pennyAmount = $pennyAmount;
    }

    function setPennyCondition($pennyCondition) {
        $this->pennyCondition = $pennyCondition;
    }

    function setPennyID($pennyID) {
        $this->pennyID = $pennyID;
    }

    function setPennyMint($pennyMint) {
        $this->pennyMint = $pennyMint;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }
}
