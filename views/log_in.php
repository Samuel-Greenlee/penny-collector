<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link href="styling/main.css" rel="stylesheet" type="text/css"/> 
    </head>
    <body>
        <div id="wrapper">
            
        <header>
            <h1>Log In</h1>         
        </header>       
        <nav>
            <a href="index.php?action=log_in">Log In Page</a>
            
            <a href="index.php?action=registration">Registration Page</a>
        </nav>  
        <br>
        <br>
        <br>
        <br>
        <!--Set userName and password to empty string for further use-->
        <?php
            if(!isset($userName)) { $userName = '';}
            if(!isset($password)) { $password = '';}       
        ?>
        
        <!----------------------------TOP OF FORM------------------------------>
        <form action="index.php?action=submit_log_in" method="post">
            <label>User Name</label>
            <input type="text" name="userName" id="userName" value="<?php echo htmlspecialchars($userName); ?>"
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <label>Password</label>
            <input type="text" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>"
            <br>
            <br>
            <br>
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Log In">
            </div>            
        </form>
        <!----------------------------BOTTOM OF FORM--------------------------->
        
        <!--Display Error Message-->
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message ?></p>
        <?php } ?> 
        </div>
    </body>
</html>