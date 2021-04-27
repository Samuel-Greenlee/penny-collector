<?php
//Set lifetime of sessesion
$lifetime = 60 * 60 * 24 * 365;

//Start up session
session_set_cookie_params($lifetime, '/');
session_start();

//Bring in nessessary files for further use
require_once 'data access/database_oo.php';
require_once 'data access/penny_db.php';
require_once 'data access/user_db.php';
require_once 'model/user.php';
require_once 'model/penny.php';

//Initialize fallback page
$action = filter_input(INPUT_POST, 'action');
if($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'log_in';
    }
}

//Begin main case switch statement
switch ($action) {
    
    //Create case for log in page
    case 'log_in':
        include 'views/log_in.php';
        die();
        break;
    
    //Create case for registration page
    case 'registration':
        include 'views/registration.php';
        die();
        break;
    
    //Create case for user profile page
    case 'user_profile':
        include 'views/user_profile.php';
        die();
        break;
    
    //Create case for submission log in 
    case 'submit_log_in':
        $userName = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'password');
        $error_message = '';
        $errorCode = 0;
        
        //Check to see if userName is not NULL
        if($userName == '') {
            $error_message .= 'Please enter a user name.<br><br>';
            
            $errorCode = 1;           
        }
        
        //Check to see if password is not NULL
        if($password == '') {
            $error_message .= 'Please enter a password.<br><br>';
            
            $errorCode = 2;
            
        }
        
        
        //If all goes well, allow the user to log in
        if($errorCode == 0) {
            
            if(user_db:: checkLogIn($userName, $password)) {
                
                $_SESSION['userName'] = $userName;
                
                $pennies = penny_db::getUsersPennies($userName);
                
                include 'views/user_profile.php';
            }
            else {
                $error_message .= 'User Name and password does not match.<br><br>';
            
                include 'views/log_in.php';
            }
            
            //Clear variables after data access usage
            $userName = '';
            
            $password = '';
            
        }
        else {
            include 'views/log_in.php';
        }
       
        die();
        break;
    
    //Create case for submission registration
    case 'submit_registration':
        $userName = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'password');
        $userNameCheck = user_db:: getUserByName($userName);
        $error_message = '';
        $errorCode = 0;
        
        //Check to see if userName is not NULL
        if($userName == '') {
            $error_message .= 'Please enter a user name.<br><br>';
            
            $errorCode = 1;
            
        }
        
        //Check to see if userName already exists       
        else if ($userNameCheck != NULL) {
            $error_message .= 'User name already exists.<br><br>';   
            
            $errorCode = 2;
            
        }
              
        //Check to see if password is not NULL
        if($password == '') {
            $error_message .= 'Please enter a password.<br><br>';
            
            $errorCode = 3;
            
        }
        
        //Check to see if password contains 8 or more characters
        if (strlen($password) < 8) {
            $error_message .= 'Please enter a password with at least eight '
                    . 'or more characters.<br><br>';   
            
            $errorCode = 4;
            
        }
            
        //Check to see if password contains at least one uppercase letter
        if (preg_match('/[[:upper:]]/', $password) == 0) {
            $error_message .= 'Password must include at least one uppercase letter.<br><br>';
            
            $errorCode = 5;
            
        }
        
        //Check to see if the password contains at least one lowercase letter
        if (preg_match('/[[:lower:]]/', $password) == 0) {
            $error_message .= 'Password must include at least one lower letter.<br><br>';
            
            $errorCode = 6;
            
        }
      
        //Check to see if password contains at least a number
        if (preg_match('/\d/', $password) == 0) {
            $error_message .= 'Password must include at least one number.<br><br>';
            
            $errorCode = 7;
            
        }
        
        //Check to see if password contains at least a special character
        if (preg_match('/\W/', $password) == 0) {
            $error_message .= 'Password must include at least one special character.<br><br>';
            
            $errorCode = 8;
            
        }      
        
        //If all goes well, then create the registration
        if($errorCode == 0) {
            //Create user object
            $user = new user($password, $userName);


            //Data access usage
            user_db::insertUser($user);
            
            //Clear variables after data access usage
            $userName = '';
            
            $password = '';
            
            //Thank the use for registering
            $error_message = 'Thank you for registering';
            
            include 'views/log_in.php';
        }
        else {
            include 'views/registration.php';
        }
        die();
        break;
        
    //Create case for add_penny
    case 'add_penny':
        $pennyYear = filter_input(INPUT_POST, 'pennyYear');
        $pennyMint = filter_input(INPUT_POST, 'pennyMint');
        $pennyCondition = filter_input(INPUT_POST, 'pennyCondition');
        $pennyAmount = filter_input(INPUT_POST, 'pennyAmount');
        if($pennyYear == '' || $pennyMint == '' || $pennyCondition == '' || $pennyAmount == '') {
            $message = 'Penny not added. No blank values.';
        }
        else {
            //Data validation goes here
            
            
            //Make the userName variable hold the user name that is in current use
            $userName = $_SESSION['userName'];
            
            //Make a new penny
            $newPenny = New penny($pennyAmount, $pennyCondition, 0, $pennyMint, $_SESSION['userName'], $pennyYear);
            
            //Insert the new penny in the database
            penny_db:: insertPenny($newPenny);
            
            //Create a collection of penny records
            $pennies = penny_db::getUsersPennies($_SESSION['userName']);
            
            
            include 'views/user_profile.php';
            
            
        }
        die();
        break;    
    
    //Create case for log_out
    case 'log_out':
        $_SESSION['userName'] = '';
        session_unset();
        session_destroy();
        include 'views/log_in.php';
        die();
        break;    
}
?>
