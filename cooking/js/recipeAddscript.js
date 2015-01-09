/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(document).ready(function(){
     var nb=0;
     var ingname=[];
        $("#ingbox").keyup(function(){
            ingname[nb]=$(this).val();
            nb=nb+1;
            var changeURL="ingrdConfirm.php?action=check&ingname="+ingname[nb-1];
            $.get(changeURL,function(str){
                if(str==='0'){
                    $("#ing").append('<input type="button" id="addin" value="Ingredient not exist, please add"/><br/>');
                    $("#addin").click(function(){
                        window.location.href='ingrdAdd.php';
                    });
                };
            });
        });
        $("#met").prepend('<input type="button" id="adding" value="Add Ingredients"/><br/>');
        $("#adding").click(function(){
            $('#ing').empty();
            $("#ing").html('Ingredients:<input type="text" name="name" id="ingbox"/><br/>');
            $("#ingbox").blur(function(){
                ingname[nb]=$(this).val();
                nb=nb+1;
                var changeURL="ingrdConfirm.php?action=check&ingname="+ingname[nb-1];
                $.get(changeURL,function(str){
                    if(str==='0'){
                        $("#ing").append('<input type="button" id="addin" value="Ingredient not exist, please add"/><br/>');
                        $("#addin").click(function(){
                           window.location.href='ingrdAdd.php';});
                    }
                    });
                });
            });
        });