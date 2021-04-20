<?php

class user {
   //Create variables for the database table user
   private $password, $userName;
   
   //Constructor to hold necessary variables
   function __construct($password, $userName) {
       $this->password = $password;
       $this->userName = $userName;
   }
   
   //Get password
   function getPassword() {
       return $this->password;
   }

   //Get userName
   function getUserName() {
       return $this->userName;
   }

   //Set password
   function setPassword($password) {
       $this->password = $password;
   }

   //Set userName
   function setUserName($userName) {
       $this->userName = $userName;
   }

}
