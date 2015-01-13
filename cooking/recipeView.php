<!DOCTYPE html>
<?php
    require("developper/layout.php");
    require("developper/show.php");
    echo $head;
    echo "<title>Show Recipes</title>";
    head();
    ?>
    <section class="menu-padding">
        <div class="jumbotron container">
<?php
    function juge($str){
        if(isset($_GET[$str])){
            return "$str=$_GET[$str]";
        }else
            {return "";}
    }
    function linked($str,$url){
        if(isset($_GET[$str])){
            echo "<div class='occasion'>$str <a href='recipeView.php?$url'><span class='glyphicon glyphicon-chevron-up'></span></a>";
            show("`occasion`='$str'",$str,$_GET[$str],$url,"recipeView.php?");
            echo"</div>";
        }
        else{
            echo "<div class='occasion'>$str <a href='recipeView.php?$url&$str=0'><span class='glyphicon glyphicon-chevron-down'></span></a>";
            echo "</div>";
        }
    }
    $lmeal=juge("Meal");
    $lparty=juge('Party');
    $lbreakfast=juge('Breakfast');
    $lteatime=juge('Teatime');
    linked("Breakfast",$lmeal."&".$lparty."&".$lteatime);
    linked("Meal",$lbreakfast."&".$lparty."&".$lteatime);
    linked("Teatime",$lmeal."&".$lparty."&".$lbreakfast);
    linked("Party",$lmeal."&".$lbreakfast."&".$lteatimel);
    echo "</div></section>";
    echo $footer;
?>

 <?php
    if (isset($_POST['delete'])){
        $val=$_POST['delete'];
        $dsn=  database::connect();
        $str="DELETE FROM `recipes` WHERE `id`=$val";
        if($dsn->query($str)){
            echo"<script>Delete succeed!</script>";
        }
        else{
            echo"<script>Something Wrong!</script>";
        }
        $dsn=null;
    }
?>