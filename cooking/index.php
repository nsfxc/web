<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <title>welcome page</title>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 title">
               <h2> Little Cooker</h2>
            </div>
            <div class="col-md-4">
                <form action="action.php" method="POST">
                    Login:<input type="text" name="login"><br>
                    Password:<input type="password" name="pw">
                    <br><br>
                    <input type="submit" value="submit"> 
                </form>
                <form action="reg.php" method="POST"><input type="submit" value="sign up"></form>
            </div>
        </div>
    </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
