<!DOCTYPE html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require ("developper/login.php");
$head='<html>
	<head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>';

function head(){
    start();
    echo "</head>
            <body>
            <header>
            <nav class='nabvar navbar-default navbar-fixed-top'>
		<div class='collapse navbar-collapse'>
                    <ul class='nav navbar-nav navbar-left'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='recipeSearch.php'>Search Recipes</a></li>
			<li><a href='recipeView.php'>View Recipes</a></li>
			<li><a href='recipeAdd.php'>Share Recipes</a></li>
                    </ul>
                    <ul class='nav navbar-nav navbar-right'>";
    logInOutForm();
    echo "       </ul>
		</div>
            </nav>
	</header>
        <div class='header'>
            <div class='background'>&nbsp;</div>
</div>";
}
$footer='<div class="bottom-menu">
            <nav class="navbar navbar-default navbar-fixed-bottom">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Little Cooker</a>
                    </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="about.php">About us</a></li>
                        <li><a href="contact.php">Contact us</a></li>
                    </ul>
                </div>    
            </nav>
	</div>
        </body>
        </html>';
?>
