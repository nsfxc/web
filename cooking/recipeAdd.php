
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
            newTd2.innerHTML= "<input type='button' name='delete"+rowId+"' id='delete"+rowId+"' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
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
                var newclick="delete("+j.toString()+")";
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
        require("connect.php");
        echo $header;
        user();
        echo $headerlast;
        ?>
        <section class="menu-padding">
            <div class="jumbotron vertical-center">
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
                <table id="tableing" class='table ingredient'>
                    <tr>
                        <th>Ingredient name</th>
                        <th>Amount</th>
                    </tr> 
                    <tr>
                        <td><input type="text" name="ing1" id="ing1"></td>
                        <td><input type="text" name="amount1" id="amount1"></td>
                        <td><input type="button" name="delete1" id="delete1" value="delete" onclick="deleteRow(1)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">Add an ingredient</a><br>
                Method:<br>
                <textarea rows="10" cols="50" name="method">
                    Please write your methods here...
                </textarea>
                <div id="subm">
                    <input type="submit" value="submit" name="submit" > 
                </div>
            </form>
            </div>
        </section>
    <?php
    require ('functions.php');
    if (isset($_POST['submit'])){
        $name=$_POST['name'];
        $method=$_POST['method'];
        $occasion=$_POST['occasion'];
        $con =  database::connect();
        $str = "INSERT INTO recipes (`name`, `method`,`occasion`) VALUES('$name', '$method','$occasion')";
        $con->query($str);
        $recipno=database::lastrecip($con);
        $no=1;
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
    require("layout.php");
    echo $footer;
        ?>
    </body>  
    </html> 