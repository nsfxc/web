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
            newTd2.innerHTML= "<input type='button' name='delete' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
        } 
        function deleteRow(rowId){
            tableing.deleteRow(rowId);
        }
    </script>
    <body>  
   <?php
    require("layout.php");
    echo $header;
                require_once("login.php");
                logInOutForm();

    echo $headerlaster;
    ?>
 
        <section class="menu-padding">
            <div class="jumbotron">
            <form action='<?php echo $_SERVER['PHP_SELF'];?>' method="POST" id="myform">
                Name:<input type="text" name="name" id="name"><br>
                Occasion:
                <select name='occasion'>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Meal">Meal</option>
                    <option value="Teatime">Teatime</option>
                    <option vlaue="Party">Party</option>
                </select>
                <br>
                <table id="tableing" class='ingredient'>
                    <tr>
                        <th>Ingredient name</th>
                        <th>Amount</th>
                    </tr> 
                    <tr>
                        <td><input type="text" name="ing0" id="ing0"></td>
                        <td><input type="text" name="amount0" id="amount0"></td>
                        <td><input type="button" name="delete" value="delete" onclick="deleteRow(0)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">Add an ingredient</a><br>
                Method:<br>
                <textarea rows="10" cols="50" name="method">
                    Please write your methods here...
                </textarea>
                <div id="subm">
                    <input type="submit" value="submit" name="submit" onclick="GetValue()"><br> 
                </div>
            </form>
            <div id="message"></div>
            </div>
        </section>
    <?php
    require ('functions.php');
    if (isset($_POST['submit'])){
        $name=$_POST['name'];
        $method=$_POST['method'];
        $occasion=$_POST['occasion'];
        $con =  database::connect();
        $str = "INSERT INTO recipes (`name`, `method`,`occassion`) VALUES('$name', '$method','$occasion')";
        $con->query($str);
        $recipno=database::lastrecip($con);
        $no=0;
        $ingno="ing";
        $ingno.=(string)$no;
        $amountno="amount";
        $amountno.=(string)$no;
echo <<<END
        <p>Your recipe has been added!</p>
        <div class="recipeadd">
            <div class="name">
                {$name}
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
    require("layout.php");
    echo $footer;
        ?>
    </body>  
    </html> 

