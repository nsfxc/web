<?php
    session_name("shen");
// ne pas mettre d'espace dans le nom de session !
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
?><!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/registion.js"></script>
        <title>Show Recipes</title>
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
<?php
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
            echo"<div class='recipe'>No result!</div>";
        }
        if($start+$limit<=$n){$fin=$start+$limit;}else{$fin=$n;};
            for($i=$start;$i<$fin;$i++ ){
                echo "<div class='recipe'>";
                $id=$row[$i]['id'];
                echo $row[$i]['name'];
                if(file_exists("recipeimg/".$id.".png")){
                    echo "<img class='image-rounded' src='recipeimg/$id.png'>";
                }else{
                    echo"<img src='recipeimg/cooker.png'>";
                }
                $id=$row[$i]['id'];
                $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                echo"<table class='table table-bordered'><thead><tr><th>Ingredient Name</th><th>Amount</th><tr><thead>";
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
        echo "<div class='occasion'>Breakfast <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-up'></span></a>";
        show("Breakfast",$breakfast,$url);
        echo"</div>";
    }
    else{
        $url="Breakfast=0&".$lmeal."&".$lteatime."&".$lparty;
        echo "<div class='occasion'>Breakfast <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-down'></span></a>";
        echo"</div>";
    }
    if(isset($_GET['Meal'])){
        $url=$lbreakfast."&".$lteatime."&".$lparty;
        echo "<div class='occasion'>Meal <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-up'></span></a>";
        show("Meal",$meal,$url);
        echo"</div>";
    }
    else{
        $url="Meal=0&".$lbreakfast."&".$lteatime."&".$lparty;
        echo "<div class='occasion'>Meal <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-down'></span></a>";
        echo "</div>";
    }
    if(isset($_GET['Teatime'])){
        $url=$lbreakfast."&".$lmeal."&".$lparty;
        echo "<div class='occasion'>Teatime <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-up'></span></a>";
        show("Teatime",$teatime,$url);
        echo "</div>";
    }
    else{
        $url="Teatime=0&".$lbreakfast."&".$lmeal."&".$lparty;
        echo "<div class='occasion'>Teatime <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-down'></span></a>";
        echo "</div>";
    }
    if(isset($_GET['Party'])){
        $url=$lbreakfast."&".$lteatime."&".$lmeal;
        echo "<div class='occasion'>Party <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-up'></span></a>";
        show("Party",$party,$url);
        echo"</div>";
    }
    else{
        $url="Party=0&".$lbreakfast."&".$lteatime."&".$lmeal;
        echo "<div class='occasion'>Party <a href='recipe.php?$url'><span class='glyphicon glyphicon-chevron-down'></span></a>";
        echo"</div>";
    }
?>
            </div>
            </section>
<?php
    echo $footer;
?>
	</body>
</html>
