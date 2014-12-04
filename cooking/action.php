<?php
    require('functions.php');
    if (isset($_POST['login'])&&  isset($_POST['pw'])){
            $lg=$_POST['login'];
            $pw=$_POST['pw'];
            $dsn=  database::connect();
            database::check($lg,$pw,$dsn);
            $dsn=null;
        }
        else{
            echo"login or password not found";
        }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>