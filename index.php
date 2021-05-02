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
require_once 'model/xssChecker.php';

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
        
        //Check for hacking on user name
        if(xssChecker::xssCheck($userName) == 1) {
             $error_message .= 'No hacking please on the user name.<br><br>';
            
            $errorCode = 1; 
        }
        
        //Check for hacking on password 
        if(xssChecker::xssCheck($password) == 1) {
             $error_message .= 'No hacking please on the password.<br><br>';
            
            $errorCode = 2; 
        }
        
        //Check to see if userName is not NULL
        if($userName == '') {
            $error_message .= 'Please enter a user name.<br><br>';
            
            $errorCode = 3;           
        }
        
        //Check to see if password is not NULL
        if($password == '') {
            $error_message .= 'Please enter a password.<br><br>';
            
            $errorCode = 4;
            
        }
        
        
        //If all goes well, allow the user to log in
        if($errorCode == 0) {
            
            if(user_db:: checkLogIn($userName, $password)) {
                
                $_SESSION['userName'] = $userName;
                
                $pennies = penny_db::getUsersPennies($userName);
                
                include 'views/user_profile.php';
            }
            //Else, return the user to the log in page to allow them to see error messages
            else {
                $error_message .= 'User Name and password does not match.<br><br>';
            
                include 'views/log_in.php';
            }
            
            //Clear variables after data access usage
            $userName = '';
            
            $password = '';
            
        }
        //Else, return the user to the log in page to allow them to see error messages
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
        
        //Check for hacking on user name
        if(xssChecker::xssCheck($userName) == 1) {
             $error_message .= 'No hacking please on the user name.<br><br>';
            
            $errorCode = 1; 
        }
        
        //Check for hacking on password 
        if(xssChecker::xssCheck($password) == 1) {
             $error_message .= 'No hacking please on the password.<br><br>';
            
            $errorCode = 2; 
        }
        
        //Check to see if userName is not NULL
        if($userName == '') {
            $error_message .= 'Please enter a user name.<br><br>';
            
            $errorCode = 3;
            
        }
        
        //Check to see if userName already exists       
        else if ($userNameCheck != NULL) {
            $error_message .= 'User name already exists.<br><br>';   
            
            $errorCode = 4;
            
        }
              
        //Check to see if password is not NULL
        if($password == '') {
            $error_message .= 'Please enter a password.<br><br>';
            
            $errorCode = 5;
            
        }
        
        //Check to see if password contains 8 or more characters
        if (strlen($password) < 8 && $errorCode == 0 && $errorCode != 5 ) {
            $error_message .= 'Please enter a password with at least eight '
                    . 'or more characters.<br><br>';   
            
            $errorCode = 6;
            
        }
            
        //Check to see if password contains at least one uppercase letter
        if (preg_match('/[[:upper:]]/', $password) == 0 && $errorCode == 0 && $errorCode != 5) {
            $error_message .= 'Password must include at least one uppercase letter.<br><br>';
            
            $errorCode = 7;
            
        }
        
        //Check to see if the password contains at least one lowercase letter
        if (preg_match('/[[:lower:]]/', $password) == 0 && $errorCode == 0 && $errorCode != 5) {
            $error_message .= 'Password must include at least one lower letter.<br><br>';
            
            $errorCode = 8;
            
        }
      
        //Check to see if password contains at least a number
        if (preg_match('/\d/', $password) == 0 && $errorCode == 0 && $errorCode != 5) {
            $error_message .= 'Password must include at least one number.<br><br>';
            
            $errorCode = 9;
            
        }
        
        //Check to see if password contains at least a special character
        if (preg_match('/\W/', $password) == 0 && $errorCode == 0 && $errorCode != 5) {
            $error_message .= 'Password must include at least one special character.<br><br>';
            
            $errorCode = 10;
            
        }      
        
        //If all goes well, then create the registration
        if($errorCode == 0) {
            //Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //Create user object
            $user = new user($hash, $userName);


            //Data access usage
            user_db::insertUser($user);
            
            //Clear variables after data access usage
            $userName = '';
            
            $password = '';
            
            //Thank the use for registering
            $error_message = 'Thank you for registering';
            
            include 'views/log_in.php';
        }
        //Else, return the user to the registration page to allow them to see error messages
        else {
            include 'views/registration.php';
        }
        die();
        break;
        
    //Create case to view the user_listings page
    case 'user_listings':
        $users = user_db::getAllUser();
        include 'views/user_listings.php';
        die();
        break; 
    
    //Create case to allow the user to view the other page of any selected user
        //This, allows for the lock down so that people don't change other peoples collections
     case 'view_other_user':
         $userName = filter_input(INPUT_POST, 'userName');
            
        //Create a collection of penny records
        $pennies = penny_db::getUsersPennies($userName);
        
        include 'views/view_other_user.php';
        die();
        break; 
        
    //Create case for add_penny
    case 'add_penny':
        $pennyYear = filter_input(INPUT_POST, 'pennyYear');
        $pennyMint = filter_input(INPUT_POST, 'pennyMint');
        $pennyCondition = filter_input(INPUT_POST, 'pennyCondition');
        $pennyAmount = filter_input(INPUT_POST, 'pennyAmount');
        $error_message = '';
        $errorCode = 0;
        
        //Check for hacking on the user adding a penny
        if(xssChecker::xssCheck($pennyYear) == 1 ||
                xssChecker::xssCheck($pennyMint) == 1
                || xssChecker::xssCheck($pennyCondition) == 1
                || xssChecker::xssCheck($pennyAmount) == 1) {
            
             $error_message .= 'No hacking please.<br><br>';
            
            $errorCode = 1; 
        }
        
        //Check to see if pennyYear is not NULL
        if($pennyYear == '') {
            $error_message .= 'Please enter a resonable penny year.<br><br>';
            
            $errorCode = 2;
            
        }
        
        //Check to see if pennyMint is not NULL
        if($pennyMint == '') {
            $error_message .= 'Please enter a penny mint.<br><br>';
            
            $errorCode = 3;        
        }
        
        //Check to see if the user entered the correct penny mint
        else if($pennyMint != 'San Francisco' && $pennyMint != 'Denver' && $pennyMint != 'Philadelphia') {
        $error_message .= 'Please enter a penny mint that is either San Francisco, Denver, or Philadelphia<br><br>';
            
        $errorCode = 4;
        }
        
        //Check to see if penny condition is not NULL
        if($pennyCondition == '') {
            $error_message .= 'Please enter a penny condition.<br><br>';
            
            $errorCode = 5;
            
        }
        
        //Check to see if the penny condition is either Good, Great, or Bad
        else if ($pennyCondition != 'Good' && $pennyCondition != 'Great' && $pennyCondition != 'Bad') {
             $error_message .= 'Please enter a penny condition that is either Good, Great, or Bad.<br><br>';
            
            $errorCode = 6;
        }
        
        //Check to see if penny amount is not NULL
        if($pennyAmount == '') {
            $error_message .= 'Please enter a penny amount.<br><br>';
            
            $errorCode = 7;          
        }
        
        //If all goes well, insert the valid penny into the database
        if($errorCode == 0) {          
            
            //Make the userName variable hold the user name that is in current use
            $userName = $_SESSION['userName'];
            
            //Make a new penny
            $newPenny = New penny($pennyAmount, $pennyCondition, 0, $pennyMint, $_SESSION['userName'], $pennyYear);
            
            //Insert the new penny in the database
            penny_db:: insertPenny($newPenny);
            
            //Create a collection of penny records
            $pennies = penny_db::getUsersPennies($_SESSION['userName']);
            
            //Clear the variables after a successful penny has been entered
            $pennyYear = NULL;
            
            $pennyMint = '';
            
            $pennyCondition = '';
            
            $pennyAmount = '';
                       
            
            include 'views/user_profile.php';                     
        }
        //Else, return the user to their webpage to allow them to see their mistakes
        else {
            //Make the userName variable hold the user name that is in current use
            $userName = $_SESSION['userName'];
            
            //Create a collection of penny records
            $pennies = penny_db::getUsersPennies($_SESSION['userName']);
            
            include 'views/user_profile.php'; 
        }       
        die();
        break;
    
    //Allows the user to delete specific pennies
    case 'delete_penny':
        $pennyID = filter_input(INPUT_POST, 'penny_id');
        penny_db::deletePenny($pennyID);
        
        //Make the userName variable hold the user name that is in current use
        $userName = $_SESSION['userName'];
            
        //Create a collection of penny records
        $pennies = penny_db::getUsersPennies($_SESSION['userName']);
        
        //Display conformation message useing the error_message variable
        $error_message = 'Delete successful!';
            
        include 'views/user_profile.php';        
        die();
        break;
    
    //Allows the user to update specific pennies
    case 'update_penny':
        $pennyID = filter_input(INPUT_POST, 'penny_id');
        
        $penny = penny_db::getPennyID($pennyID);
        
        //Make the userName variable hold the user name that is in current use
        $userName = $_SESSION['userName'];
            
        include 'views/user_penny_update.php';        
        die();
        break;
    
    //Allows the user to update specific pennies on the user_penny_update page
    case 'submit_update_penny':
        $pennyID = filter_input(INPUT_POST, 'penny_id');
        $pennyYear = filter_input(INPUT_POST, 'pennyYear');
        $pennyMint = filter_input(INPUT_POST, 'pennyMint');
        $pennyCondition = filter_input(INPUT_POST, 'pennyCondition');
        $pennyAmount = filter_input(INPUT_POST, 'pennyAmount');
        $error_message = '';
        $errorCode = 0;
        
        //Check for hacking on the user adding a penny
        if(xssChecker::xssCheck($pennyID) == 1 ||
                xssChecker::xssCheck($pennyYear) == 1
                || xssChecker::xssCheck($pennyMint) == 1
                || xssChecker::xssCheck($pennyCondition) == 1
                || xssChecker::xssCheck($pennyAmount) == 1) {
            
             $error_message .= 'No hacking please.<br><br>';
            
            $errorCode = 1; 
        }
        
        //Check to see if pennyYear is not NULL
        if($pennyYear == '') {
            $error_message .= 'Please enter a resonable penny year.<br><br>';
            
            $errorCode = 2;
            
        }
        
        //Check to see if pennyMint is not NULL
        if($pennyMint == '') {
            $error_message .= 'Please enter a penny mint.<br><br>';
            
            $errorCode = 3;        
        }
        
        //Check to see if the user entered the correct penny mint
        else if($pennyMint != 'San Francisco' && $pennyMint != 'Denver' && $pennyMint != 'Philadelphia') {
        $error_message .= 'Please enter a penny mint that is either San Francisco, Denver, or Philadelphia<br><br>';
            
        $errorCode = 4;
        }
        
        //Check to see if penny condition is not NULL
        if($pennyCondition == '') {
            $error_message .= 'Please enter a penny condition.<br><br>';
            
            $errorCode = 5;
            
        }
        
        //Check to see if the penny condition is either Good, Great, or Bad
        else if ($pennyCondition != 'Good' && $pennyCondition != 'Great' && $pennyCondition != 'Bad') {
             $error_message .= 'Please enter a penny condition that is either Good, Great, or Bad.<br><br>';
            
            $errorCode = 6;
        }
        
        //Check to see if penny amount is not NULL
        if($pennyAmount == '') {
            $error_message .= 'Please enter a penny amount.<br><br>';
            
            $errorCode = 7;          
        }
        
        //If all goes well, update the specific penny the user wants
        if($errorCode == 0) {          
            
            //Make the userName variable hold the user name that is in current use
            $userName = $_SESSION['userName'];
            
            //Create a new penny object that needs to be updated
            $penny = new penny($pennyAmount, $pennyCondition, $pennyID, $pennyMint, $userName = $_SESSION['userName'], $pennyYear);
            
            //Update the specific penny that the user has choosen
            penny_db::updatePenny($penny);
            
            //Create a collection of penny records
            $pennies = penny_db::getUsersPennies($_SESSION['userName']);
            
            //Clear the variables after a successful penny has been updated
            $pennyYear = NULL;
            
            $pennyMint = '';
            
            $pennyCondition = '';
            
            $pennyAmount = '';
                       
            $error_message = 'Selected penny update successful.';
            
            include 'views/user_profile.php';                     
        }
        //Else, return the user to their webpage to allow them to see their mistakes
        else {
            //Make the userName variable hold the user name that is in current use
            $userName = $_SESSION['userName'];
            
            //Grab the specific penny the user has selected to update
            $penny = penny_db::getPennyID($pennyID);
            
            include 'views/user_penny_update.php'; 
        }               
        die();
        break;
    
    //Create case to return the user to their profile
    case 'user_profile_return':
        //Make the userName variable hold the user name that is in current use
        $userName = $_SESSION['userName'];
            
        //Create a collection of penny records
        $pennies = penny_db::getUsersPennies($_SESSION['userName']);
            
        include 'views/user_profile.php';  
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
