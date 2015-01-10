<?php require_once("connexion.php");
?>
<?php
function printLoginForm(){
    ?>
   <form action="<?php echo $_SERVER['PHP_SELF']?>?todo=login" method="post">
    <p>login : <input type="text" name="login" placeholder="yixin" required /></p>
    <p>passward :
      <input name="password" type="password" required />
    </p>
    <p><input type="submit" value="Valider" /></p>
 
  </form>


<?php
}
  function printLogoutForm(){
      ?><a href=<?php echo $_SERVER['PHP_SELF']?>?todo=logout>Se déconnecter</a>;<?php
  }


   function logIn(){
       $uti=Utilisateur::getUtilisateur($_POST["login"]);
       if (is_object($uti)){
           if (Utilisateur::testerMdp2($uti,$_POST["password"])){
               $_SESSION['loggedIn'] = true;
           }
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
          }};
          if (isset($_SESSION['loggedIn'])) {
                      printLogoutForm();
                       } 
                       else {
                   printLoginForm();
   };};

     
                       
?>

