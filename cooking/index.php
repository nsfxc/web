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
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/registion.js"></script>
        <title>welcome page</title>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js.js"></script>
        <div class="container">
        <div class="row">
            <div class="col-md-8 title">
               <h2> Little Cooker</h2>
            </div>
            <div id="regis" class="col-md-4">
                    Login:<input type="text" name="login" class="input" id="user"><br>
                    Password:<input type="password" name="pw" class="input" id="pass">
                    <br><br>
                    <input type="submit" id="subb" value="submit"> 
                <form action="userAdd.php" method="POST"><input type="submit" value="sign up"></form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>cook your self</h3>   
            </div>
            <div class="col-md-4">
                <button type="button" onclick="location.href='recipeAdd.php'">ajoute</button>
            </div>
            <div class="col-md-4">
                <h3>plan your party</h3>
            </div>
            
        </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
