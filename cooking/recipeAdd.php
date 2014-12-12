<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/recipeAddscript.js"></script>
    </head>
<body>
    <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js.js"></script>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <div id="ing">
         Ingredients:<input type="text" name="name" id="ingbox"><br>
         Amount:<input type="text" name="amount" id="ingamount"><br>
         <div id="message"></div>
         <div id="addin"></div>
        </div>
        <div id="met">
            Cooking methods:<input type="text" name="methode"><br>
        </div>
        <div id="subm">
            <input type="submit" value="submit" name="submit"><br> 
        </div>
    </form>
</body>
</html>

