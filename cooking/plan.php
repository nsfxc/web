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
            var newTd2 = newTr.insertCell();  
            newTd0.innerHTML = "<input type='text' name='ing"+rowId+"' id='ing"+rowId+"' form='myform'/>";   
            newTd2.innerHTML= "<input type='button' name='delete"+rowId+"' id='delete"+rowId+"' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
        } 
        function deleteRow(rowId){
            tableing.deleteRow(rowId);
            var l=$("#tableing tr").length+1;
            var k=parseInt(rowId)+1;
            for(var i=k;i<l;i++){
                var ing="ing"+i.toString();
                var delet="delete"+i.toString();
                var ingobj=document.getElementById(ing);
                var deleteobj=document.getElementById(delet);
                var j=i-1;
                var newid="ing"+j.toString();
                var newdelete="delete"+j.toString();
                var newclick="delete("+j.toString()+")";
                ingobj.setAttribute("id",newid);
                ingobj.setAttribute("name",newid);
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
                <table id="tableing">
                    <tr>
                        <th>Ingredient name</th>
                    </tr> 
                    <tr>
                        <td><input type="text" name="ing1" id="ing1"></td>
                        <td><input type="button" name="delete1" id="delete1" value="delete" onclick="deleteRow(1)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">Add an ingredient</a><br>
                <div id="subm">
                    <input type="submit" value="submit" name="submit"><br> 
                </div>
            </form>
	</div>
    </section>
<?php
    require("functions.php"); 
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
                $ing=$con->query("SELECT * FROM `recipesingredients` WHERE `recipe`='$id' ");
                echo"<table class='ingredient table'><thead><tr><th>Ingredient Name</th><th>Amount</th><tr><thead>";
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
    }

   
    echo $footer;
?>
	</body>
</html>