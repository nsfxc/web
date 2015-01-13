<?php
 
    require_once("functions.php");
    class Utilisateur {
        public $id;
        public $username;
        public $password;
        public $email;
        public $is_admin;
        public static function getUtilisateur($login) {
            $dbh = Database::connect();
            $query = "SELECT * FROM `users` WHERE `email`=?";
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
            $sth = $dbh->prepare("INSERT INTO `users` (`username`, `password`,`email`) VALUES(?,SHA1(?),?)");
            $request_succeeded = $sth->execute(array($login,$mdp,$email));
            if (!$request_succeded){
                echo "User existed already!";
            };
           $dbh = null;
        }
        public static function testerMdp2($objet,$mdp){
            return $objet->password==SHA1($mdp);
        }
    }
?>
