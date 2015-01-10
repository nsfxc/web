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
            <section class="menu-padding">
                <?php
                    require("functions.php");
                    $dsn=  database::connect();
                    $result=$dsn->query("SELECT * FROM `recipes` ");
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo "<div class=recipe>";
                        echo $row['name'];
                        echo"<br><h4>Ingredients</h4><br>";
                        $id=$row['id'];
                        $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                        echo"<table class=ingredient>";
                        while ($rowing=$ing->fetch(PDO::FETCH_ASSOC)){
                            $id=$rowing['ingredient'];
                            $ingname=$dsn->query("SELECT * FROM `ingredients` WHERE `id`='$id' ");
                            $name=$ingname->fetch(PDO::FETCH_ASSOC);
                            echo"<tr><td>";
                            echo $name['name'];
                            echo"</td><td>";
                            echo $rowing['amount'];
                            echo"</td></tr>";
                        };
                        echo"</table><br>Method:<br>";
                        echo '<p class=method>';
                        echo $row["method"];
                        echo '</p>';
                        echo "</div>";
                    };
                    $dsn=null;
                ?>
            </section>
<?php
    require("layout.php");
    echo $footer;
?>
	</body>
</html>
