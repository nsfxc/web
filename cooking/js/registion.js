/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#email").blur(function(){
        var name=$(this).val();
        var changeURL="Confirm.php?action=check&conf=regis&ingname="+name;
            $.get(changeURL,function(str){
                if(str!=='-1'){
                    $("#message").html('<p>username existed, please choose another name</p>');
                    $("#email").val("");
                }
                else{
                    $("#message").html('');
                }
            });
    });
    $("#submit").click(function(){
        alert("Registion Succeed!");
    });
});

