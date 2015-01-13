<?php

require ('developper/functions.php');
if ($_GET['ing']='last'){
    $dsn = database::connect();
    $noing = lasting($dsn);
    $noreci=lastrecip($dsn);
    $str = "INSERT INTO recipesingredients (`recipe`, `ingredient`) VALUES('$noreci', '$noing')";
    $dsn->query($str);
    $dsn=null;
}
else{
    $dsn=database::connect();
    $noing=$_GET['ing'];
    $noreci=lastrecip($dsn);
    $str = "INSERT INTO recipesingredients (`recipe`, `ingredient`) VALUES('$noreci', '$noing')";
    $dsn->query($str);
    $dsn=null;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "succeed!";
?>
