<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('functions.php');
if(isset($_POST['submit'])){
    if (isset($_POST['login'])&&  isset($_POST['pw']) && isset($_POST['em'])){
        $con =  database::connect();
        $str = "INSERT INTO users (`lg`, `pw`,`email`) VALUES('$_POST[login]', SHA1('$_POST[pw]'), '$_POST[em]')";
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
        <title>register page</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            login:<input type="text" name="login"><br>
            password:<input type="text" name="pw"><br>
            e-mail:<input type="text" name="em"><br>
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</html>
