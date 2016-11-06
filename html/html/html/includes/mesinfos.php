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
require("_php/base.php");
?>
<div class="container">
 <div class="row">
   
        <div class="col-lg-12">
            <h3  class="entete ui horizontal divider"><strong>Mes infos</strong></h3>
            <div class="louve-box">

            <?php 
			$based = $bdd->query('SELECT * FROM members WHERE (login =\'' . $_SESSION['login'] . '\'');
			$rcq = $based->fetch();
			if(isset($rcq['nom']))
			{
				echo ('<p> Vous êtes ' . $rcq['prenom'] . ' ' . $rcq['prenom'] . '. <p>');
				echo ('<p> Votre mail est ' . $rcq['mail'] . '.');
				echo ('<p> Votre numéro de téléphone est ' . $rcq['telephone'] . '.');
				if($rcq['coordinateur'] == 1)
					echo ('<p> Vous êtes coordinateur </p>');
				if($rcq['creneau'] == 'volant')
					echo ('<p> Vous êtes dans l\'équipe volante.</p>');
				if($rcq['status'] == 1)
					echo ('<p> Vous êtes à jour dans vos créneaux.</p>');
				else else if($rcq['status'] == 2)
					echo ('<p> ATTENTION : Vous avez des créneaux à ratrapper.</p>');
				if($rcq['status'] == 3)
					echo ('<p> Vous êtes désinscrit. Passez au bureau des membres et rattrapez les créneaux 
				manqués pour pouvoir continuer à faire vos courses à la louve.</p>');
				
			}
		
		echo ('<a href="#">
           <button class="btn btn-default type="submit">Changer mon mot de passe</button>
			</a>');
			?>
        </div>

    </div>
    </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>