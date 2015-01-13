<!DOCTYPE html>
<?php
/*
 C'est la page qui permet à changer les informations des utilisateurs.  
 */
    require("developper/layout.php");
    echo $head;
    echo"<title>Modification</title>";
    head();
    echo"<section class=menu-padding><div class=jumbotron container>";
    $dsn=  database::connect();
    $id=$_SESSION['id'];
    if(isset($_POST['submit'])){
        $pass1=$_POST['ancientpassword'];
        $pass2=$_POST['newpassword1'];
        $pass3=$_POST['newpassword2'];
        if (SHA1($pass1)==$_SESSION['password']){
            if($pass2==$pass3){
                $str="UPDATE `users` SET `password`='$pass2' WHERE `id`='$id'";
                if($dsn->query($str)==true){
                    $_SESSION['password']=$pass2;
                    echo 1;
                }
                else{
                    echo "Error";
                }   
            }
            else{
                echo"Different new passwords!";
            }
        }
        else{
            echo"Ancient Password incorrect!";
        }
    }
    if(isset($_GET['email'])){
        $email=$_GET['email'];
        $str="UPDATE `users` SET `email`='$email' WHERE `id`='$id'";
        if($dsn->query($str)==true){
            $_SESSION['email']=$email;
            echo 1;
        }
        else{
            echo "Error";
        }
    }
    if(isset($_GET['username'])){
        $username=$_GET['username'];
        $str="UPDATE `users` SET `username`='$email' WHERE `id`='$id'";
        if($dsn->query($str)==true){
            $_SESSION['username']=$username;
            echo 1;
        }
        else{
            echo "Error";
        }
        
    }
    if(isset($_GET['password'])){
echo <<<END
        <form class='form-horizontal' action="change.php" method="POST">
            <div class="form-group" id="regis">
                <label class="col-sm-2 clontrol-label">Ancient Password</label>
                <div class="col-sm-3">
                    <input type="password" name="ancientpassword" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 clontrol-label">New Password</label>
                <div class="col-sm-3">
                    <input type="password" name="newpassword1" id="password1" required>
                </div>
                <div id="message2"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 clontrol-label">Repeat your password</label>
                <div class="col-sm-3">
                    <input type="password" name="newpassword2" id="password2" required>
                </div>
                <div id="message3"></div>
            </div>
            <input class="btn btn-default" type="submit" name="submit" value="submit">
        </form>
END;
    }
    echo "</div></section>";
    $dsn=null;
    echo $footer;
?>
