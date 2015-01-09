<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <title>register page</title>
    </head>
    <body>
        <form action="index.php" method="post">
            login:<input type="text" name="login" required><br>
            password:<input type="password" name="pw" required><br>
            e-mail:<input type="text" name="em" required<br>
            <input type="submit" name="submit" value="submit">
        </form>
    <?php
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
</body>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</html>
