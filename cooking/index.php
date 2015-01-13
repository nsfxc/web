<!DOCTYPE html>
<?php
    session_name("shen");
// ne pas mettre d'espace dans le nom de session !
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/perso.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/registion.js"></script>
        <title>welcome page</title>
    </head>
    <body>
        <div class="headerhome">
            <div class="background">&nbsp;</div>
            <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            </ul>
            </div>
        </div>
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js.js"></script>
            <section class="section-padding">
             <div class="navbar-right">
<?php
            require_once("developper/login.php");
            logInOutForm();
?>
            </div>
                <div class="container">
                <div class="jumbotron text-center">
       
                    <h2><span class="grey">Welcome to our</span> KITCHEN</h2>
                    <p>Wanna cook yourself? Let's start from now!</p>
                    <div class="row">
                        <div class="showcase-box col-md-4">
                            <div class="showcase-itm">
                                <a href='recipeSearch.php'><img src="css/img/icon1.png"></a>
                                <p>
                                    A recipe designed for you!
                                </p>
                            </div>
                        </div>
                        <div class="showcase-box col-md-4">
                            <div class="showcase-itm">
                                <a href='recipeView.php'><img src="css/img/icon2.png"></a>
                                <p>
                                    View all our recipes!
                                </p>
                            </div>
                        </div>
                        <div class="showcase-box col-md-4">
                            <div>
                                <a href='recipeAdd.php'><img src="css/img/icon3.png"></a>
                                <p>
                                    Share your excellent meals with others!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
    </body>
</html>
