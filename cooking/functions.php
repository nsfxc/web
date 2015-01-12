<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
        $result=$dsn->query("SELECT `id` FROM `users` WHERE `email`='$email' ");
        if ($row = $result->fetchALL()){
            return $row[0]['id'];
        }
        else{
            return -1;
        }
    }
    
    public static function finding($ing,$dsn){
        $result=$dsn->query("SELECT `name` FROM `ingredients` WHERE `name`='$ing' ");
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            return true;
        }
        else{
            return false;
        }
    }
        public static function findingid($name,$dsn){
        $result=$dsn->query("SELECT `id` FROM `ingredients` WHERE `name`='$name' ");
        if ($row = $result->fetch(PDO::FETCH_ASSOC)){
            return $row['id'];
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
        $result=$dsn->query("SELECT `username` FROM `users` WHERE `username`='$user' ");
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function findrecip($recip,$dsn){
        $result=$dsn->query("SELECT `name` FROM `recip` WHERE `name`='$recip' ");
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            return $row['id'];
        }
        else{
            return false;
        }
    }
    
    public static function check($lg,$pw,$dsn){
        $result=$dsn->query("SELECT `id` FROM `users` WHERE `username`='$lg' AND `password`=SHA1('$pw') ");
        if ($result->fetch(PDO::FETCH_ASSOC)){
            return true;
         }
        else{
            return false;
        }
        
    }
}
    

    

?>