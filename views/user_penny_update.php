<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ($userName); ?>'s Penny Updates</title>
        <link href="styling/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
        
            
        <header>
            <h1><?php echo ($userName); ?>'s Penny Update</h1>         
        </header>            
        <nav>
            <a href="index.php?action=log_out">Log Out</a>
            
            <a href="index.php?action=user_profile_return">Return To Profile</a>
        </nav>  
        <br>
        <br>
        <br>
        <br>
        <!--Set pennyMint, pennyCondition, pennyAmount, and pennyYear for further use-->
        <?php  
            if(!isset($pennyMint)) { $pennyMint = '';} 
            if(!isset($pennyCondition)) { $pennyCondition = '';} 
            if(!isset($pennyAmount)) { $pennyAmount = '';} 
            if(!isset($pennyYear)) { $pennyYear = '';}
        ?>
        
        <!----------------------------TOP OF FORM------------------------------>
        <table>
        <tr>
            <th>Penny Year</th>
            <th>Penny Mint</th>
            <th>Penny Condition</th>
            <th>Penny Amount</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($penny->getPennyYear()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyMint()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyCondition()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyAmount()); ?></td>                      
        </tr>
        </table>
        <form action="index.php?action=submit_update_penny" method="post">  
            <input type="hidden" name="penny_id"
                       value="<?php echo htmlspecialchars($penny->getPennyID()); ?>">
            <label>Penny Year</label>
            <input type="text" name="pennyYear" id="pennyYear" value="<?php echo htmlspecialchars($penny->getPennyYear()); ?>"
            <br>
            <label>Penny Mint</label>
            <input type="text" name="pennyMint" id="pennyMint" value="<?php echo htmlspecialchars($penny->getPennyMint()); ?>"
            <br>
            <label>Penny Condition</label>
            <input type="text" name="pennyCondition" id="pennyCondition" value="<?php echo htmlspecialchars($penny->getPennyCondition()); ?>"
            <br>
            <label>Penny Amount</label>
            <input type="text" name="pennyAmount" id="pennyAmount" value="<?php echo htmlspecialchars($penny->getPennyAmount()); ?>"               
            <br>
            <br>
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Update">
            </div>             
            </form>
        <!----------------------------BOTTOM OF FORM---------------------------> 
        <!--Display Error Message-->
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>               
        </div>
    </body>
</html>