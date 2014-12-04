<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('functions.php');
if (isset($_POST['login'])&&  isset($_POST['pw']) && isset($_POST['em'])){
    $con =  database::connect();
    $str = "INSERT INTO info (`lg`, `pw`,`email`) VALUES('$_POST[login]', SHA1('$_POST[pw]'), '$_POST[em]')";
    $con->query($str);
    $con=null;
}else{
    
}
?>
