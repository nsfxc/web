<?php
session_name("shen");
// ne pas mettre d'espace dans le nom de session !
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
?>
<?php
    require ('functions.php');
    if (isset($_POST['submit'])){
        $name=$_POST['name'];
        $method=$_POST['method'];
        $con =  database::connect();
        $str = "INSERT INTO recipes (`name`, `method`) VALUES('$name', '$method')";
        $con->query($str);
        $con=null;
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
            var rowLength=$("#tableing tr").length+1;
            var rowId="row"+rowLength; 
            var newTr = tableing.insertRow();   
            var newTd0 = newTr.insertCell();  
            var newTd1 = newTr.insertCell();  
            var newTd2 = newTr.insertCell();  
            newTd0.innerHTML = "<input type='text' id='ing(\""+rowId+"\")'/>";   
            newTd1.innerHTML = "<input type='text' id='amount(\""+rowId+"\")'/>";  
            newTd2.innerHTML= "<input type='button' name='delete' value='delete' onclick='deleteRow(\""+rowId+"\")'/>";
        } 
        function deleteRow(rowId){
            tableing.deleteRow(rowId);
        }
        function GetValue(){
                var value="";
                $("#tableing tr").each(function(i){
                if (i>=0){
                    $(this).children().each(function(j){
                            value+=$(this).children().eq(0).val()+',';
                    });
                    value=value.substr(0,value.length-1)+"#";
                };
                });
            value=value.substr(0,value.length);
            ReceiveValue(value);
        }
        function ReceiveValue(str){
            var S=str.split('#');
            if (Str[0]!==""){
                for (var i=0;i<S.length-1;i++){
                    var value=S[i].split(',');
                    var ing=value[0];
                    var changeURL="Confirm.php?action=check&conf=ingr&ingname="+ing;
                    $.get(changeURL,function(str){
                        if(str==="0"){
                            var newr=tableing.insertRow();
                            var newc1=newr.insertCell();
                            var newc2=newr.insertCell();
                            newc1.innerTEXT="Please ajoute ingredient"+ing;
                            newc2.innerHTML='<input type="button" id="addin" value="Add"/>';
                            $("#addin").click(function(){
                                window.location.href='ingrdAdd.php';
                            });
                        }
                    });
                };
           };
        }
    </script>
    <body>  
        <?php
        require("layout.php");
        echo $header;
        ?>
        <?php
                require_once("login.php");
                logInOutForm();
                ?>
        <section class="menu-padding">
            <div class="jumbotron">
            <form action='recipe.php' method="POST">
                name:<input type="text" name="name" id="name"><br>
                <table>
                    <tr>
                        <td>ingredients</td>
                        <td>amount</td>
                    </tr>   
                </table>
                <table id="tableing">
                    <tr>
                        <td><input type="text" id="ing1"></td>
                        <td><input type="text" id="amount1"></td>
                        <td><input type="button" name="delete" value="delete" onclick="deleteRow(0)"></td>
                    </tr>
                </table>
                <a href="javascript:addIng()">add</a> 
                <div id="met">
                    Cooking methods:<input type="text" name="method"><br>
                </div>
                <div id="subm">
                    <input type="submit" value="submit" name="submit"><br> 
                </div>
            </form>
            </div>
        </section>
    <?php
    require("layout.php");
    echo $footer;
        ?>
    </body>  
    </html> 

