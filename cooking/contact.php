<!DOCTYPE html>
<?php
    if (isset($_POST['submit'])){
        $receivemessage="Hi, we have recieved your message, we will give your an response as soon as possible. "
                . "Thank you for supporting our site!";
        mail('nnssffxxcc@gmail.com','Little Cooker',$_POST['message']);
        mail($_POST['email'],'Little Cooker',$receivemessage);
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
    echo $header;
?>
            <section class="menu-padding">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <p>Email:</p>
                <input type="text" name="email" value="email">
                <br>
                <p>Message:</p><br>
                <textarea rows="10" cols="50" name="message">
                    Please write your message here...
                </textarea>
                <br>
                <input type="submit" name="submit" value="submit" onclick="alertmessage()">
            </form>
            </section>

<?php
    require("layout.php");
    echo $footer;
?>
	</body>
</html>