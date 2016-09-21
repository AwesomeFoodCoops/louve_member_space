<?php
require("_php/session.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>La louve - mon espace</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootgrid.css">
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

<?php
require("menu.php");
?>



<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <h3><strong>Mon prochain créneau</strong></h3>
            <div class="louve-creneau">
                <h3>Mardi 8 Mars : 16h00 - 19h00</h3>
                <p> Une absence prévue? </p>
                <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez votre coordinateur</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">

            <h3><strong>Créneaux suivants</strong></h3>
            <div class="louve-creneau">
                <h4>Mardi 8 Mars : 16h00 - 19h00</h4>
                <h4>Mardi 4 Avril : 16h00 - 19h00</h4>
                <h4>Mardi 6 Mai : 16h00 - 19h00</h4>

            </div>

        </div>
   
        <div class="col-lg-12">
            <h3 class="entete"><strong>Prochaine AG</strong></h3>
            <div class="louve-box">

            <h3>Jeudi 24 Mars 2016 - 19h30</h3>
            <button class="btn btn-default">Inscription / Ordre du Jour / Questions</button>
        </div>

    </div>
    </div>
	
	  <div class="row">
        <div class="col-lg-12">
            <h3 class="entete"><strong>Guides et manuels utiles</strong></h3>
            <div class="louve-box">

            <h3>Guide du coopérateur</h3>
            
			
			
        </div>
		<div class="louve-box">
           
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-file" style="font-size:600%;color:grey"></span><br/>doc 1</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-file" style="font-size:600%;color:grey"></span><br/>doc 2</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-film" style="font-size:600%;color:grey"></span><br/>doc 3</p>
        </div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-film" style="font-size:600%;color:grey"></span><br/>doc 4</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-film" style="font-size:600%;color:grey"></span><br/>doc 5</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-file" style="font-size:600%;color:grey"></span><br/>doc 6</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-film" style="font-size:600%;color:grey"></span><br/>doc 7</p>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><p  ><span class="glyphicon glyphicon-file" style="font-size:600%;color:grey"></span><br/>doc 8</p>
		</div>
		
        </div>
    </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>