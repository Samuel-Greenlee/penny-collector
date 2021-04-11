<?php

class user {
   private $password, $userName;
   
   function __construct($password, $userName) {
       $this->password = $password;
       $this->userName = $userName;
   }
   
   function getPassword() {
       return $this->password;
   }

   function getUserName() {
       return $this->userName;
   }

   function setPassword($password) {
       $this->password = $password;
   }

   function setUserName($userName) {
       $this->userName = $userName;
   }

}
