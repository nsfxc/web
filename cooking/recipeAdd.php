<!DOCTYPE html>
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
    <script type="text/javascript">
        function addIng(){
            var rowLength=$("#tableing tr").length;
            var rowId=rowLength; 
            var newTr = tableing.insertRow();   
            var newTd0 = newTr.insertCell();  
            var newTd1 = newTr.insertCell();  
            var newTd2 = newTr.insertCell();  
            newTd0.innerHTML = "<input type='text' name='ing"+rowId+"' id='ing"+rowId+"' form='myform'/>";   
            newTd1.innerHTML = "<input type='text' name='amount"+rowId+"' id='amount"+rowId+"' form='myform'/>";  
            newTd2.innerHTML= "<input class='btn btn-default' type='button' name='delete"+rowId+"' id='delete"+rowId+"' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
        } 
        function deleteRow(rowId){
            tableing.deleteRow(rowId);
            var l=$("#tableing tr").length+1;
            var k=parseInt(rowId)+1;
            for(var i=k;i<l;i++){
                var ing="ing"+i.toString();
                var amount="amount"+i.toString();
                var delet="delete"+i.toString();
                var ingobj=document.getElementById(ing);
                var amountobj=document.getElementById(amount);
                var deleteobj=document.getElementById(delet);
                var j=i-1;
                var newid="ing"+j.toString();
                var newamount="amount"+j.toString();
                var newdelete="delete"+j.toString();
                var newclick="deleteRow("+j.toString()+")";
                ingobj.setAttribute("id",newid);
                ingobj.setAttribute("name",newid);
                amountobj.setAttribute("id",newamount);
                amountobj.setAttribute("name",newamount);
                deleteobj.setAttribute("id",newdelete);
                deleteobj.setAttribute("name",newdelete);
                deleteobj.setAttribute("onclick",newclick);
            }
        }
    </script>
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
                <form class="form-horizontal" action='<?php echo $_SERVER['PHP_SELF'];?>' method="POST" id="myform" enctype="multipart/form-data">
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
                    <textarea rows="10" cols="50" name="method">
                        Please write your methods here...
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
    require ('functions.php');
    if (isset($_POST['submit'])){
        if ($_SESSION['loggedin']){
            $userid=$_SESSION['id'];
        }
        else{
            $userid="";
        }
        $recipno=database::lastrecip($con);
        $target_dir="recipeimg/";
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
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file,$new);
        }else{$new="cooker.png";}
        $name=$_POST['name'];
        $method=$_POST['method'];
        $occasion=$_POST['occasion'];
        $con =  database::connect();
        $str = "INSERT INTO recipes (`name`, `method`,`occasion`,`user`) VALUES('$name', '$method','$occasion','$userid')";
        $con->query($str);
        $no=1;
        $ingno="ing";
        $ingno.=(string)$no;
        $amountno="amount";
        $amountno.=(string)$no;
        if ($image==""){$image="default.png";}
echo <<<END
        <p>Your recipe has been added!</p>
        <div class="recipeadd">
            <div class="name">
                {$name}
                <img class="img-rounded" src="recipeimg/$new">
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
            $amountno.=(string)$no;
        }
        $con=null;
        echo "</table><br>";
        echo "<div class='method'>Method:<br>{$method}</div></div>";
    }

?>
    <?php
    echo $footer;
        ?>
    </body>  
    </html> 