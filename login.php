<?php 
session_start();
require("_php/connection.php");
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
    
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Membres - La Louve</title>
        <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/members_styles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	

    
    </head>
    
    <body style="background-color: #FFF0EB;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
                <a class="navbar-brand" href="#">La Louve</a> 
            </div>
    </nav>

    <header class="jumbotron" style="background-color: #ff4200">

        <!-- Main component for a primary marketing message or call to action -->

        <div class="container">
            <div class="row row-header">
                <div class="col-xs-12 col-sm-8" >
                    <h2>Bienvenue dans l'Espace Membre de La Louve</h2>
                    <p style="padding:10px;"></p>
                    <p>Nous n'&eacute;tions pas satisfaits de l'offre alimentaire qui nous &eacute;tait propos&eacute;e, 
					alors nous avons d&eacute;cid&eacute; de cr&eacute;er notre propre supermarch&eacute;.</p>
                </div>
                <div class="col-xs-12 col-sm-4" >
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">

      <form class="form-signin" method="post" action="login.php">
        <h3 class="form-signin-heading">Identifiant Louve</h3>
        <label for="inputID" class="sr-only">Identifiant Membre</label>
		<p><?php
		if ($_SESSION['falseid'] == TRUE)
		{
		 echo 'ERREUR : Identifiants incorrects';
		}
		?></p>
        <input type="text" id="inputID" name="login" class="form-control" placeholder="Entrez votre identifiant Louve" required autofocus>
        <p></p>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
        <p style="padding:10px;"><a href="forgetpwd.php">Mot de passe oubli&eacute;?</a></p>
        <button class="btn btn-danger btn-block " type="submit">Se connecter</button>
        <p style="padding:10px;"></p>
        <p>Retrouvez la Louve sur <a href="lalouve.net">www.lalouve.net</a></p>
      </form>

    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body></html>