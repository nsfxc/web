/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#email").blur(function(){
        var name=$(this).val();
        var changeURL="developper/Confirm.php?action=check&conf=regis&ingname="+name;
        if(name.indexOf('@')===-1 || name.indexOf('@')>=name.indexOf('.')){
                $("#message1").html('<p>Illegal e-mail address!</p>');
                $("#email").val("");
        }else{
            $.get(changeURL,function(str){
                if(str!=='-1'){
                    $("#message1").html('<p>E-mail existed, please choose another e-mail or login!</p>');
                    $("#email").val("");
                }
                else{
                    $("#message1").html('');
                }
            });}
    });
    $('#password1').blur(function(){
        var password=$(this).val();
        if(!password.match(/^[\w ]+$/)){
            $("#message2").html('<p>Password should only have letters or numbers!</p>');
            $("#password1").val("");
        }else{
        if (password.length<6){
            $("#message2").html('<p>Password should have at least 6 characters!</p>')
            $("#password1").val("");
        }
        else{
            $("#message2").html('');
        }}
    });
    $('#password2').blur(function(){
        var password2=$(this).val();
        var password1=$('#password1').val();
        if(!password2.match(/^[\w ]+$/)){
            $("#message3").html('<p>Password should only have letters or numbers!</p>');
            $("#password2").val("");
        }else{
        if (password2!==password1){
            $("#message3").html('<p>Passwords different!</p>');
            $("#password2").val("");
        }
        else{
            $("#message3").html('');
        }}
    });
    $('#username').blur(function(){
       var username=$(this).val();
       if (!username.match(/^[\w ]+$/)){
           $("#message4").html('<p>Username should only have letters or numbers!</p>');
           $("#username").val("");
       }
    });
    $("#submit").click(function(){
        var email=$("#email").val();
        var password1=$("#password1").val();
        var password2=$("#password2").val();
        var username=$("#username").val();
        if(email.indexOf('@')>-1 && email.length>6 && password1.length>6 && password1===password2 && username.length>0){
            alert("Registion Succeed!");
        }
        else{
            if (email.indexOf('@')===-1 || email.length<=6){
                $("#message1").html('<p>Email illegal!</p>');
            }
            if(password1.length===0){
                $("#message2").html('<p>Please choose a password!</p>');
            }
            if(username.length===0){
                $("#message4").html('<p>Please choose an username!</p>')
            }
        }
    });
});

