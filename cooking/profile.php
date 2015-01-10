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
        <script src="js/profile.js"></script>
        <title>plan page</title>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js.js"></script>
<?php
    require("layout.php");
    echo $header;
    require_once("login.php"); 
    logInOutForm();
    echo $headerlast;
    $id=$_SESSION['id'];
    $dsn=database::connect();
    $str="SELECT * FROM `users` where `id`='$id'";
    $user=$dsn->query($str)->fetchALL();
    $email=$user[0]['email'];
    $username=$user[0]['username'];
    $str="SELECT * FROM `recipes` where `user`='$id'";
    $recipe=$dsn->query($str)->fetchALL();
    $n=sizeof($recipe);
echo <<<END
    <section class="menu-padding">
        <input type="button" value=$id id="id">
        <div id="pemail">
            email:$email
            <input type="submit" value="modify" id="email">
        </div>
        <div id="pusername">
            username:$username
            <input type="submit" value="modify" id="username">
        </div>
        <div id="ppassword">
            <input type="submit" value="change password" id="password">
        </div>
END;
    $limit=3;
    $totalpage=floor(($n-1)/$limit)+1;
    $page=$_GET['page'];
    if($page){
        $start=($page-1)*$limit;
    }
    else{
        $start=0;$page=1;
    }
    if($n==0){
        echo"No recipe!";
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
            $pagination.="<li><a href='profile.php?id=$id&page=0'><<</a></li>";
        }
        if($page>2){
            $pagination.="<li><a href='profile.php?id=$id&page=$page-1'><</a></li>";
        }
        $pagination.="<li class='active'><a href='profile.php?id=$id&page=$page'>$page</a></li>";
        if($page+1<$totalpage){
        $pagination.="<li><a href='profile.php?id=$id&page=$page+1'>></a></li>";}
        if($page<$totalpage){
            $pagination.="<li><a href='profile.php?id=$id&page=$totalpage'>>></a><li>";
        }
        $pagination.="</ul></div>";
    }
    echo $pagination;
    $dsn=null;
    echo"</section>";
    echo $footer;
?>
	</body>
</html>