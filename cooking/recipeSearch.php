<!DOCTYPE html>
<?php
    require("layout.php");
    echo $head;
    echo "<title>Search</title>";
    head();
?>
    <section class="menu-padding">
	<div class="container jumbotron">
            <div class="title">
                Find Recipes
            </div>
            <form class="form-horizontal" action='<?php echo $_SERVER['PHP_SELF'];?>' method="POST" id="myform">
                <div class="form-inline">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                    <label for="name">Occasion</label>
                    <select name='occasion'>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Meal">Meal</option>
                        <option value="Teatime">Teatime</option>
                        <option vlaue="Party">Party</option>
                    </select>
                </div>
                <br>
                <table class="table-bordered" id="tableing">
                    <tr>
                        <th>Ingredient name</th>
                        <th></th>
                    </tr> 
                    <tr>
                        <td><input type="text" name="ing1" id="ing1"></td>
                        <td><input type="button" class="btn btn-default" name="delete1" id="delete1" value="delete" onclick="deleteRow(1)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">Add an ingredient</a>
                <br><br>
                <div id="subm">
                    <input class="btn btn-default" type="submit" value="Search" name="submit"><br> 
                </div>
            </form>
	</div>
    </section>
<?php
    if (isset($_POST['submit'])){
        $con=  database::connect();
        $occasion=$_POST['occasion'];
        if($_POST['name']!=''){
            $name=$_POST['name'];
            $str="SELECT `id` FROM `recipes` WHERE `name`='$name' AND `occasion`='$occasion'";
        }
        else{
            $str="SELECT `id` FROM `recipes` WHERE `occasion`='$occasion'";
        }
        $kk=$con->query($str);
        $result=$kk->fetchALL();
        $no=1;
        $ingno="ing";
        $ingno.=(string)$no;
        $l= sizeof($result);
        while($l!=0 && isset($_POST[$ingno])){
            if ($_POST[$ingno]!=''){
            $ingname=$_POST[$ingno];
            $id=database::findingid($ingname,$con);
            if($id!= (-1)){
                $str="SELECT `recipe` FROM recipesingredients WHERE `ingredient`='$id'";
                $res=$con->query($str)->fetchALL();
            }
            $x=0;
            while($l>0 && $x<$l){
                $y=0;
                $ls=sizeof($res);
                while($y<$ls && $result[$x]['id']!=$res[$y]['recipe']){
                    $y++;
                }
                if ($y==$ls){
                    for($z=$x;$z<$l;$z++){
                        $result[$z]=$result[$z+1];
                    }
                    $l--;$x--;
                };
                $x++;
            }}
            $no++;
            $ingno="ing";
            $ingno.=(string)$no;
        }
        if($l!=0){
            for($x=0;$x<$l;$x++){
                $id=$result[$x]['id'];
                $row=$con->query("SELECT * FROM `recipes` WHERE `id`='$id'")->fetchALL();
                $i=0;
                echo "<div class='recipe'>";
                echo $row[$i]['name'];
                if (file_exists("recipeimg/".$id)){echo "<img class='img-circle' src='recipeimg/$id.png'>";}else{
                    echo"<img class='img-circle' src='recipeimg/cooker.png'>";
                }
                $ing=$con->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                echo"<table class='table tablebordered'><thead><tr><th>Ingredient Name</th><th>Amount</th><tr><thead>";
                $rowing=$ing->fetchALL();
                for($j=0;$j<sizeof($rowing);$j++){
                    $id=$rowing[$j]['ingredient'];
                    $ingname=$con->query("SELECT * FROM `ingredients` WHERE `id`='$id' ");
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
            }
        }
        else{
            echo"NO result!";
        }
        $con=null;
    };
    echo $footer;
?>