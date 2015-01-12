<!DOCTYPE html>
<?php
    require("layout.php");
    require("show.php");
    echo $head;
    echo "<title>recipe modify</title>";
    head();
    if (isset($_SESSION['admin'])){
            $dsn=database::connect();
            $recipno=database::norecipe($dsn);
            $userno=  database::nouser($dsn);
            echo "<section class=menu-padding>";
            echo "<div class='container jumbotron'>";
            echo "There are $recipno recipes is our site!<br>There are $userno users in our site!<br>";
            echo "<a href='usermodify.php'>Check out users</a><br>";
            $dsn=null;
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=0;
            }
            show("`id`!=''","page",$page,"","recipesmodify.php?");
            echo"</div></section>";
    }else{
        echo "<section class='menu-padding'>Only for administers!</section>";
    }
    echo $footer;
?>
<?php
    if (isset($_POST['delete'])){
        $val=$_POST['delete'];
        $dsn=  database::connect();
        $str="DELETE FROM `recipes` WHERE `id`=$val";
        if($dsn->query($str)){
            echo"<script>alert('Delete succeed!')</script>";
        }
        else{
            echo"<script>alert('Something Wrong!')</script>";
        }
        $dsn=null;
    }
?>