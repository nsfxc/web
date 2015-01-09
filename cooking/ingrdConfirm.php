<?php
require ('functions.php');
if ($_GET['action']=="check"){
    $ingname=$_GET['ingname'];
    $dsn=  database::connect();
    if (database::finding($ingname, $dsn)){
        echo '1';
    }
    else{
        echo '0';
    }
    $dsn=null;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
