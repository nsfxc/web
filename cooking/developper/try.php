
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
    <body>
        <?php
            require("layout.php");
            echo $header;
            echo $footer;
        ?>
    </body>
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
    </html> 
    <script>
                            if(str==="-1"){
                            var newr=tableing.insertRow();
                            var newc1=newr.insertCell();
                            var newc2=newr.insertCell();
                            var newc3=newr.insertCell();
                            var newc4=newr.insertCell();
                            newc1.innerTEXT="Please ajoute ingredient";
                            newc2.innerTEXT=ing;
                            newc3.innerHTML="<select name='catalog' id='ing\""+ingno+"\"'><option value='vegetable' selected>vegetable</option><option value='meat'>meat</option><option value='fruit'>fruit</option><option value='dairy'>dairy</option><option value='condiment'>condiment</option></select>";
                            newc4.innerHTML="<input type='button' id='addin'>";
                            $("#addin").click(function(){
                                var liste=document.getElementById("ing\""+ingno+"\"");
                                var text=liste.options[liste.selectedIndex].text;
                                var link='ingrdAdd.php?ing='+ing+"&type="+text;
                                $.get(link,function(str){alert("ingredient added"); });
                                var linkrec="recipesingredients.php?ing=last";
                                alert("Ingredient added!");
                            });
                        }
                        else{
                            var linkrec="recipesingredients.php?ing="+str;
                        }
                        $.get(linkrec,function(str1){});
function GetValue(){
                $("#message").append('<p>Recipe added!</p><br>');
                var name=$("#name").val();
                $("#message").append('<h3>'+name+'</h3><br>');
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
            if (S[0]!==""){
                $("#message").append('<h3>Ingredients</h3><br><table>');
                var ingno=0;
                for (var i=0;i<S.length-1;i++){
                    var value=S[i].split(',');
                    var ing=value[0];
                    var amount=value[1];
                    $("#message").append('<tr><td>'+ing+'</td><td>'+amount+'</td></tr>');
                    };
                    $("#message").append('</table><br><h3>Method:</h3><br>');
                    var method=$("#method").val();
                    $("#message").append(method);
                };
           };
           
           </script>