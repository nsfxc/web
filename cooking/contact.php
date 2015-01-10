<?php
    session_name("shen");
// ne pas mettre d'espace dans le nom de session !
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
?><!DOCTYPE html>
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
<script type="text/javascript">
    function alertmessage(){
        alert("Your message have been send!");
    }
</script>
<html>
	<head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/registion.js"></script>
        <title>plan page</title>
    </head>
	<body>
<?php
    require("layout.php");
    require("login.php");
    echo $header;
    logInOutForm();
    echo $headerlast;
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
	</body>
</html>