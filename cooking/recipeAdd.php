<!DOCTYPE html>
<?php
    require("developper/layout.php");
    echo $head;
    echo"<title>Add Recipe</title>";
    echo "<script src='js/recipeAdd.js'></script>";
    head();
?>
        <section class="menu-padding">
            <div class="jumbotron container">
                <div class="title">Add Recipes</div>
                <form class="form-horizontal" action='<?php echo $_SERVER['PHP_SELF'];?>' method="POST" id="myform" enctype="multipart/form-data">
                <div class="form-inline">
                    <label for="name">Name</label>
                    <?php
                    $name='';
                    if (isset($_GET['action'])){
                        if ($_GET['action']=="modify"){
                            $recipe=$_GET['recipe'];
                            $user=$_GET['user'];
                        }
                        $dsn=  database::connect();
                        $str="select `name` from recipes where `id`=$recipe and `user`=$user";
                        $result=$dsn->query($str)->fetchALL();
                        if (sizeof($result)!=0){
                            $name=$result[0]['name'];
                        }
                        $dsn=null;
                    }
                    echo "<input class='form-control' type='text' name='name' id='name' placeholder='$name' required>";
                            ?>
                    <label for="name">Occasion</label>
                    <select name='occasion'>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Meal">Meal</option>
                        <option value="Teatime">Teatime</option>
                        <option vlaue="Party">Party</option>
                    </select>
                </div>
                <br>
                <table id="tableing" class='table-bordered'>
                    <tr>
                        <th>Ingredient name</th>
                        <th>Amount</th>
                    </tr> 
                    <tr>
                        <td><input type="text" name="ing1" id="ing1"></td>
                        <td><input type="text" name="amount1" id="amount1"></td>
                        <td><input class="btn btn-default"type="button" name="delete1" id="delete1" value="delete" onclick="deleteRow(1)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">Add an ingredient</a><br>
                <div class="form-inline">
                    <label for="method">Method</label><br>
                    <textarea rows="10" cols="50" name="method" required>
                        <?php
                            $method="Write your method here";
                            if (isset($_GET['action'])){
                                if ($_GET['action']=="modify"){
                                    $recipe=$_GET['recipe'];
                                    $user=$_GET['user'];
                                }
                            $dsn=  database::connect();
                            $str="select `method` from recipes where `id`=$recipe and `user`=$user";
                            $result=$dsn->query($str)->fetchALL();
                            if (sizeof($result)!=0){
                                $method=$result[0]['method'];
                            }
                            $dsn=null;
                            echo $method;
                    }
                    echo $method;
                            ?>
                    </textarea><br>
                </div>
                <div class="form-inline">
                    <label for="image">Upload an image</image>
                    <input class="btn-file" type="file" name="image" id="image">
                    <br>
                    <div id="subm">
                        <input class="btn btn-default" type="submit" value="Add Recipe" name="submit" > 
                    </div>
                </div>
            </form>
            </div>
        </section>
    <?php
    /*
     * Ici c'est la partie pour récupérer les informations des recette
     */
    if (isset($_POST['submit'])&&(preg_match("/^[a-zA-Z ]*$/",$_POST['name']))){
        if (isset($_SESSION['loggedin'])){
            $userid=$_SESSION['id'];
        }
        else{
            $userid=1;
        }
        $con=  database::connect();
        if(isset($_GET['action'])){
            $recipno=$_GET['recipe'];
            
        }else{
            $str="insert into recipes(`name`) values ('')";
            $con->query($str);
            $recipno=database::lastrecip($con);
        }
        if (file_exists($_FILES['image']['tmp_name'])){
            $currentdir = getcwd();
            $target_dir=$currentdir."/recipeimg/";
            $target_file=$target_dir.basename($_FILES["image"]["name"]);
            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
            $upload_OK=1;
            if($_FILES["image"]["size"]>5000000){
                echo "Image too large!";
                $upload_OK=0;
            }
            if($imageFileType!="png" ){
                echo"Only PNG files are allowed.";
                $upload_OK=0;
            }
            if($upload_OK!=0){
                $new=$recipno.".png";
                $name=$target_dir.$new;
                move_uploaded_file($_FILES['image']['tmp_name'],$name);
            }
        }
        else
            {$new="cooker.png";}
        $name=$_POST['name'];
        $method=$_POST['method'];
        if(!legal($method)){$method='';echo "Illegal method!";}
        $occasion=$_POST['occasion'];
        $str = "UPDATE `recipes` SET `name`='$name', `method`='$method',`occasion`='$occasion',`user`='$userid' WHERE `id`='$recipno'";
        $con->query($str);
        $no=1;
        $ingno="ing";
        $ingno.=(string)$no;
        $amountno="amount";
        $amountno.=(string)$no;
echo <<<END
        <script>alert("Your recipe has been added!")</script>
        <div class="recipeadd">
            <div class="name">
                {$name}
                <img class="img-circle" src="recipeimg/$new">
            </div>
            <div class="ocassion">
                {$occasion}
            </div>
            <br>
            <table class="ingredient">
                <tr><td>Ingredient name</td><td>Amount</td></tr>
END;
        while(isset($_POST[$ingno])){
            $ingname=$_POST[$ingno];
            $amount=$_POST[$amountno];
            if(preg_match("/^[a-zA-Z ]*$/",$ingname)&& preg_match("/^[a-zA-Z0-9 ]*$/",$amount)){
            $id=database::findingid($ingname,$con);
            echo "<tr><td>{$ingname}</td><td>$amount</td></tr>";
            if($id!= (-1)){
                $str="INSERT INTO recipesingredients (`recipe`, `ingredient`, `amount`) VALUES('$recipno', '$id','$amount')";
                $con->query($str);
            }
            else{
                $str="INSERT INTO ingredients (`name`) VALUES('$ingname')";
                $con->query($str);
                $id=database::lasting($con);
                $str="INSERT INTO recipesingredients (`recipe`, `ingredient`,`amount`) VALUES('$recipno', '$id','$amount')";
                $con->query($str);
            }
            $no++;
            $ingno="ing";
            $ingno.=(string)$no;
            $amountno="amount";
            $amountno.=(string)$no;}
        }
        $con=null;
        echo "</table><br>";
        echo "<div class='method'>Method:<br>{$method}</div></div>";
    }else{
        if(isset($_POST['submit'])){echo "Illegal recipe name!";};
    }
echo $footer;
?>
