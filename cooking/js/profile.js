function changeemail(){
    alert("Change succeed!");
            var change="change.php?email="+$("#nemail").val();
            jQuery.getJSON(change,function(str){
                alert(str);
            });
    $("#nemail").val("");
    }
$(document).ready(function(){
    $("#email").click(function(){
        $("#pemail").append('<br><input type="text" name="email" id="nemail"><div id="message1"></div><input type="submit" name="submit" value="submit" id="semail" onclick="changeemail()">');
        $("#nemail").blur(function(){
            var name=$(this).val();
            var changeURL="developper/Confirm.php?action=check&conf=regis&ingname="+name;
            if(name.indexOf('@')===-1 || name.indexOf('@')>=name.indexOf('.')){
                $("#message1").html('<p>Illegal e-mail address!</p>');
                $("#nemail").val("");
            }else{
                $.get(changeURL,function(str){
                    if(str!=='-1'){
                        $("#message1").html('<p>E-mail existed, please choose another e-mail or login!</p>');
                        $("#nemail").val("");
                    }
                    else{
                        $("#message1").html('');
                    }
                });
            }
        });
    });
    $("#username").click(function(){
        $("#pusername").append('<br><input type="text" name="username" id="nusername"><input type="submit" name="submit" value="submit" id="susername">');
        $("#susername").click(function(){
            var change="change.php?username="+$("#nusername").val();
            alert("Change succed!");
            $("#nusername").val("");
            $.get(change,function(str){
                if (str===1){
                }
            });
        });
    });
    $("#password").click(function(){
       var change="change.php?password=change";
       window.location.href=change;
    });
});