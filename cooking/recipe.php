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
                <?php
                    require("functions.php");
                    $dsn=  database::connect();
                    $result=$dsn->query("SELECT * FROM `recipes` ");
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo $row['name'];
                        $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`=$row[id]");
                        while ($rowing=$ing->fetch(PDO::FETCH_ASSOC)){
                            echo $rowing[ing];
                            echo $rowing[amount];
                        };
                        echo $row['methode'];
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
