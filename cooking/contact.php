<!DOCTYPE html>
<?php
    if (isset($_POST['submit'])){
        $receivemessage="Hi, we have recieved your message, we will give your an response as soon as possible. "
                . "Thank you for supporting our site!";
        mail('nnssffxxcc@gmail.com','Little Cooker',$_POST['message']);
        if($_SESSION['loggedin']){
            $email=$_SESSION['email'];
            mail($email,'Little Cooker',$receivemessage);
        }
        else{
            if(isset($_POST['email'])){
                mail($_POST['email'],'Little Cooker',$receivemessage);
            }
            else{
echo <<<END
                <script>
                    alert("E-mail adress not right!");
                </script>
END;
            echo "11";
            }
        }  
    }
?>
<?php
    require("developper/layout.php");
    echo $head;
    echo "<title>Contact us</title>";
    head();
?>
    <section class="menu-padding">
        <div class="jumbotron container">
            <form class="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <?php
                    if(!$_SESSION['loggedIn']){
echo <<<END
                <div class="form-inline">
                    <lable>Email</lable>
                    <input type="text" name="email">
                </div>
END;
                    }
?>
                <br><div class="form">
                    <lable>Message:</lable><br>
                    <textarea rows="10" cols="50" name="message">
                        Please write your message here...
                    </textarea>
                </div>
                <input class="btn btn-default" type="submit" name="submit" value="submit" onclick="alertmessage()">
            </form>
                </div>
            </section>

<?php
    echo $footer;
?>