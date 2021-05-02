<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ($userName); ?>'s Profile</title>
        <link href="styling/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
        <header>
            <h1><?php echo ($userName); ?>'s Profile</h1>         
        </header>   
        <nav>
            <a href="index.php?action=user_listings">Return to user listings</a>
            
            <a href="index.php?action=user_profile_return">Return To Profile</a>
        </nav>  
        <?php
        // put your code here
        ?>
            
        <table>
        <tr>
            <th>Penny Year</th>
            <th>Penny Mint</th>
            <th>Penny Condition</th>
            <th>Penny Amount</th>
        </tr>
        <?php foreach ($pennies as $penny) : ?>
        <tr>
            <td><?php echo htmlspecialchars($penny->getPennyYear()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyMint()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyCondition()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyAmount()); ?></td>                      
        </tr>
        <?php endforeach;?>
        </table>
        </div>
    </body>
</html>
