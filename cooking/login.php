<?php require_once("connextion.php");
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
       echo "<a href='$_SERVER[$p]?todo=logout'>Logout</a>";
    }
    function logIn(){
        $uti=Utilisateur::getUtilisateur($_POST['email']);
        if (is_object($uti)){
            if (Utilisateur::testerMdp2($uti,$_POST["password"])){
                $_SESSION['loggedIn'] = true;
                $_SESSION['id']=$uti->id;
                $_SESSION['name']=$uti->username;
            }
            else{
                echo "password incorrect";
            }
        }else{
            echo"user not exist";
        }
    }
    function logOut(){
        unset($_SESSION['loggedIn']);
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
            $name=$_SESSION['name'];
            $id=$_SESSION['id'];
echo <<<END
            $name welcome!
            <a href='profile.php'>profile</a>
END;
            printLogoutForm();
        }
        else {
            printLoginForm();
        }
    }
?>