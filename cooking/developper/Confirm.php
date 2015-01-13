<?php

require ('developper/functions.php');
if ($_GET['action']=="check"){
    if($_GET['conf']=="ingr"){
        $name=$_GET['ingname'];
        $dsn=  database::connect();
        $result=database::findingid($dsn,$name);
        echo $result;
        $dsn=null;
        
    }
    if($_GET['conf']=="regis"){
        $name=$_GET['ingname'];
        $dsn=  database::connect();
        echo database::finduserid($name,$dsn);
        $dsn=null;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
