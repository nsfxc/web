<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class database{
    public static function connect() {
        $dsn = 'mysql:dbname=info;host=127.0.0.1';
        $user = 'root';
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

    public static function find($lg,$dsn){
        $result=$dsn->query("SELECT `id` FROM `users` WHERE `lg`='$lg' ");
        if ($row = $result->fetch(PDO::FETCH_ASSOC)){
            return $row[id];
        }
        else{
            return error_log("notfound");
        }
    }
    
    public static function finding($ing,$dsn){
        $result=$dsn->query("SELECT `name` FROM `warehouse` WHERE `name`='$ing' ");
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function check($lg,$pw,$dsn){
        $result=$dsn->query("SELECT `id` FROM `users` WHERE `lg`='$lg' AND `pw`=SHA1('$pw') ");
        if ($result->fetch(PDO::FETCH_ASSOC)){
            return true;
         }
        else{
            return false;
        }
        
    }
}
    

    

?>