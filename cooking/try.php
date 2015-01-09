
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
 
    </html> 
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