<?php
/*
 * cette page est crée pour afficher les recettes surs des sous-pages, sur chaque page, il y a 3 recettes affichié.
 * 'object' est le variable à rechercher dans la base de donnée
 * 'index' est le nom du sous-page
 * 'no' c'est le numéro du sous-page actuelle
 * 'url' est le page qui utilise cette function 
 */
function show($object,$index,$no,$pag,$url){  
        $dsn= database::connect();
        $result=$dsn->query("SELECT * FROM `recipes` WHERE $object");
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
        if (isset($_SESSION['loggedIn'])){
            $php='PHP_SELF';
            echo "<form action='$_SERVER[$php]' method='POST'>";
        }
            for($i=$start;$i<$fin;$i++ ){
                echo "<div class='recipe'>";
                $id=$row[$i]['id'];
                if (isset($_SESSION['admin'])){
                    $userid=$_SESSION['id'];
                    echo"<div class='modif'>Delete<input type='submit' name='delete' value='$id'></div>";
                    if($_SESSION['id']==$row[$i]['user']){
                        echo"<div class='modif'><a href='recipeAdd.php?action=modify&recipe=$id&user=$userid'>Modify</a></div>";
                    }
                }
                else{
                    if (isset($_SESSION['loggedIn'])&&($_SESSION['id']==$row[$i]['user'])){
                        $userid=$_SEESION['id'];
                        echo"<div class='modif'><a href='recipeAdd.php?action=modify&recipe=$id&user=$userid'>Modify  </a>";
                        echo"Delete<input type='submit' name='delete' value='$id'></div>";}
                }
                echo $row[$i]['name'];
                if(file_exists("recipeimg/".$id.".png")){
                    echo "<img class='img-circle' src='recipeimg/$id.png'>";
                }else{
                    echo"<img class='img-circle' src='recipeimg/cooker.png'>";
                }
                $id=$row[$i]['id'];
                $ing=$dsn->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                echo"<table class='ingredient table table-bordered'><thead><tr><th>Ingredient Name</th><th>Amount</th><tr><thead>";
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
            if(isset($_SEESION['loggedIn'])){
                echo"</form>";
            }
            if($page>1){$prev=$page-1;};
            if($page<$totalpage){$next=$page+1;};
            $pagination="";
            if($totalpage>1){
                $pagination.="<div class='text-center'><ul class='pagination'>";
                if($page>1){
                    $pagination.="<li><a href='$url$index=0&$pag'><<</a></li>";
                }
                if($page>2){
                    $pagination.="<li><a href='$url$index=$prev&$pag'><</a></li>";
                }
                $pagination.="<li class='active'><a href='$url$index=$page&$pag'>$page</a></li>";
                if($page+1<$totalpage){
                $pagination.="<li><a href='$url$index=$next&$pag'>></a></li>";}
                if($page<$totalpage){
                    $pagination.="<li><a href='$url$index=$totalpage&$pag'>>></a><li>";
                }
                $pagination.="</ul></div>";
            }
            echo $pagination;
            $dsn=null;
    }
?>
