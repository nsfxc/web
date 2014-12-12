<?php
    require('functions.php');
    if ($_GET['action']=="login"){
        if (!empty($_POST['user'])&&  !empty($_POST['pass'])){
            $lg=$_POST['user'];
            $pw=$_POST['pass'];
            $dsn=  database::connect();
            if (database::check($lg,$pw,$dsn)){
                $arr['success']=1;
                $arr['user']=$lg;
            }
            else{
                $arr['success']=0;
            }
            $dsn=null;
        }
        else{
            $arr['success']=-1;
        }
        echo json_encode($arr);
    }
    ?>