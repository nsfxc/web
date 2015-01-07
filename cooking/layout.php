<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$header='<header>
            <nav class="nabvar navbar-default" role="navigation">
		<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
			<li><a href="index.php">Home</a></li>
			<li><a href="plan.php">Make Plans</a></li>
			<li><a href="recipe.php">Find Recipes</a></li>
			<li><a href="recipeAdd.php">Share Recipes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
			<?php
                            if (isset($_SESSION["user"])){
				echo $_SESSION["user""];
                            }else{
				echo login;
				echo register;
                            }
			?>
                    </ul>
		</div>
            </nav>
	</header>
        <div class="header">
            <div class="background">&nbsp;</div>
	</div>';
$footer='<div class="bottom-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-2 navbar-brand">
						<a href="index.php">Little Cooker</a>
					</div>
					<div class="col-md-10">
						<ul class="bottom-links">
							<li><a href="about.php">About us</a></li>
							<li><a href="contact.php">Contact us</a></li>
						</ul>
					</div>
				</div>
			</div>
	</div>'
?>
