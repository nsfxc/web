<?php
   
    require_once("connextion.php");
    function start(){
        session_name("shen");
// ne pas mettre d'espace dans le nom de session !
        session_start();
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id();
            $_SESSION['initiated'] = true;
        }
    }
    function printLoginForm(){
        $p='PHP_SELF';
echo <<<END
        <form id="form1" action="$_SERVER[$p]?todo=login" method="post">
        </form>
        <form  action="userAdd.php" method="POST" id="form2">    
        </form>
        <div class="form-group">
            <input class="register" type="text" name="email" placeholder="E-mail" form="form1" required />
            <input class="register" name="password" type="password" placeholder="Password" form="form1" required />
            <input class="btn btn-default btn-sm" type="submit" form="form1" value="Sign In">
            <input class="btn btn-default btn-sm" type="submit" form="form2" value="Register">
        </div>
END;
    }
    function printLogoutForm(){
       $p='PHP_SELF';
       echo "<li><a href='$_SERVER[$p]?todo=logout'> Logout</a></ul></nav></div>";
    }
    function logIn(){
        if  (legal($_POST['email'])&&(legal($_POST['password']))){
        $uti=Utilisateur::getUtilisateur(htmlspecialchars($_POST['email']));
        if (is_object($uti)){
            if (Utilisateur::testerMdp2($uti,  htmlspecialchars($_POST["password"]))){
                $_SESSION['loggedIn'] = true;
                $_SESSION['id']=$uti->id;
                $_SESSION['username']=$uti->username;
                $_SESSION['email']=$uti->email;
                $_SESSION['password']=$uti->password;
                if ($uti->is_admin==1){
                    $_SESSION['admin']=true;
                }
            }
            else{
                echo "password incorrect";
            }
        }else{
            echo"user not exist";
        }}
        else{echo"Username or password illegal!";}
    }
    function logOut(){
        unset($_SESSION['loggedIn']);
        if (isset($_SESSION['admin'])){unset($_SESSION['admin']);};
    }
    function logInOutForm(){
        if (isset($_GET['todo'])) {
            switch ($_GET['todo']) {
            case 'login' :
                logIn();
                break;
            case 'logout' :
                logOut();
                break;
            }
        }
        if (isset($_SESSION['loggedIn'])) {
            if(isset($_SESSION['admin'])){
echo <<<END
                 <nav class="navbar-default">
                    <ul class="nav navbar-nav"><li><a href='profile.php'>Admin</a></li>
END;
                printLogoutForm();
            }else{
echo <<<END
                 <nav class="navbar-default">
                    <ul class="nav navbar-nav"><li><a href='profile.php'>My Profile</a></li>
END;
            printLogoutForm();
        }
        }
        else {
            printLoginForm();
        }
    }
?>