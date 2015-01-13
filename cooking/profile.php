<!DOCTYPE html>
<?php
    require("developper/layout.php");
    echo $head;
    echo "<title>Profile</title><script src='js/profile.js'></script>";
    head();
    if (isset($_SESSION['loggedIn'])){
        if(isset($_SESSION['admin'])){
            $dsn=database::connect();
            $recipno=database::norecipe($dsn);
            $userno=  database::nouser($dsn);
            echo "<section class='menu-padding'>";
            echo "<div class='container jumbotron'>";
            echo "There are $recipno recipes is our site!<br>There are $userno users in our site!<br>";
            echo "<a href='recipesmodify.php'>Check out recipes</a><br>";
            echo "<a href='usermodify.php'>Check out users</a>";
        }
        else{
            $userid=$_SESSION['id'];
            $dsn=database::connect();
            $str="SELECT * FROM `users` where `id`='$userid'";
            $user=$dsn->query($str)->fetchALL();
            $email=$user[0]['email'];
            $username=$user[0]['username'];
            $id=$user[0]['id'];
echo <<<END
            <section class="menu-padding">
                <div id="pemail">
                   email:$email
                    <input type="submit" value="modify" id="email">
                </div>
                <div id="pusername">
                   username:$username
                    <input type="submit" value="modify" id="username">
                </div>
                <div id="ppassword">
                    <input type="submit" value="change password" id="password">
                </div>
END;
            $dsn=null;
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=0;
            }
            show("`user`='$id'","page",$page,"","profile.php?");
            echo"</div></section>";
        }
    }
    else{
        echo "<section class='menu-padding'>PLEASE LOGIN!</section>";
    }
    echo $footer;
?>
	</body>
</html>

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