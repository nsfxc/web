<!DOCTYPE html>
<?php
    require("developper/layout.php");
    echo $head;
    echo"<title>Modification</title>";
    head();
    $dsn=  database::connect();
    $id=$_SESSION['id'];
    $str="SELECT * FROM `users` WHERE `id`=$id";
    $result=$dsn->query($str)->fetchALL()[0];
    if(isset($_POST['submit'])){
        $pass1=$_POST['ancientpassword'];
        $pass2=$_POST['newpassword1'];
        $pass3=$_POST['newpassword2'];
        if (SHA1($pass1)==$result['password']){
            if($pass2==$pass3){
                $str="UPDATE `users` SET `password`='$pass2' WHERE `id`='$id'";
                if($dsn->query($str)==true){
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
            echo"password incorrect!";
        }
    }
    if(isset($_GET['email'])){
        $email=$_GET['email'];
        $str="UPDATE `users` SET `email`='$email' WHERE `id`='$id'";
        if($dsn->query($str)==true){
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
            echo 1;
        }
        else{
            echo "Error";
        }
        
    }
    if(isset($_GET['password'])){
echo <<<END
        <form action="change.php" method="POST">
            Ancient password:<input type="password" name="ancientpassword"><br>
            New password:<input type="password" name="newpassword1"><br>
            Repeat new password:<input type="password" name="newpassword2"><br>
            <input type="submit" name="submit" value="submit">
        </form>
END;
    }
    echo "</section>";
    echo $footer;
?>
