<?php
require ('functions.php');
if ($_GET['action']=="ajouteing"){
    $name=$_GET['ing'];
     $con =  database::connect();
     if (finding($name,$con)){
         echo findingid($name,$con);
     }
     else{
        $str = "INSERT INTO ingredients (`name`) VALUES('$_GET[ing]')";
        echo findingid($name,$con);
        $con->query($str);
     }
     $con=null;
}

if ($_GET['action']=="ajounterecip"){
    $ingid=$_GET['ingid'];
    $recip=$_GET['recip'];
    $con=  database::connect();
    $recipeid=findrecip($recip,$con);
    $str="INSERT INTO recipesingredients(`recipe`,`ingredient`) VALUES('$recipid','$ingid')";
    $con=null;
    echo true;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

