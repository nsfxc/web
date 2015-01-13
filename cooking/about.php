<!DOCTYPE html>
<?php
    require("developper/layout.php");
    echo $head;
    echo "<title>About us</title>";
    head();
echo <<<END
    <section class='menu-padding'>
    <div class='container jumbotron'>
    <h3>Two girls who enjoy life, enjoy delicious food and enjoy sharing with others!</h3>
    <br>Wanna cook with us? Let's start from here!<br><br>
    <a href='recipeView.php'><img src="css/img/about.jpg"></a>
    </div></section>
END;
    echo $footer;
?>
