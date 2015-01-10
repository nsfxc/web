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
    echo $headerlast;
    ?>
    <section class="menu-padding">
<?php
    require("functions.php");
    function show($object,$no,$pag){  
        $dsn= database::connect();
        $result=$dsn->query("SELECT * FROM `recipes` WHERE `occasion`='$object'");
        $row = $result->fetchALL();
        $n=sizeof($row);
        $limit=3;
        $totalpage=floor(($n-1)/$limit)+1;
        $page=$no;
        if($page){
            $start=($page-1)*$limit;
        }
        else{
            $start=0;$page=1;
        }
        if($n==0){
            echo"No result!";
        }
        if($start+$limit<=$n){$fin=$start+$limit;}else{$fin=$n;};
            for($i=$start;$i<$fin;$i++ ){
                echo "<div class='recipe'>";
                echo $row[$i]['name'];
                $id=$row[$i]['id'];
                $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                echo"<table class='ingredient table'><thead><tr><th>Ingredient Name</th><th>Amount</th><tr><thead>";
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
                echo "<p class='method'>";
                echo $row[$i]["method"];
                echo '</p>';
                echo "</div>";
            };
            if($page>1){$prev=$page-1;};
            if($page<$totalpage){$next=$page+1;};
            $pagination="";
            if($totalpage>1){
                $pagination.="<div class='text-center'><ul class='pagination'>";
                if($page>1){
                    $pagination.="<li><a href='recipe.php?$object=0&$pag'><<</a></li>";
                }
                if($page>2){
                    $pagination.="<li><a href='recipe.php?$object=$prev&$pag'><</a></li>";
                }
                $pagination.="<li class='active'><a href='recipe.php?$object=$page&$pag'>$page</a></li>";
                if($page+1<$totalpage){
                $pagination.="<li><a href='recipe.php?$object=$next&$pag'>></a></li>";}
                if($page<$totalpage){
                    $pagination.="<li><a href='recipe.php?$obkect=$totalpage&$pag'>>></a><li>";
                }
                $pagination.="</ul></div>";
            }
            echo $pagination;
            $dsn=null;
    }
    require("layout.php");
    $breakfast=$_GET['Breakfast'];
    $meal=$_GET['Meal'];
    $teatime=$_GET['Teatime'];
    $party=$_GET['Party'];
    $page="plan.php?";
    if(isset($_GET['Breakfast'])){
        $lbreakfast="Breakfast=$breakfast";
    }else
        {$lbreakfast="";}
    if(isset($_GET['Meal'])){
        $lmeal="Meal=$meal";
    }else{$lmeal="";}
    if(isset($_GET['Teatime'])){
        $lteatime="Teatime=$teatime";
    }else{$lteatime="";}
    if(isset($_GET['Party'])){
        $lparty="Party=$party";
    }else{$lparty="";}
    if(isset($_GET['Breakfast'])){
        $url=$lmeal."&".$lteatime."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Breakfast-</a>";
        show("Breakfast",$breakfast,$url);
    }
    else{
        $url="Breakfast=0&".$lmeal."&".$lteatime."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Breakfast+</a>";
    }
    if(isset($_GET['Meal'])){
        $url=$lbreakfast."&".$lteatime."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Meal-</a>";
        show("Meal",$meal,$url);
    }
    else{
        $url="Meal=0&".$lbreakfast."&".$lteatime."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Meal+</a>";
    }
    if(isset($_GET['Teatime'])){
        $url=$lbreakfast."&".$lmeal."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Teatime-</a>";
        show("Teatime",$teatime,$url);
    }
    else{
        $url="Teatime=0&".$lbreakfast."&".$lmeal."&".$lparty;
        echo "<div class='plan'><a href='recipe.php?$url'>Teatime+</a>";
    }
    if(isset($_GET['Party'])){
        $url=$lbreakfast."&".$lteatime."&".$lmeal;
        echo "<div class='plan'><a href='recipe.php?$url'>Party-</a>";
        show("Party",$party,$url);
    }
    else{
        $url="Party=0&".$lbreakfast."&".$lteatime."&".$lmeal;
        echo "<div class='plan'><a href='recipe.php?$url'>Party+</a>";
    }
                ?>
            </section>
<?php
    require("layout.php");
    echo $footer;
?>
	</body>
</html>
