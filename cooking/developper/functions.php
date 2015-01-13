<?php
/* 
ces cont les functions lié avec la base de donnée.
 */
function legal($str){
    if ((!strpos($str,"$"))&&(!strpos($str,"&")&&(!strpos($str,"<"))&&(!strpos($str,">"))))
    {return true;}else{return false;}
}
class database{
    public static function connect() {
        $dsn = 'mysql:dbname=cooking;host=localhost';
        $user = 'czx';
        $password = '';
        $dbh = NULL;
        try {
            $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

    public static function close($dsn){
      $dsn=null;
}

    public static function finduserid($email,$dsn){
        $sth=$dsn->prepare("SELECT `id` FROM `users` WHERE `email`=?");
        $sth->execute(array($email));
        $res=$sth->fetchALL();
        if (sizeof($res)!=0){
            return $res[0]['id'];
        }
        else{
            return -1;
        }
    }
    
    public static function finding($ing,$dsn){
        $sth=$dsn->query("SELECT `name` FROM `ingredients` WHERE `name`=?");
        $sth->execute(array($ing));
        $res=$sth->fetchALL();
        if (sizeof($res)!=0){
            return true;
        }
        else{
            return false;
        }
    }
    public static function findingid($name,$dsn){
        $sth=$dsn->prepare("SELECT `id` FROM `ingredients` WHERE `name`=?");
        $sth->execute(array($name));
        $res=$sth->fetchALL();
        if (sizeof($res)!=0){
            return $res[0]['id'];
        }
        else{
            return -1;
        }
    }
    
    public static function lasting($dsn){
        $result=$dsn->query("SELECT * FROM `ingredients`");
        $ing=$result->fetchALL();
        return $ing[sizeof($ing)-1]['id'];
    }
    
    public static function lastrecip($dsn){
        $result=$dsn->query("SELECT * FROM `recipes`");
        $recip=$result->fetchALL();
        return $recip[sizeof($recip)-1]['id'];
    }
    public static function lastuser($dsn){
        $result=$dsn->query("SELECT * FROM `users`");
        $user=$result->fetchALL();
        return $user[sizeof($user)-1]['id'];
    }
    public static function norecipe($dsn){
        $result=$dsn->query("SELECT * FROM `recipes`");
        $recip=$result->fetchALL();
        return sizeof($recip);
    }
    public static function nouser($dsn){
        $result=$dsn->query("SELECT * FROM `users`");
        $user=$result->fetchALL();
        return sizeof($user);
    }
    public static function finduser($user,$dsn){
        $sth=$dsn->query("SELECT `username` FROM `users` WHERE `username`=? ");
        $sth->bind_param('s',$user);
        $sth->execute();
        if ($sth->fetch()){
            return true;
        }
        else{
            return false;
        }
    }
    
}
    

    

?>