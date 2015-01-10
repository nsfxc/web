<?php
    session_name("shen");
// ne pas mettre d'espace dans le nom de session !
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
?>
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('functions.php');
if(isset($_POST['submit'])){
    if (isset($_POST['username'])&&  isset($_POST['password']) && isset($_POST['email'])){
        $con =  database::connect();
        $str = "INSERT INTO users (`username`, `password`,`email`) VALUES('$_POST[username]', '$_POST[password]', '$_POST[email]')";
        $con->query($str);
        $con=null;
        
    }
    else{
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/registion.js"></script>
        <title>register page</title>
    </head>
    <body>
<?php
    require("layout.php");
    echo $header;
    require("login.php");
    logInOutForm();
    echo $headerlast;
    
?>
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js.js"></script>
        <form action="index.php" method="post">
            <div id="regis">
               email:<input type="text" name="email" id="email"><br>
               <div id="message"></div>
            </div>
            password:<input type="password" name="password"><br>
            username:<input type="text" name="username"><br>
            <input type="submit" name="submit" value="submit" id="submit">
        </form>
<?php
echo $footer;
?>
    </body>
</html>
