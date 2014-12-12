/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(document).ready(function(){
     var nb=0;
     var name=[];
     for(var i=0;i<nb;i++){
         var s="#"+name[i];
         $(s).click(function(){
            $(s).empty();
            for (var j=i;i<nb;j++){
                name[j]=name[j+1];
            }
            nb=nb-1;
         });
     }
        $("#ingbox").focus(function(){
           $("#addin").empty(); 
        });
        $("#ingbox").blur(function(){
            name[nb]=$(this).val();
            nb=nb+1;
            var changeURL="Confirm.php?action=check&conf=ingr&ingname="+name[nb-1];
            $.get(changeURL,function(str){
                if(str==='0'){
                    $("#addin").append('<input type="button" id="addin" value="Add"/><br/>');
                    $("#message").html('Ingredient not exist, please add!');
                    $("#ingbox").val("");
                    $("#addin").click(function(){
                        window.location.href='ingrdAdd.php';
                        $("#message").html('');
                    });
                }
                else{
                    var st='<input type="button" id='+name[nb-1]+'value="X">'+name[nb-1];
                    $("#ing").append(st);
                };
            });
        });
        $("#met").prepend('<input type="button" id="adding" value="Add Ingredients"/><br/>');
        $("#adding").click(function(){
            $("#ingbox").val("");
            $("#message").html('');
            });
        });