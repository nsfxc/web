<?php
session_name("shen");
// ne pas mettre d'espace dans le nom de session !
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
?>
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
            <?php
                require_once("login.php");
                logInOutForm();
                ?>
		<div class="header">
			<div class="background">&nbsp;</div>
		</div>
		<section class="menu-padding">
			<div class="jumbotron">
				<form action="plan.php" method="post">
					Occasion
					<input type="text" name="occasion">
					Ingredients
					<div id="ing">
         				<input type="text" name="name" id="ingbox"><br>
         				Amount<input type="text" name="amount" id="ingamount"><br>
         				<div id="message"></div>
         				<div id="addin"></div>
                                        <input type="submit" name="submit" value="submit">
        			</div>
				</form>
			</div>
		</section>
<?php
    require("layout.php");
    echo $footer;
?>
	</body>
</html>