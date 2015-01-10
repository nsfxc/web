$(document).ready(function(){
    $("#email").click(function(){
        $("#pemail").append('<br><input type="text" name="email" id="nemail"><input type="submit" name="submit" value="submit" id="semail">');
        $("#semail").click(function(){
            var change="change.php?email="+$("#nemail").val();
            $.get(change,function(str){
                if (str==="1"){
                    alert("Change succeed!")
                }
            });
        });
    });
    $("#username").click(function(){
        $("#pusername").append('<br><input type="text" name="username" id="nusername"><input type="submit" name="submit" value="submit" id="susername">');
        $("#semail").click(function(){
            var change="change.php?username="+$("#nusername").val();
            $.get(change,function(str){
                if (str==="1"){
                    alert("Change succeed!")
                }
            });
        });
    });
    $("#password").click(function(){
       var change="change.php?password=change";
       window.location.href=change;
    });
});