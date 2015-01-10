<?php require_once("connextion.php");
    function printLoginForm(){
        $p='PHP_SELF';
echo <<<END
        <form action="$_SERVER[$p]?todo=login" method="post">
            <p>Email : <input type="text" name="email" placeholder="yixin" required /></p>
            <p>passward :
            <input name="password" type="password" required />
            </p>
            <p><input type="submit" value="Submit" /></p>
        </form>
        <form action="userAdd.php" method="POST">
            <p><input type="submit" value="Registion"></p>
        </form>
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