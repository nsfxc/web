<?php
require ('functions.php');
if ($_GET['action']=="check"){
    if($_GET['conf']=="ingr"){
        $name=$_GET['ingname'];
        $dsn=  database::connect();
        if (database::finding($name, $dsn)){
            echo '1';
            
        }
        else{
            echo '0';
            
        }
    $dsn=null;}
    if($_GET['conf']=="regis"){
        $name=$_GET['ingname'];
        $dsn=  database::connect();
        if (database::finduser($name, $dsn)){
            echo '1';
            
        }
        else{
            echo '0';
            
        }
        $dsn=null;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
