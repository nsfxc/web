<?php
require_once("functions.php");
 class Utilisateur {

    public $lg;
    public $pw;
    public $email;
    public static function getUtilisateur($login) {
        $dbh = Database::connect();
        $query = "SELECT * FROM `users` WHERE `lg`=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $request_succeeded = $sth->execute(array($login));
        if (!$request_succeeded) {
            return NULL;
        } else {
            $user = $sth->fetch();
            return $user;
        }
        
        $dbh = null;
        
    }
    public static function insererUtilisateur($login, $mdp, $email) {
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `users` (`lg`, `pw`,`email`) VALUES(?,SHA1(?),?)");
        $request_succeeded = $sth->execute(array($login,$mdp,$email));
        if (!$request_succeded){
        echo "Utilisateur déjà existé";
        };
        $dbh = null;
    }
    public static function testerMdp($login,$mdp){
        $dbh = Database::connect();
        $query = "SELECT * FROM `users` WHERE `lg`= ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $request_succeeded = $sth->execute(array($login));
        if (!$request_succeeded) {
            return false;
        } else {
            $user=$sth->fetch();
            return ($user->pw==SHA1($mdp));
        }
        $dbh = null;
    }
    
    public static function testerMdp2($objet,$mdp){
        return $objet->pw==SHA1($mdp);
    }
} 
?>