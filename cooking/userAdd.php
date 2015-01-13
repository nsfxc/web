<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require ('developper/functions.php');
if(isset($_POST['submit'])){
    if (isset($_POST['username'])&&  isset($_POST['password']) && isset($_POST['email'])){
        $con =  database::connect();
        $str = "INSERT INTO users (`username`, `password`,`email`) VALUES('$_POST[username]', SHA1('$_POST[password]'), '$_POST[email]')";
        $con->query($str);
        $con=null;
        
    }
    else{
    }
}
?>
<?php
    require("developper/layout.php");
    echo $head;
    echo"<title>New user</title>";
    echo"<script src='js/registion.js'></script>";
    head();
?>
    <section class="menu-padding">
        <div class="container jumbotron">
        <form class="form-horizontal" action="index.php" method="post">
            <div class="form-group" id="regis">
                <label class="col-sm-2 clontrol-label">E-mail</label>
                <div class="col-sm-3">
                    <input type="text" name="email" id="email" required>
                </div>
                <div id="message1"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 clontrol-label">Password</label>
                <div class="col-sm-3">
                    <input type="password" name="password" id="password1">
                </div>
                <div id="message2"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 clontrol-label">Repeat your password</label>
                <div class="col-sm-3">
                    <input type="password" name="password2" id="password2">
                </div>
                <div id="message3"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 clontrol-label">Username</label>
                <div class="col-sm-3">
                    <input type="text" name="username" id="username">
                </div>
                <div id="message4"></div>
            </div>
            <input class="btn btn-default" type="submit" name="submit" value="submit" id="submit">
        </form>
        </div>
    </section>
<?php
echo $footer;
?>
