<?php
require("_php/session.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>La louve - mon espace</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/members_styles.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <style type="text/css">
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('fonts/glyphicons-halflings-regular.eot');
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#louvenav" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"><span class="glyphicon glyphicon-heart" style="color:grey"></span></a>
            </div>

            <div class="nav navbar-nav collapse navbar-collapse" id="louvenav">
                <li><a href="#"><span class="glyphicon glyphicon-time" style="color:grey"></span> MA PARTICIPATION</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-calendar" style="color:grey"></span> VIE DE LA LOUVE</a></li> 
                <li><a href="#"><span class="glyphicon glyphicon-duplicate" style="color:grey"></span> DOCUMENTS</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-earphone" style="color:grey"></span> SERVICE</a></li>     
            </div>
            <ul class="nav navbar-inverse navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bonjour, Véronique <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Mes informations</a></li>
                        <li><a href="#">Messages</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>

        </div> 
    </nav>

<div class="row louve-status">
    <div class="col-lg-12"> Vous êtes à jour</div>
</div>

<div class="container">

    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <h3><strong>Mon prochain créneau</strong></h3>
            <div class="louve-creneau">
                <h3>Mardi 8 Mars : 16h00 - 19h00</h3>
                <p> Une absence prévue? </p>
                <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez votre coordinateur</button>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">

            <h3><strong>Créneaux suivants</strong></h3>
            <div class="louve-creneau">
                <h4>Mardi 8 Mars : 16h00 - 19h00</h4>
                <h4>Mardi 4 Avril : 16h00 - 19h00</h4>
                <h4>Mardi 6 Mai : 16h00 - 19h00</h4>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="entete"><strong>Prochaine AG</strong></h3>
            <div class="row louve-ag">

            <h3>Jeudi 24 Mars 2016 - 19h30</h3>
            <button class="btn btn-default">Inscription / Ordre du Jour / Questions</button>
        </div>

    </div>
    </div>
	
	  <div class="row">
        <div class="col-lg-12">
            <h3 class="entete"><strong>Guides et manuels utiles</strong></h3>
            <div class="row louve-ag">

            <h3>Guide du coopérateur</h3>
            
			
			
        </div>
		<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 2</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1ss</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1fefegerzrgss</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1t</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1rtgrst</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1rgrs</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><img src="img/carre_gris.png" alt="doc" class="img-responsive"/><p>doc 1sgshh</p>
		</div>
		</div>

    </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>