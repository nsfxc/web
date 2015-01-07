<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('functions.php');
if(isset($_POST['submit'])){
    if (isset($_POST['name'])&&  isset($_POST['catalog'])){
        $con =  database::connect();
        $str = "INSERT INTO ingredients (`name`, `type`) VALUES('$_POST[name]', '$_POST[catalog]')";
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
        <title>ingredient addition page</title>
    </head>
    <body>
        <?php
        require("layout.php");
        echo $header;
        ?>
        <form action="ingrdAdd.php" method="post">
            name:<input type="text" name="name"><br>
            type:<select name="catalog">
                <option value="vegetable" selected>vegetable</option>
                <option value="meat">meat</option>
                <option value="fruit">fruit</option>
                <option value="dairy">dairy</option>
                <option value="condiment">condiment</option>
            </select><br>
            <input type="submit" name="submit" value="submit">
        </form>
    <?php
        require("layout.php");
        echo $fooder;
                ?>
    </body>

</html>
