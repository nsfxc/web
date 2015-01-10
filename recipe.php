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
                require_once("login.php");
                logInOutForm();

    echo $headerlaster;
    ?>
            
            <section class="menu-padding">
                <?php
                    require("functions.php");
                    $dsn=  database::connect();
                    $result=$dsn->query("SELECT * FROM `recipes` ");
                    $row = $result->fetchALL();
                    $n=sizeof($row);
                    $limit=1;
                    $totalpage=floor(($n-1)/$limit)+1;
                    $page=$_GET['page'];
                    if($page){
                        $start=($page-1)*$limit;
                    }
                    else{
                        $start=0;$page=1;
                    }
                    if($start+$limit<=$n){$fin=$start+$limit;}else{$fin=$n;};
                    for($i=$start;$i<$fin;$i++ ){
                        echo "<div class=recipe>";
                        echo $row[$i]['name'];
                        echo"<br><h4>Ingredients</h4><br>";
                        $id=$row[$i]['id'];
                        $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                        echo"<table class=ingredient>";
                        $rowing=$ing->fetchALL();
                        for($j=0;$j<sizeof($rowing);$j++){
                            $id=$rowing[$j]['ingredient'];
                            $ingname=$dsn->query("SELECT * FROM `ingredients` WHERE `id`='$id' ");
                            $name=$ingname->fetch(PDO::FETCH_ASSOC);
                            echo"<tr><td>";
                            echo $name['name'];
                            echo"</td><td>";
                            echo $rowing[$j]['amount'];
                            echo"</td></tr>";
                        };
                        echo"</table><br>Method:<br>";
                        echo '<p class=method>';
                        echo $row[$i]["method"];
                        echo '</p>';
                        echo "</div>";
                    };
                    $dsn=null;
                    if($page>1){$prev=$page-1;};
                    if($page<$totalpage){$next=$page+1;};
                    $pagination="";
                    if($totalpage>1){
                        $pagination.="<div class='pagination'>";
                        if($page>1){
                            $pagination.="<a href='recipe.php?page=0'>first page</a>";
                        }
                        if($page>3){$pagination.="...";};
                        if($page>2){
                            $pagination.="<a href='recipe.php?page=$prev'>$prev</a>";
                        }
                        $pagination.="<span class='current'>current</span>";
                        if($page+1<$totalpage){
                            $pagination.="<a href='recipe.php?page=$next'>$next</a>...";
                        }
                        if($page+2<$totalpage){
                            $pagination.="...";
                        }
                        if($page<$totalpage){
                            $pagination.="<a href='recipe.php?page=$totalpage'>last page</a>";
                        }
                        $pagination.="</div>";
                    }
                    echo $pagination;
                ?>
            </section>
<?php
    require("layout.php");
    echo $footer;
?>
	</body>
</html>
