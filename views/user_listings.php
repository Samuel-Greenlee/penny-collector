<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Listing</title>
        <link href="styling/main.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        <div id="wrapper">
        <header>
            <h1>User Listing</h1>         
        </header>  
        <nav>
            
            <a href="index.php?action=user_profile_return">Return To Profile</a>
            
        </nav>  
        <table>
        <tr>
            <th>User Name</th>
            <th></th></tr>
        <tr>
            <?php
            foreach ($users as $user) :
            ?>
            <td><?php echo htmlspecialchars($user->getUserName()); ?></td>
            <td><form action="index.php?action=view_other_user" method="post">
                    <input type="submit" 
                        value="view">
                    <input type="hidden" name="userName"
                       value="<?php echo htmlspecialchars($user->getUserName()); ?>">
                </form></td>
        </tr>
        <?php endforeach;?>
        </tr>
        </div>
    </body>
</html>
