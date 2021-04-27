<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ($userName); ?>'s Profile</title>
        <link href="styling/main.css" rel="stylesheet" type="text/css"/>
    </head>
    
        
            
        <header>
            <h1><?php echo ($userName); ?>'s Profile</h1>         
        </header>            
        <nav>
            <a href="index.php?action=log_out">Log Out</a>
            
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
        <!---Test Code--->
        <?php
            if(empty($pennies)){
                echo 'This user does not have any pennies';
            }
            else {
                
            
        ?>
        <br>
        <br>
        <table>
        <tr>
            <th>Penny Year</th>
            <th>Penny Mint</th>
            <th>Penny Condition</th>
            <th>Penny Amount</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($pennies as $penny) : ?>
        <tr>
            <td><?php echo htmlspecialchars($penny->getPennyYear()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyMint()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyCondition()); ?></td>
            <td><?php echo htmlspecialchars($penny->getPennyAmount()); ?></td>                      
            <td><form action="." method="post">
                <input type="hidden" name="action"
                       value="update_penny">
                <input type="hidden" name="penny_id"
                       value="<?php echo htmlspecialchars($penny->getPennyID()); ?>">
                <input type="submit" value="Update">
                </form><form action="." method="post">
                <input type="hidden" name="action"
                       value="delete_penny">
                <input type="hidden" name="penny_id"
                       value="<?php echo htmlspecialchars($penny->getPennyID()); ?>">
                <input type="submit" value="Delete">
                </form></td>
        </tr>
        <?php endforeach; }?>
        </table>
        <form action="index.php?action=add_penny" method="post">  
            <label>Penny Year</label>
            <input type="text" name="pennyYear" id="pennyYear" value="<?php echo htmlspecialchars($pennyYear); ?>"
            <br>
            <label>Penny Mint</label>
            <input type="text" name="pennyMint" id="pennyMint" value="<?php echo htmlspecialchars($pennyMint); ?>"
            <br>
            <label>Penny Condition</label>
            <input type="text" name="pennyCondition" id="pennyCondition" value="<?php echo htmlspecialchars($pennyCondition); ?>"
            <br>
            <label>Penny Amount</label>
            <input type="text" name="pennyAmount" id="pennyAmount" value="<?php echo htmlspecialchars($pennyAmount); ?>"               
            <br>
            <br>
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Add">
            </div>             
            </form>
        <!----------------------------BOTTOM OF FORM---------------------------> 
        
    
</html>